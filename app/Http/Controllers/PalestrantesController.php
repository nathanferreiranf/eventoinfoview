<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\PalestrantesRepository;
use App\Http\Repositories\EventosRepository;

class PalestrantesController extends Controller
{
    private $palestrantesRepository;
    private $eventosRepository;

    public function __construct(
        PalestrantesRepository $palestrantesRepo,
        EventosRepository $eventosRepo
    ){
        $this->palestrantesRepository = $palestrantesRepo;
        $this->eventosRepository = $eventosRepo;
    }

    public function index(Request $request)
    {
        $evento = $this->eventosRepository->find()->first();
        $palestrantes = $this->palestrantesRepository->find()->orderBy('posicao', 'asc')->paginate();

        $dados = Array(
            'evento' => $evento,
            'palestrantes' => $palestrantes->appends($request->except(['page']))
        );

        return view('palestrantes', $dados);
    }
}
