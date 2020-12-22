<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Repositories\InscritosRepository;
use App\Http\Repositories\EventosCamposRepository;
use App\Http\Repositories\InscritosCamposRepository;
use App\Http\Repositories\SalasRepository;
use App\Http\Repositories\SalasVisitasRepository;

class RelatoriosController extends Controller
{
    private $inscritosRepository;
    private $eventosCamposRepository;
    private $inscritosCamposRepository;
    private $salasRepository;
    private $salasVisitasRepository;

    public function __construct(
        InscritosRepository $inscritosRepo,
        EventosCamposRepository $eventosCamposRepo,
        InscritosCamposRepository $inscritosCamposRepo,
        SalasRepository $salasRepo,
        SalasVisitasRepository $salasVisitasRepo
    ){
        $this->inscritosRepository = $inscritosRepo;
        $this->eventosCamposRepository = $eventosCamposRepo;
        $this->inscritosCamposRepository = $inscritosCamposRepo;
        $this->salasRepository = $salasRepo;
        $this->salasVisitasRepository = $salasVisitasRepo;
    }

    public function visitasPorStands(Request $request)
    {
        $salas = $this->salasRepository->find()->get();
        //$estados = $this->inscritosRepository->find()->groupBy('inscritos.estado')->get();
        /*$cidades = $this->inscritosRepository->find([
            'estado' => $request->estado
        ])->groupBy('inscritos.cidade')->get();*/

        $visitas = $this->salasVisitasRepository->find($request->input())->orderBy('users.name', 'asc')
        ->groupBy('users.id', 'salas.id')
        ->selectRaw('count(salas_visitas.id) as qtde')
        ->selectRaw('max(salas_visitas.created_at) as ultimo_acesso')
        ->paginate();

        $data = Array(
            //'estados' => $estados,
            'salas' => $salas,
            //'cidades' => $cidades,
            'visitas' => $visitas->appends($request->except(['page']))
        );

        return view('admin.relatorios.visitas', $data);
    }
}