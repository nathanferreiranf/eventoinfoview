<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Repositories\AgendasRepository;
use DateTime;

class AgendasController extends Controller
{
    private $agendasRepository;

    public function __construct(
        AgendasRepository $agendasRepo
    ){
        $this->agendasRepository = $agendasRepo;
    }

    public function index(Request $request)
    {
        $agendamentos = $this->agendasRepository->find($request->input())->paginate();

        $dados = Array(
            'agendamentos' => $agendamentos->appends($request->except(['page']))
        );

        return view('admin.agendas.index', $dados);
    }

    public function create(Request $request)
    {
        return view('admin.agendas.create');
    }

    public function edit($id)
    {
        $agendamento = $this->agendasRepository->show($id);

        $data = Array(
            'agendamento' => $agendamento
        );

        return view('admin.agendas.edit', $data);
    }

    public function show($id)
    {
        $agendamento = $this->agendasRepository->show($id);

        $data = Array(
            'agendamento' => $agendamento
        );

        return view('admin.agendas.show', $data);
    }

    public function store(Request $request){
        $request->validate([
            'id_evento' => 'required',
            'nm_agenda' => 'required|unique:agendas|max:255',
            'descricao' => 'required',
            'dt_inicio' => 'required',
            'hora_inicio' => 'required|date_format:H:i'
        ]);

        $data_inicio = DateTime::createFromFormat('d/m/Y H:i', $request->dt_inicio.' '.$request->hora_inicio);
        $request->merge([
            'dt_inicio' => $data_inicio->format('Y-m-d H:i')
        ]);

        $agendamento = $this->agendasRepository->create($request->input());

        if(!$agendamento['success']){
            $request->session()->flash('error', 'Houve um erro ao registrar o agendamento. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Agendamento cadastrado com sucesso.');
        return redirect()->route('agendas.index');
    }

    public function update($id, Request $request){
        $agendamento = $this->agendasRepository->show($id);

        $request->validate([
            'nm_agenda' => 'required|max:255',
            'descricao' => 'required',
            'dt_inicio' => 'required',
            'hora_inicio' => 'required|date_format:H:i'
        ]);

        if($request->has('fl_visivel') && $request->fl_visivel == 1){
            $request->merge(['fl_visivel' => 1]);
        }
        if(!$request->has('fl_visivel')){
            $request->merge(['fl_visivel' => 0]);
        }

        $data_inicio = DateTime::createFromFormat('d/m/Y H:i', $request->dt_inicio.' '.$request->hora_inicio);
        $request->merge([
            'dt_inicio' => $data_inicio->format('Y-m-d H:i')
        ]);

        $agendamento = $this->agendasRepository->update($id, $request->input());

        if(!$agendamento['success']){
            $request->session()->flash('error', 'Houve um erro ao editar o agendamento. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Agendamento editado com sucesso.');
        return redirect()->back();
    }

    public function destroy($id, Request $request){
        $agendamento = $this->agendasRepository->delete($id);

        if(!$agendamento){
            $request->session()->flash('error', 'Houve um erro ao deletar o agendamento. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Agendamento deletado com sucesso.');
        return redirect()->route('agendas.index');
    }
}
