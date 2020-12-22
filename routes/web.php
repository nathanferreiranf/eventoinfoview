<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['admin']], function(){
    Route::namespace('Admin')->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('/', 'LoginController@index');
            Route::get('login', 'LoginController@index')->name('login.admin');
            Route::post('login', 'LoginController@postLogin')->name('login.admin');
            Route::post('logout', 'LoginController@logout')->name('logout.admin');

            Route::group(['middleware' => ['authAdmin']], function(){
                Route::get('dashboard', 'DashboardController@index')->name('dashboard');
                Route::resource('inscritos', 'InscritosController');
                Route::resource('salas', 'SalasController');
                Route::resource('agendas', 'AgendasController');
                Route::resource('palestrantes', 'PalestrantesController');
                Route::resource('patrocinadores', 'PatrocinadoresController');
                Route::resource('planos', 'PlanosController');
                Route::resource('eventos', 'EventosController');
                Route::resource('arquivos', 'ArquivosController');
                
                Route::get('relatorios/visitas-por-salas', 'RelatoriosController@visitasPorStands')->name('relatorio.visitas');
            });
        });
    });
});


Route::group(['middleware' => ['web']], function(){
    Auth::routes([
        'verify' => true,
        'reset' => true
    ]);

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/agenda', 'AgendaController@index')->name('agenda.index');
    Route::get('/palestrantes', 'PalestrantesController@index')->name('web.palestrantes.index');

    Route::get('/salas', 'SalasController@index')->middleware(['auth', 'verified'])->name('site.salas.index');
    Route::get('/sala/{slug}', 'SalasController@show')->middleware(['auth', 'verified'])->name('site.salas.show');
});