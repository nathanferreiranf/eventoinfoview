<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\EventosRepository;
use App\Http\Repositories\EventosCamposRepository;
use DateTime;

class EventosController extends Controller
{
    private $eventosRepository;
    private $eventosCamposRepository;

    public function __construct(
        EventosRepository $eventosRepo,
        EventosCamposRepository $eventosCamposRepo
    ){
        $this->eventosRepository = $eventosRepo;
        $this->eventosCamposRepository = $eventosCamposRepo;
    }

    public function index(Request $request)
    {
        $eventos = $this->eventosRepository->find($request->input());

        $dados = Array(
            'eventos' => $eventos->appends($request->except(['page']))
        );

        return view('admin.eventos.index', $dados);
    }

    public function create(Request $request)
    {
        return view('admin.eventos.create');
    }

    public function edit($id)
    {
        $evento = $this->eventosRepository->show($id);
        $evento['campos'] = $this->eventosCamposRepository->find([
            'id_evento' => $id
        ])->get();

        $data = Array(
            'evento' => $evento
        );

        return view('admin.eventos.edit', $data);
    }

    public function store(Request $request){
        $request->validate([
            'nm_evento' => 'required|unique:eventos|max:255',
            'descricao' => 'required',
            'dt_inicio' => 'required',
            'dt_fim' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fim' => 'required|date_format:H:i',
            'lk_banner' => 'required|file|mimes:jpeg,bmp,png,jpg',
            'lk_banner_auth' => 'required|file|mimes:jpeg,bmp,png,jpg'
        ]);

        $data_inicio = DateTime::createFromFormat('d/m/Y H:i', $request->dt_inicio.' '.$request->hora_inicio);
        $data_fim = DateTime::createFromFormat('d/m/Y H:i', $request->dt_fim.' '.$request->hora_fim);

        $request->merge([
            'dt_inicio' => $data_inicio->format('Y-m-d H:i'),
            'dt_fim' => $data_fim->format('Y-m-d H:i')
        ]);

        try{
            if($request->hasFile('lk_banner')){
                $upload = $request->file('lk_banner')->storePublicly('images/banners', 's3');

                $request->merge([
                    'lk_banner' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        try{
            if($request->hasFile('lk_banner_auth')){
                $upload = $request->file('lk_banner_auth')->storePublicly('images/banners', 's3');

                $request->merge([
                    'lk_banner_auth' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        $evento = $this->eventosRepository->create($request->input());

        if(!$evento['success']){
            $request->session()->flash('error', 'Houve um erro ao cadastrar o evento. Tente novamente !');
            return redirect()->back();
        }

        if($request->has('campos')){
            foreach ($request->campos as $key => $item) {
                if($item != ''){
                    $registro = $this->eventosCamposRepository->create([
                        'id_evento' => $evento['data']->id,
                        'nm_campo' => $item,
                        'fl_obrigatorio' => $request->campos_obrigatorios[$key]
                    ]);
                }
            }
        }

        $request->session()->put('evento', $evento['data']);
        $request->session()->flash('success', 'Evento cadastrado com sucesso.');
        return redirect()->route('eventos.index');
    }

    public function update($id, Request $request){
        $evento = $this->eventosRepository->show($id);

        $request->validate([
            'nm_evento' => 'required|max:255',
            'descricao' => 'required',
            'dt_inicio' => 'required',
            'dt_fim' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fim' => 'required|date_format:H:i'
        ]);

        $data_inicio = DateTime::createFromFormat('d/m/Y H:i', $request->dt_inicio.' '.$request->hora_inicio);
        $data_fim = DateTime::createFromFormat('d/m/Y H:i', $request->dt_fim.' '.$request->hora_fim);

        $request->merge([
            'dt_inicio' => $data_inicio->format('Y-m-d H:i'),
            'dt_fim' => $data_fim->format('Y-m-d H:i')
        ]);

        if($request->has('campos')){
            $campos = $this->eventosCamposRepository->find([
                'id_evento' => $evento->id
            ])->get();

            foreach ($campos as $campo) {
                $this->eventosCamposRepository->delete($campo->id);
            }

            foreach ($request->campos as $key => $item) {
                $registro = $this->eventosCamposRepository->create([
                    'id_evento' => $evento->id,
                    'nm_campo' => $item,
                    'fl_obrigatorio' => $request->campos_obrigatorios[$key]
                ]);
            }
        }

        if($request->hasFile('lk_banner')){
            $request->validate([
                'lk_banner' => 'file|mimes:jpeg,bmp,png,jpg'
            ]);

            Storage::disk('s3')->delete($evento->lk_banner);
        }

        if($request->hasFile('lk_banner_auth')){
            $request->validate([
                'lk_banner' => 'file|mimes:jpeg,bmp,png,jpg'
            ]);

            Storage::disk('s3')->delete($evento->lk_banner_auth);
        }

        try{
            if($request->hasFile('lk_banner')){
                $upload = $request->file('lk_banner')->storePublicly('images/banners', 's3');

                $request->merge([
                    'lk_banner' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        try{
            if($request->hasFile('lk_banner_auth')){
                $upload = $request->file('lk_banner_auth')->storePublicly('images/banners', 's3');

                $request->merge([
                    'lk_banner_auth' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        $evento = $this->eventosRepository->update($id, $request->input());

        if(!$evento['success']){
            $request->session()->flash('error', 'Houve um erro ao editar o evento. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Evento editado com sucesso.');
        return redirect()->back();
    }
}
