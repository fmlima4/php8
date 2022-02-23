<?php

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
Route::get('/series', 'SeriesController@index')
    ->name('listar_series');
Route::get('/series/criar', 'SeriesController@create')
    ->name('form_criar_serie')
    ->middleware('autenticador');
Route::post('/series/criar', 'SeriesController@store')
    ->middleware('autenticador');
Route::delete('/series/{id}', 'SeriesController@destroy')
    ->middleware('autenticador');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');

Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
    ->middleware('autenticador');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});

Route::get('/view_email', function () {
    return new \App\Mail\NovaSerie($nome = 'teste', $qtdTemporadas = '5',$qtdEps = '10');
});

Route::get('/send_email', function () {
    $email = new \App\Mail\NovaSerie($nome = 'teste', $qtdTemporadas = '5',$qtdEps = '10');

    $email->subject = 'Nova serie Adicionada';

    $user = (object)[
        'email' => 'felipe@teste.com',
        'name' => 'felipe'
    ];

    \Illuminate\Support\Facades\Mail::to($user)->send($email);
    return 'email enviado';
});
