<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\EventosRepository;
use App\Http\Repositories\SalasRepository;
use App\Http\Repositories\SalasVisitasRepository;
use App\Http\Repositories\SalasArquivosRepository;

class SalasController extends Controller
{
    private $salasRepository;
    private $eventosRepository;
    private $salasVisitasRepository;
    private $salasArquivosRepository;

    public function __construct(
        SalasRepository $salasRepo,
        SalasVisitasRepository $salasVisitasRepo,
        SalasArquivosRepository $salasArquivosRepo,
        EventosRepository $eventosRepo
    ){
        $this->salasRepository = $salasRepo;
        $this->salasVisitasRepository = $salasVisitasRepo;
        $this->salasArquivosRepository = $salasArquivosRepo;
        $this->eventosRepository = $eventosRepo;
    }

    public function index(Request $request)
    {
        $evento = $this->eventosRepository->find()->first();
        $salas = $this->salasRepository->find()->orderBy('salas.dt_inicio', 'desc')->paginate();

        $dados = Array(
            'evento' => $evento,
            'salas' => $salas->appends($request->except(['page']))
        );

        return view('salas', $dados);
    }

    public function show($slug){
        $sala = $this->salasRepository->find([
            'slug_sala' => $slug
        ])->first();

        $this->salasVisitasRepository->create([
            'id_sala' => $sala->id,
            'id_user' => Auth::user()->id
        ]);

        $arquivos = $this->salasArquivosRepository->find([
            'id_sala' => $sala->id
        ])->get();

        $dados = Array(
            'sala' => $sala,
            'arquivos' => $arquivos
        );

        return view('salas_interna', $dados);
    }
}
