<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Repositories\EventosRepository;
use App\Http\Repositories\EventosCamposRepository;
use App\Http\Repositories\InscritosCamposRepository;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $eventosRepository;
    private $eventosCamposRepository;
    private $inscritosCamposRepository;

    /**
     * Where to redirect users after registration.
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
        EventosRepository $eventosRepo,
        EventosCamposRepository $eventosCamposRepo,
        InscritosCamposRepository $inscritosCamposRepo

    ){
        $this->middleware('guest');
        $this->eventosRepository = $eventosRepo;
        $this->eventosCamposRepository = $eventosCamposRepo;
        $this->inscritosCamposRepository = $inscritosCamposRepo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $evento = $this->eventosRepository->find()->first();

        $dados = [
            'id_evento' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'g-recaptcha-response' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $campos = $this->eventosCamposRepository->find([
            'id_evento' => $evento->id
        ])->get();

        foreach ($campos as $campo) {
            if($campo->fl_obrigatorio == 1){
                $dados[$campo->slug_campo] = ['required'];
            }
        }

        return Validator::make($data, $dados, [
            'g-recaptcha-response.required' => 'Informe que você não é um robô'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $dados = [
            'id' => Str::uuid(),
            'id_evento' => $data['id_evento'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];

        $user = User::create($dados);

        $campos = $this->eventosCamposRepository->find([
            'id_evento' => $user->id_evento
        ])->get();

        foreach ($campos as $item) {
            if(isset($data[$item->slug_campo])){
                $campo = $this->inscritosCamposRepository->create([
                    'id_user' => $user->id,
                    'campo' => $item->slug_campo,
                    'conteudo' => $data[$item->slug_campo]
                ]);
            }
        }

        return $user;
    }

    public function showRegistrationForm(){
        $evento = $this->eventosRepository->find()->first();
        $campos = $this->eventosCamposRepository->find([
            'id_evento' => $evento->id
        ])->get();

        $data = Array(
            'evento' => $evento,
            'campos' => $campos
        );

        return view('auth.register', $data);
    }
}
