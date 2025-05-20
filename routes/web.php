<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\InicioSesionController;

Route::view('/', 'frontend.inicio')->name('inicio');
Route::view('/nosotros', 'frontend.nosotros')->name('nosotros');
Route::get('/productos', [ProductoController::class, 'index']) ->name('productos');;
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.detalle');
Route::get('/categoria/{id}', [ProductoController::class, 'porCategoria'])->name('productos.categoria');
Route::get('/detalle_producto', function(){
    return view('detalle_productos');
});
Route::get('/carrito_de_compras', function () {
    return view('frontend.carrito_de_compras');})->name('carrito_de_compras');
Route::view('/contacto', 'frontend.contacto')->name(('contacto'));
Route::view('/login', 'frontend.login')->name('login');

//Esto es para conectar el boton de enviar
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

//Esto es para conectar el boton de enviar
Route::post('/iniciosesion/enviar', [InicioSesionController::class, 'enviar'])->name('iniciosesion.enviar');