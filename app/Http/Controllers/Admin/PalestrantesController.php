<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Repositories\PalestrantesRepository;
use DateTime;

class PalestrantesController extends Controller
{
    private $palestrantesRepository;

    public function __construct(
        PalestrantesRepository $palestrantesRepo
    ){
        $this->palestrantesRepository = $palestrantesRepo;
    }

    public function index(Request $request)
    {
        $palestrantes = $this->palestrantesRepository->find()->orderBy('posicao', 'asc')->paginate();

        $dados = Array(
            'palestrantes' => $palestrantes->appends($request->except(['page']))
        );

        return view('admin.palestrantes.index', $dados);
    }

    public function create(Request $request)
    {
        return view('admin.palestrantes.create');
    }

    public function edit($id)
    {
        $palestrante = $this->palestrantesRepository->show($id);

        $data = Array(
            'palestrante' => $palestrante
        );

        return view('admin.palestrantes.edit', $data);
    }

    public function show($id)
    {
        $palestrante = $this->palestrantesRepository->show($id);

        $data = Array(
            'palestrante' => $palestrante
        );

        return view('admin.palestrantes.show', $data);
    }

    public function store(Request $request){
        $request->validate([
            'id_evento' => 'required',
            'nm_palestrante' => 'required|max:255',
            'ocupacao' => 'required',
            'descricao' => 'required',
            'lk_thumb' => 'required|file|mimes:jpeg,bmp,png,jpg'
        ]);

        try{
            if($request->hasFile('lk_thumb')){
                if($request->file('lk_thumb')->getSize() > 2000000){
                    $request->session()->flash('warning', 'Tamanho não suportado. Faça upload de imagens inferior a 2MB.');
                    return redirect()->back();
                }

                //$upload = $request->file('lk_thumb')->store('images/palestrantes');
                $upload = $request->file('lk_thumb')->storePublicly('images/palestrantes', 's3');

                /*$pathThumb = Image::make($upload)->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/palestrantes/thumb_'.explode('/',$upload)[2]);*/

                $request->merge([
                    'lk_thumb' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        $palestrante = $this->palestrantesRepository->create($request->input());

        if(!$palestrante['success']){
            $request->session()->flash('error', 'Houve um erro ao cadastrar o palestrante. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Palestrante cadastrado com sucesso.');
        return redirect()->route('palestrantes.index');
    }

    public function update($id, Request $request){
        $palestrante = $this->palestrantesRepository->show($id);

        $request->validate([
            'nm_palestrante' => 'required|max:255',
            'ocupacao' => 'required',
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

        if($request->hasFile('lk_thumb')){
            $request->validate([
                'lk_thumb' => 'file|mimes:jpeg,bmp,png,jpg'
            ]);

            Storage::disk('s3')->delete($palestrante->lk_thumb);
        }

        try{
            if($request->hasFile('lk_thumb')){
                if($request->file('lk_thumb')->getSize() > 2000000){
                    $request->session()->flash('warning', 'Tamanho não suportado. Faça upload de imagens inferior a 2MB.');
                    return redirect()->back();
                }

                //$upload = $request->file('lk_thumb')->store('images/palestrantes');
                $upload = $request->file('lk_thumb')->storePublicly('images/palestrantes', 's3');

                /*$pathThumb = Image::make($upload)->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/palestrantes/thumb_'.explode('/',$upload)[2]);*/

                $request->merge([
                    'lk_thumb' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        $palestrante = $this->palestrantesRepository->update($id, $request->input());

        if(!$palestrante['success']){
            $request->session()->flash('error', 'Houve um erro ao editar o palestrante. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Palestrante editado com sucesso.');
        return redirect()->back();
    }

    public function destroy($id, Request $request){
        $palestrante = $this->palestrantesRepository->show($id);
        $deleta = $this->palestrantesRepository->delete($id);
        
        if(!$deleta){
            $request->session()->flash('error', 'Houve um erro ao deletar o palestrante. Tente novamente !');
            return redirect()->back();
        }

        Storage::disk('s3')->delete($palestrante->lk_thumb);

        $request->session()->flash('success', 'O palestrante foi deletada com sucesso.');
        return redirect()->route('palestrantes.index');
    }
}
