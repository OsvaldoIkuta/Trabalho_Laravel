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

/*Route::get('welcome/{name?}', function($name = 'visitante'){
	return "Seja bem vindo $name!";
} );*/

/*Route::get('welcome/{name}', function($name){
	return "Seja bem vindo $name!";
})->where('name','[A-Za-z]+'); 

Route::get('hello', function(){
	return "hello world";
});

Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/contato', 'Site\SiteController@contato');
Route::get('/empresa', 'Site\SiteController@empresa');
Route::get('/post', 'Site\SiteController@post');
Route::get('/categoria', 'Site\SiteController@categoria');
Route::get('/', 'Site\SiteController@index');

Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function () {
    Route::any('/usuarios/pesquisar', 'Painel\UserController@search')->name('usuarios.search');
    Route::resource('/usuarios', 'Painel\UserController');

    Route::any('/categorias/pesquisar', 'Painel\CategoryController@search')->name('categorias.search');
    Route::resource('/categorias', 'Painel\CategoryController');

    Route::any('/posts/pesquisar', 'Painel\PostController@search')->name('posts.search');
    Route::resource('/posts', 'Painel\PostController');
});


/*

Route::get('/sobre', 'PageController@sobre');

Route::get('site', function() {
    return  view('site.index');
});

Route::get('/amigos', 'PageController@amigos');

Route::get('/', 'PageController@index');*/


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
