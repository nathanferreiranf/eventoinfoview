<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\EventosRepository;

class LoginController extends Controller
{
    private $eventosRepository;

    public function __construct(
        EventosRepository $eventosRepo
    ){
        $this->eventosRepository = $eventosRepo;
    }
    
    public function index(){
        if(Auth::guard('admin')->check()){
            return redirect()->route('dashboard');
        }
        
        return view('auth.login_admin');
    }

    public function postLogin(Request $request){
        $validator = Validator($request->all(), [
            'email' => 'required|min:3|max:100',
            'password' => 'required|min:3|max:100'
        ]);

        if($validator->fails()){
            return redirect()->route('login.admin')->withErrors($validator)->withInput();
        }

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if(!Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('login.admin')->withErrors(['errors' => 'Login inválido.'])->withInput();
        }

        $evento = $this->eventosRepository->find()->first();
        $request->session()->put('evento', $evento);

        return redirect()->route('dashboard');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login.admin');
    }
}
