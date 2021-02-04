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

// Route::get('/', function () {
//     return view('login');
// })->name('login');
Route::get('/',function(){
    if(auth()->user()){
        return redirect('home');
    }
    return view('auth.login');
})->name('login');

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create');
Route::get('/view', 'HomeController@view')->name('view');
Route::post('/store', 'HomeController@store')->name('store');
Route::get('/edit', 'HomeController@edit')->name('edit');
Route::post('/update', 'HomeController@update')->name('update');
Route::post('/delete', 'HomeController@delete')->name('delete');

});