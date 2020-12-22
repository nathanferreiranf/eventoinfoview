<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Repositories\PatrocinadoresRepository;
use DateTime;

class PatrocinadoresController extends Controller
{
    private $patrocinadoresRepository;

    public function __construct(
        PatrocinadoresRepository $patrocinadoresRepo
    ){
        $this->patrocinadoresRepository = $patrocinadoresRepo;
    }

    public function index(Request $request)
    {
        $patrocinadores = $this->patrocinadoresRepository->find($request->input())->orderBy('posicao', 'asc')->paginate();

        $dados = Array(
            'patrocinadores' => $patrocinadores->appends($request->except(['page']))
        );

        return view('admin.patrocinadores.index', $dados);
    }

    public function create(Request $request)
    {
        return view('admin.patrocinadores.create');
    }

    public function edit($id)
    {
        $patrocinador = $this->patrocinadoresRepository->show($id);

        $data = Array(
            'patrocinador' => $patrocinador
        );

        return view('admin.patrocinadores.edit', $data);
    }

    public function show($id)
    {
        $patrocinador = $this->patrocinadoresRepository->show($id);

        $data = Array(
            'patrocinador' => $patrocinador
        );

        return view('admin.patrocinadores.show', $data);
    }

    public function store(Request $request){
        $request->validate([
            'id_evento' => 'required',
            'nm_patrocinador' => 'required|max:255',
            'lk_foto' => 'required|file|mimes:jpeg,bmp,png,jpg'
        ]);

        try{
            if($request->hasFile('lk_foto')){
                if($request->file('lk_foto')->getSize() > 2000000){
                    $request->session()->flash('warning', 'Tamanho não suportado. Faça upload de imagens inferior a 2MB.');
                    return redirect()->back();
                }

                $upload = $request->file('lk_foto')->storePublicly('images/patrocinadores', 's3');

                $request->merge([
                    'lk_foto' => Storage::disk('s3')->url($upload)
                ]);
            }
        }catch(Exception $e){
            $request->session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        $patrocinador = $this->patrocinadoresRepository->create($request->input());

        if(!$patrocinador['success']){
            $request->session()->flash('error', 'Houve um erro ao cadastrar o patrocinador. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Patrocinador cadastrado com sucesso.');
        return redirect()->route('patrocinadores.index');
    }

    public function update($id, Request $request){
        $patrocinador = $this->patrocinadoresRepository->show($id);

        $request->validate([
            'id_evento' => 'required',
        ]);

        if($request->has('fl_visivel') && $request->fl_visivel == 1){
            $request->merge(['fl_visivel' => 1]);
        }
        if(!$request->has('fl_visivel')){
            $request->merge(['fl_visivel' => 0]);
        }

        if($request->hasFile('lk_foto')){
            $request->validate([
                'lk_foto' => 'file|mimes:jpeg,bmp,png,jpg'
            ]);

            try{
                Storage::disk('s3')->delete($patrocinador->lk_foto);

                if($request->file('lk_foto')->getSize() > 2000000){
                    $request->session()->flash('warning', 'Tamanho não suportado. Faça upload de imagens inferior a 2MB.');
                    return redirect()->back();
                }

                $upload = $request->file('lk_foto')->storePublicly('images/patrocinadores', 's3');

                $request->merge([
                    'lk_foto' => Storage::disk('s3')->url($upload)
                ]);
            }catch(Exception $e){
                $request->session()->flash('error', $e->getMessage());
                return redirect()->back();
            }
        }


        $patrocinador = $this->patrocinadoresRepository->update($id, $request->input());

        if(!$patrocinador['success']){
            $request->session()->flash('error', 'Houve um erro ao editar o patrocinador. Tente novamente !');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Patrocinador editado com sucesso.');
        return redirect()->back();
    }

    public function destroy($id, Request $request){
        $patrocinador = $this->patrocinadoresRepository->show($id);

        $delete = $this->patrocinadoresRepository->delete($id);

        if(!$delete){
            $request->session()->flash('error', 'Houve um erro ao deletar o patrocinador. Tente novamente !');
            return redirect()->back();
        }

        Storage::disk('s3')->delete($patrocinador->lk_foto);

        $request->session()->flash('success', 'O patrocinador foi deletado com sucesso.');
        return redirect()->route('patrocinadores.index');
    }
}
