<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestigadorController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\NoticiaArchivoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\SobreDepController;
use App\Models\Red;
use Illuminate\Support\Facades\Auth;
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

Route::resource('/', HomeController::class);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    
});

Auth::routes();

Route::get('/creditos',function(){
    $redes = Red::where('activo',1)->orderBy('id')->get();
    return view('creditos',compact('redes'));
})->name('creditos');

Route::resource('noticias', NoticiaController::class)->names('noticias');
Route::resource('sobre-el-dep',SobreDepController::class);
Route::resource('investigadores',InvestigadorController::class)->names('investigadores');
Route::resource('libros', LibroController::class)->names('libros');
Route::resource('publicaciones',PublicacionController::class)->names('publicaciones');
Route::resource('busqueda',BusquedaController::class)->names('busqueda');
Route::get('app',[AppController::class,'index'])->name('app.index');

Route::get('/files/{filename}', [NoticiaArchivoController::class,'download']);
