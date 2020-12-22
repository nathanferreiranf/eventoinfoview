<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Repositories\SalasRepository;
use App\Http\Repositories\SalasArquivosRepository;
use DateTime;

class SalasController extends Controller
{
    private $salasRepository;
    private $salasArquivosRepository;

    public function __construct(
        SalasRepository $salasRepo,
        SalasArquivosRepository $salasArquivosRepo
    ){
        $this->salasRepository = $salasRepo;
        $this->salasArquivosRepository = $salasArquivosRepo;
    }
    
    public function index(Request $request)
    {
        $salas = $this->salasRepository->find()->orderBy('salas.dt_inicio', 'asc')->paginate();

        $dados = Array(
            'salas' => $salas->appends($request->except(['page']))
        );

        return view('admin.salas.index', $dados);
    }

    public function create(Request $request)
    {
        return view('admin.salas.create');
    }

    public function edit($id){
        $sala = $this->salasRepository->show($id);
        $arquivos = $this->salasArquivosRepository->find([
            'id_sala' => $id
        ])->get();

        $data = Array(
            'sala' => $sala,
            'arquivos' => $arquivos
        );

        return view('admin.salas.edit', $data);
    }

    public function show($id){
        $sala = $this->salasRepository->show($id);

        $data = Array(
            'sala' => $sala
        );

        return view('admin.salas.show', $data);
    }

    public function store(Request $request){
        $request->validate([
            'id_evento' => 'required',
            'nm_sala' => 'required|unique:salas|max:255',
            'lk_sala' => 'required',
            'dt_inicio' => 'required',
            'hora_inicio' => 'required',
            'dt_fim' => 'required',
            'hora_fim' => 'required',
            'thumb_sala' => 'required|file|mimes:jpeg,bmp,png,jpg|dimensions:min_width=400',
            'descricao' => 'required'
        ],[
            'required' => 'Este campo é obrigatório.'
        ]);

        $data_inicio = DateTime::createFromFormat('d/m/Y H:i', $request->dt_inicio.' '.$request->hora_inicio);
        $data_fim = DateTime::createFromFormat('d/m/Y H:i', $request->dt_fim.' '.$request->hora_fim);
        $request->merge([
            'dt_inicio' => $data_inicio->format('Y-m-d H:i'),
            'dt_fim' => $data_fim->format('Y-m-d H:i')
        ]);

        try{
            if($request->hasFile('thumb_sala')){
                if($request->file('thumb_sala')->getSize() > 2000000){
                    $request->session()->flash('warning', 'Tamanho não suportado. Faça upload de imagens inferior a 2MB.');
                    return redirect()->back();
                }

                $upload = $request->file('thumb_sala')->storePublicly('images/salas', 's3');

                /*$pathThumb = Image::make($upload)->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/salas/thumb_'.explode('/',$upload)[2]);*/

                $request->merge([
                    'thumb_sala' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        $sala = $this->salasRepository->create($request->input());

        if(!$sala['success']){
            $request->session()->flash('error', 'Houve um erro ao criar a sala. Tente novamente !');
            return redirect()->back();
        }

        if($request->hasFile('arquivos')){
            foreach ($request->file('arquivos') as $arquivo) {
                $filename = $arquivo->getClientOriginalName();
                $upload = $arquivo->storeAs('arquivos', $filename);
                
                $this->salasArquivosRepository->create([
                    'id_sala' => $sala['data']->id,
                    'lk_arquivo' => $upload
                ]);
            }
        }
        
        $request->session()->flash('success', 'Sala criada com sucesso.');
        return redirect()->route('salas.index');
    }

    public function update($id, Request $request){
        $sala = $this->salasRepository->show($id);

        $request->validate([
            //'nm_sala' => 'required|unique:salas|max:255',
            'lk_sala' => 'required',
            'dt_inicio' => 'required',
            'hora_inicio' => 'required',
            'dt_fim' => 'required',
            'hora_fim' => 'required',
            'descricao' => 'required'
        ]);

        if($request->has('fl_visivel') && $request->fl_visivel == 1){
            $request->merge(['fl_visivel' => 1]);
        }
        if(!$request->has('fl_visivel')){
            $request->merge(['fl_visivel' => 0]);
        }

        if($request->has('fl_principal') && $request->fl_principal == 1){
            $request->merge(['fl_principal' => 1]);
        }
        if(!$request->has('fl_principal')){
            $request->merge(['fl_principal' => 0]);
        }

        if($request->hasFile('thumb_sala')){
            $request->validate([
                'thumb_sala' => 'file|mimes:jpeg,bmp,png,jpg|dimensions:min_width=400'
            ]);

            Storage::disk('s3')->delete($sala->thumb_sala);
        }

        if($request->hasFile('arquivos')){
            foreach ($request->file('arquivos') as $arquivo) {
                $filename = $arquivo->getClientOriginalName();
                //$upload = $arquivo->storeAs('arquivos', $filename);
                $upload = $request->file('arquivos')->storePublicly('arquivos', 's3');
                
                $this->salasArquivosRepository->create([
                    'id_sala' => $id,
                    'lk_arquivo' => Storage::disk('s3')->url($upload)
                ]);
            }
        }

        $data_inicio = DateTime::createFromFormat('d/m/Y H:i', $request->dt_inicio.' '.$request->hora_inicio);
        $data_fim = DateTime::createFromFormat('d/m/Y H:i', $request->dt_fim.' '.$request->hora_fim);
        $request->merge([
            'dt_inicio' => $data_inicio->format('Y-m-d H:i'),
            'dt_fim' => $data_fim->format('Y-m-d H:i')
        ]);

        try{
            if($request->hasFile('thumb_sala')){
                if($request->file('thumb_sala')->getSize() > 2000000){
                    $request->session()->flash('warning', 'Tamanho não suportado. Faça upload de imagens inferior a 2MB.');
                    return redirect()->back();
                }

                $upload = $request->file('thumb_sala')->storePublicly('images/salas', 's3');

                /*$pathThumb = Image::make($upload)->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/salas/thumb_'.explode('/',$upload)[2]);*/

                $request->merge([
                    'thumb_sala' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        $sala = $this->salasRepository->update($id, $request->input());

        if(!$sala['success']){
            $request->session()->flash('error', 'Houve um erro ao editar a sala. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Sala editada com sucesso.');
        return redirect()->back();
    }

    public function destroy($id, Request $request){
        $sala = $this->salasRepository->show($id);
        $delete = $this->salasRepository->delete($id);

        if(!$delete){
            $request->session()->flash('error', 'Houve um erro ao deletar a sala. Tente novamente !');
            return redirect()->back();
        }

        Storage::disk('s3')->delete($sala->thumb_sala);

        $request->session()->flash('success', 'A sala foi deletada com sucesso.');
        return redirect()->route('salas.index');
    }
}
