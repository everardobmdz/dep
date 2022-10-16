<?php

use App\Http\Controllers\Admin\ContactoController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvestigadorController;
use App\Http\Controllers\Admin\LibroController;
use App\Http\Controllers\Admin\LineaInvestigacionController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\ProyectoActualController;
use App\Http\Controllers\Admin\PublicacionController;
use App\Http\Controllers\Admin\RedController;
use App\Http\Controllers\Admin\SliderItemController;
use App\Http\Controllers\Admin\SobreDepController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\NoticiaArchivoController;
use App\Http\Controllers\PublicacionArchivoController;
use App\Models\Sobre_el_dep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::resource('/', HomeController::class);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('admin.home');
});

Route::resource('investigadores',InvestigadorController::class)->names('admin.investigadores');
Route::resource('proyectos-actuales',ProyectoActualController::class)->names('admin.proyectos-actuales');
Route::resource('lineas-investigacion',LineaInvestigacionController::class)->names('admin.lineas-investigacion');
Route::resource('publicaciones',PublicacionController::class)->names('admin.publicaciones');
Route::resource('redes',RedController::class)->names('admin.redes');
Route::resource('sobre-el-dep',SobreDepController::class)->names('admin.sobre-el-dep');
Route::resource('libros',LibroController::class)->names('admin.libros');
Route::resource('divisiones',DivisionController::class)->names('admin.divisiones');
Route::resource('contactos',ContactoController::class)->names('admin.contactos');
Route::resource('noticias',NoticiaController::class)->names('admin.noticias');
Route::resource('slider-items',SliderItemController::class)->names('admin.slider-items');
Route::resource('usuarios',UserController::class)->names('admin.usuarios');

Route::get('/delete-investigador/{investigador_id}',[InvestigadorController::class,'delete_investigador'])->name('delete-investigador');
Route::get('/delete-proyecto/{proyecto_id}',[ProyectoActualController::class,'delete_proyecto'])->name('delete-proyecto');
Route::get('/delete-linea-investigacion/{linea_id}',[LineaInvestigacionController::class,'delete_linea_investigacion'])->name('delete-linea-investigacion');
Route::get('/delete-publicacion/{publicacion_id}',[PublicacionController::class,'delete_publicacion'])->name('delete-publicacion');
Route::get('/delete-red/{red}',[RedController::class,'delete_red'])->name('delete-red');
Route::get('/delete-libro/{libro}',[LibroController::class,'delete_libro'])->name('delete-libro');
Route::get('/delete-division/{division}',[DivisionController::class,'delete_division'])->name('delete-division');
Route::get('/delete-contactos/{contacto}',[ContactoController::class,'delete_contacto'])->name('delete-contacto');
Route::get('/delete-noticia/{noticia}',[NoticiaController::class,'delete_noticia'])->name('delete-noticia');
Route::get('/delete-slider-item/{item}',[SliderItemController::class,'delete_slider_item'])->name('delete-slider-item');
Route::get('/delete-usuario/{usuario}',[UserController::class,'delete_usuario'])->name('delete-usuario');
Route::get('publicaciones/delete-archivo/{archivo_id}',[PublicacionArchivoController::class,'delete_archivo'])->name('publicacion-delete-archivo');
Route::get('noticias/delete-archivo/{archivo_id}',[NoticiaArchivoController::class,'delete_archivo'])->name('noticia-delete-archivo');
