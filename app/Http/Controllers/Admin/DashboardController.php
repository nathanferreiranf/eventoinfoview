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

class DashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $qtde_inscritos = $this->inscritosRepository->find()->count();
        $qtde_inscritos_hoje = $this->inscritosRepository->find(['dia' => date('Y-m-d')])->count();
        $totalVisitasSalas = 0;

        $salas = $this->salasRepository->find([
            'fl_visivel' => 1
        ])->get();

        $periodo_evento = $this->salasVisitasRepository->find()
        ->selectRaw('date_format(salas_visitas.created_at, "%Y-%m-%d") as dia')
        ->groupBy('dia')
        ->orderBy('dia')->get();

        foreach ($salas as $key => $stand) {
            $arr_periodo = [];
            
            foreach ($periodo_evento as $item) {
                $periodo = $this->salasVisitasRepository->find([
                    'id_sala' => $stand->id,
                    'dia' => $item->dia
                ])->selectRaw('day(salas_visitas.created_at) as dia')
                ->selectRaw('count(*) as qtde')
                ->groupBy('dia')->first();
                
                $qtde_visitas = ($periodo != null) ? $periodo->qtde : 0;
                $totalVisitasSalas += $qtde_visitas;
                array_push($arr_periodo, $qtde_visitas);
            }

            $salas[$key]['periodo'] = $arr_periodo;
        }

        $data = Array(
            'qtde_inscritos' => $qtde_inscritos,
            'qtde_inscritos_hoje' => $qtde_inscritos_hoje,
            'totalVisitasSalas' => $totalVisitasSalas,
            'periodo_evento' => $periodo_evento,
            'salas' => $salas
        );

        return view('admin.dashboard', $data);
    }
}
