<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\EventosRepository;
use App\Http\Repositories\AgendasRepository;

class AgendaController extends Controller
{
    private $agendaRepository;
    private $eventosRepository;

    public function __construct(
        AgendasRepository $agendaRepo,
        EventosRepository $eventosRepo
    ){
        $this->agendaRepository = $agendaRepo;
        $this->eventosRepository = $eventosRepo;
    }

    public function index()
    {
        $evento = $this->eventosRepository->find()->first();
        $agendamentos = $this->agendaRepository->find()->paginate();

        $dados = Array(
            'evento' => $evento,
            'agendamentos' => $agendamentos
        );

        return view('agenda', $dados);
    }
}
