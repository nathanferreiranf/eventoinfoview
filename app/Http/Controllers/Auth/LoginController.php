<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Repositories\EventosRepository;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    private $eventosRepository;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        EventosRepository $eventosRepo
    ){
        $this->middleware('guest')->except('logout');
        $this->eventosRepository = $eventosRepo;
    }

    public function showLoginForm(){
        $evento = $this->eventosRepository->find()->first();

        $data = Array(
            'evento' => $evento
        );

        return view('auth.login', $data);
    }
}
