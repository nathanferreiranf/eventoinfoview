<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Repositories\SalasArquivosRepository;

class ArquivosController extends Controller
{
    private $salasArquivosRepository;

    public function __construct(
        SalasArquivosRepository $salasArquivosRepo
    ){
        $this->salasArquivosRepository = $salasArquivosRepo;
    }

    public function destroy($id, Request $request){
        $arquivo = $this->salasArquivosRepository->show($id);

        Storage::delete($arquivo->lk_arquivo);

        $delete = $this->salasArquivosRepository->delete($id);

        if(!$delete) return response()->json('Houve um erro ao deletar o arquivo', 400);

        $arquivos = $this->salasArquivosRepository->find([
            'id_sala' => $arquivo->id_sala
        ])->get();

        return response()->json($arquivos);
    }
}
