<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Repositories\InscritosRepository;
use App\Http\Repositories\EventosCamposRepository;
use App\Http\Repositories\InscritosCamposRepository;
use Cache;

class InscritosController extends Controller
{
    private $inscritosRepository;
    private $eventosCamposRepository;
    private $inscritosCamposRepository;

    public function __construct(
        InscritosRepository $inscritosRepo,
        EventosCamposRepository $eventosCamposRepo,
        InscritosCamposRepository $inscritosCamposRepo
    ){
        $this->inscritosRepository = $inscritosRepo;
        $this->eventosCamposRepository = $eventosCamposRepo;
        $this->inscritosCamposRepository = $inscritosCamposRepo;
    }

    public function index(Request $request)
    {
        $keyCache = 'inscritos:'.($request->has('page')) ? $request->page : 1;

        $evento = $request->session()->get('evento');

        $campos = $this->eventosCamposRepository->find([
            'id_evento' => $evento->id
        ])->get();

        $inscritos = Cache::remember($keyCache, 60, function() use ($request){
            return $this->inscritosRepository->find($request->input())->orderBy('users.created_at', 'desc')->paginate();
        });

        $qtde_inscritos_hoje = $this->inscritosRepository->find(['dia' => date('Y-m-d')])->count();

        foreach ($inscritos as $key => $inscrito) {
            foreach ($campos as $campo) {
                $valor = $this->inscritosCamposRepository->find([
                    'id_user' => $inscrito->id,
                    'campo' => $campo->slug_campo
                ])->first();

                $inscritos[$key][$campo->slug_campo] = ($valor != null) ? $valor->conteudo : '';
            }
        }

        $dados = Array(
            'campos' => $campos,
            'inscritos' => $inscritos->appends($request->except(['page'])),
            'qtde_inscritos_hoje' => $qtde_inscritos_hoje
        );

        return view('admin.inscritos.index', $dados);
    }

    public function show($id, Request $request){
        $evento = $request->session()->get('evento');

        $campos = $this->eventosCamposRepository->find([
            'id_evento' => $evento->id
        ])->get();

        $inscrito = $this->inscritosRepository->show($id);
        foreach ($campos as $campo) {
            $valor = $this->inscritosCamposRepository->find([
                'id_user' => $inscrito->id,
                'campo' => $campo->slug_campo
            ])->first();

            $inscrito[$campo->slug_campo] = ($valor != null) ? $valor->conteudo : '';
        }

        $dados = Array(
            'campos' => $campos,
            'inscrito' => $inscrito
        );

        return view('admin.inscritos.show', $dados);
    }
}
