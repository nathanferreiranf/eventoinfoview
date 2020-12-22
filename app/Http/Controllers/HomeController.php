<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\SalasRepository;
use App\Http\Repositories\PalestrantesRepository;
use App\Http\Repositories\EventosRepository;
use App\Http\Repositories\PatrocinadoresRepository;
use App\Http\Repositories\PlanosRepository;
use App\Http\Repositories\AgendasRepository;
use Carbon\Carbon;

class HomeController extends Controller
{
    private $salasRepository;
    private $palestrantesRepository;
    private $eventosRepository;
    private $patrocinadoresRepository;
    private $planosRepository;
    private $agendaRepository;

    public function __construct(
        SalasRepository $salasRepo,
        PalestrantesRepository $palestrantesRepo,
        EventosRepository $eventosRepo,
        PatrocinadoresRepository $patrocinadoresRepo,
        PlanosRepository $planosRepo,
        AgendasRepository $agendaRepo
    ){
        $this->salasRepository = $salasRepo;
        $this->palestrantesRepository = $palestrantesRepo;
        $this->eventosRepository = $eventosRepo;
        $this->patrocinadoresRepository = $patrocinadoresRepo;
        $this->planosRepository = $planosRepo;
        $this->agendaRepository = $agendaRepo;
    }

    public function index()
    {
        $evento = $this->eventosRepository->find()->first();
        $patrocinadores = $this->patrocinadoresRepository->find()->orderBy('posicao', 'asc')->get();
        $salas = $this->salasRepository->find()->orderBy('salas.dt_inicio', 'desc')->paginate(4);
        $palestrantes = $this->palestrantesRepository->find([
            'fl_principal' => 1
        ])->orderBy('posicao', 'asc')->get();
        $planos = $this->planosRepository->find()->get();
        $agendamentos = $this->agendaRepository->find()->orderBy('agendas.dt_inicio')->paginate(4);

        foreach ($planos as $key => $plano) {
            $arrSalas = [];
            foreach (explode(",", $plano->acesso_salas) as $item) {
                $sala = $this->salasRepository->show($item);
                array_push($arrSalas, $sala);
            }
            $planos[$key]['salas'] = $arrSalas;
        }

        $dados = Array(
            'evento' => $evento,
            'patrocinadores' => $patrocinadores,
            'salas' => $salas,
            'palestrantes' => $palestrantes,
            'planos' => $planos,
            'agendamentos' => $agendamentos
        );

        return view('home', $dados);
    }
}
