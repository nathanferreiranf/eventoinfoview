<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Repositories\PlanosRepository;
use App\Http\Repositories\SalasRepository;
use DateTime;

class PlanosController extends Controller
{
    private $planosRepository;
    private $salasRepository;

    public function __construct(
        PlanosRepository $planosRepo,
        SalasRepository $salasRepo
    ){
        $this->planosRepository = $planosRepo;
        $this->salasRepository = $salasRepo;
    }

    public function index(Request $request)
    {
        $planos = $this->planosRepository->find()->paginate();

        foreach ($planos as $key => $plano) {
            $arrSalas = [];

            foreach (explode(",", $plano->acesso_salas) as $item) {
                $sala = $this->salasRepository->show($item);
                array_push($arrSalas, $sala);
            }

            $planos[$key]['salas'] = $arrSalas;
        }
        
        $dados = Array(
            'planos' => $planos->appends($request->except(['page']))
        );

        return view('admin.planos.index', $dados);
    }

    public function create(Request $request)
    {
        $salas = $this->salasRepository->find()->get();

        $dados = Array(
            'salas' => $salas
        );

        return view('admin.planos.create', $dados);
    }

    public function edit($id)
    {
        $plano = $this->planosRepository->show($id);
        
        $arrSalas = [];
        foreach (explode(",", $plano->acesso_salas) as $item) {
            $sala = $this->salasRepository->show($item);
            array_push($arrSalas, $sala->id);
        }
        $plano['salas'] = $arrSalas;

        $salas = $this->salasRepository->find()->get();

        $data = Array(
            'plano' => $plano,
            'salas' => $salas
        );

        return view('admin.planos.edit', $data);
    }

    public function store(Request $request){
        $request->validate([
            'id_evento' => 'required',
            'nm_plano' => 'required|unique:planos|max:255',
            'acesso_salas' => 'required',
            'vl_plano' => 'required',
            'dt_validade' => 'required',
            'hora_validade' => 'required'
        ]);

        $request->merge([
            'acesso_salas' => implode(",", $request->acesso_salas)
        ]);

        $data_validade = DateTime::createFromFormat('d/m/Y H:i', $request->dt_validade.' '.$request->hora_validade);
        $request->merge([
            'dt_validade' => $data_validade->format('Y-m-d H:i')
        ]);

        $plano = $this->planosRepository->create($request->input());

        if(!$plano['success']){
            $request->session()->flash('error', 'Houve um erro ao cadastrar o plano. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Plano cadastrado com sucesso.');
        return redirect()->route('planos.index');
    }

    public function update($id, Request $request){
        $request->validate([
            'acesso_salas' => 'required',
            'vl_plano' => 'required',
            'dt_validade' => 'required',
            'hora_validade' => 'required'
        ]);

        $request->merge([
            'acesso_salas' => implode(",", $request->acesso_salas)
        ]);

        $data_validade = DateTime::createFromFormat('d/m/Y H:i', $request->dt_validade.' '.$request->hora_validade);
        $request->merge([
            'dt_validade' => $data_validade->format('Y-m-d H:i')
        ]);

        $plano = $this->planosRepository->update($id, $request->input());

        if(!$plano['success']){
            $request->session()->flash('error', 'Houve um erro ao editar o plano. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Plano editado com sucesso.');
        return redirect()->back();
    }
}
