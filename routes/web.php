<?php

use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\CaracteristicasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DetallesController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\EspecificacionesController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\SlidersController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcomed');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

*/



require __DIR__ . '/auth.php';

//usuario
Route::get('/', [PrincipalController::class, 'principal'])->name('principal');
Route::get('/admin/dashboard', [PrincipalController::class, 'index'])->name('admin.dashboard');
Route::get('/categorias/listar/{id}', [CategoriasController::class, 'u_categoriasListar'])->name('user.categorias.listar');
Route::get('/productos/ver/{id}', [ProductosController::class, 'u_productosver'])->name('user.productos.ver');

// sucursales
Route::get('/admin/sucursal/listar', [SucursalesController::class, 'sucursales_listar'])->name('admin.sucursales.listar');
Route::get('/admin/sucursal/ver/{id}', [SucursalesController::class, 'sucursales_ver'])->name('admin.sucursales.ver');
Route::post('/admin/sucursal/registrar', [SucursalesController::class, 'sucursales_registrar'])->name('admin.sucursales.registrar');
Route::post('/admin/sucursal/editar', [SucursalesController::class, 'sucursales_editar'])->name('admin.sucursales.editar');
Route::post('/admin/sucursales/editar-horarios', [SucursalesController::class, 'editarHorarios'])->name('admin.sucursales.editarHorarios');
Route::delete('/admin/sucursal/eliminar', [SucursalesController::class, 'sucursales_eliminar'])->name('admin.sucursales.eliminar');
Route::get('/admin/sucursales/categorias/productos/ver/{id}', [SucursalesController::class, 'sucursales_productos'])->name('admin.sucursales.categorias.productos.ver');
Route::get('/admin/sucursales/categorias/productos/articulos/listar/{id}', [SucursalesController::class, 'sucursales_productos_articulos'])->name('admin.sucursales.categorias.productos.articulos.listar');
Route::get('/admin/sucursales/categorias/productos/articulos/ver/{id}', [SucursalesController::class, 'sucursales_productos_articulos_ver'])->name('admin.sucursales.categorias.productos.articulos.ver');

//Tipos
Route::get('/admin/tipos/ver', [TiposController::class, 'tiposver'])->name('admin.tipos.ver');
Route::post('/admin/tipos/registrar', [TiposController::class, 'tiposregistrar'])->name('admin.tipos.registrar');
Route::post('/admin/tipos/editar', [TiposController::class, 'tiposeditar'])->name('admin.tipos.editar');
Route::delete('/admin/tipos/eliminar', [TiposController::class, 'tiposeliminar'])->name('admin.tipos.eliminar');

//Especificaciones
Route::get('/admin/especificaciones/ver', [EspecificacionesController::class, 'especificacionescrear'])->name('admin.especificaciones.ver');
Route::post('/admin/especificaciones/registrar', [EspecificacionesController::class, 'especificacionesregistrar'])->name('admin.especificaciones.registrar');
Route::get('/admin/especificaciones/editar', [EspecificacionesController::class, 'especificacioneseditar'])->name('admin.especificaciones.editar');
Route::delete('/admin/especificaciones/eliminar', [EspecificacionesController::class, 'especificacioneseliminar'])->name('admin.especificaciones.eliminar');

// Personas
Route::get('/admin/personas/listar', [PersonasController::class, 'personaslistar'])->name('admin.personas.listar');
Route::post('/admin/personas/registrar', [PersonasController::class, 'personasregistrar'])->name('admin.personas.registrar');
Route::post('/admin/personas/editar', [PersonasController::class, 'personaseditar'])->name('admin.personas.editar');
Route::get('/admin/personas/ver', [PersonasController::class, 'personasver'])->name('admin.personas.ver');

// Categorias
Route::get('/admin/categorias/listar', [CategoriasController::class, 'categoriaslistar'])->name('admin.categorias.listar');
Route::post('/admin/categorias/registrar', [CategoriasController::class, 'categoriasregistrar'])->name('admin.categorias.registrar');
Route::post('/admin/subcategorias/registrar', [CategoriasController::class, 'subcategoriasregistrar'])->name('admin.subcategorias.registrar');

Route::post('/admin/categorias/editar', [CategoriasController::class, 'categoriaseditar'])->name('admin.categorias.editar');

// Sucursal_Categorias
Route::post('/admin/sucursal_categoria/registrar', [SucursalesController::class, 'registrarsc'])->name('admin.sucursales_categorias.registrarsc');

Route::post('/admin/sucursales/{sucursal}/categorias/asociar', [SucursalesController::class, 'asociarCategorias'])->name('admin.sucursales.categorias.asociar');

// Sliders
Route::get('/admin/sliders/listar', [SlidersController::class, 'u_slidersSucursales'])->name('user.sliders.listar');
Route::get('/admin/sliders/sucursal/{id}', [SlidersController::class, 'porSucursal'])->name('user.sliders.porSucursal');
Route::post('/admin/sliders-registrar', [SlidersController::class, 'u_slidersRegistrarCategoria'])->name('user.sliders.registrar');
Route::post('/admin/sliders-actualizar', [SlidersController::class, 'u_slidersActualizarCategoria'])->name('user.sliders.actualizar');

// Productos
Route::get('/admin/productos/listar', [ProductosController::class, 'productosListar'])->name('admin.productos.listar');
Route::get('/admin/productos/{id}/caracteristicas', [ProductosController::class, 'getCaracteristicas'])->name('admin.productos.caracteristicas');
Route::get('/admin/productos/{id}/detalles', [ProductosController::class, 'getDetalles'])->name('admin.productos.detalles');
Route::get('/admin/productos/{id}/tipos-especificaciones', [ProductosController::class, 'getTiposEspecificaciones'])->name('admin.productos.tipos_especificaciones');
Route::get('/admin/productos/articulos/{id}/{sucursales_categorias_id}', [ProductosController::class, 'listarArticulosPorProducto'])->name('admin.productos.articulos.listar');
Route::post('/admin/productos/sucursales/registrar', [ProductosController::class, 'productoSucursalRegistrar'])->name('admin.productos.sucursales.registrar');


//Articulos
Route::post('/admin/articulos/registrar', [ArticulosController::class, 'articulosRegistrar'])->name('admin.articulos.registrar');
Route::post('/admin/articulos/sucursales/registrar', [ArticulosController::class, 'articuloSucursalRegistrar'])->name('admin.articulos.sucursales.registrar');
Route::post('/admin/articulos/sucursales/duplicar', [ArticulosController::class, 'articuloDuplicarSucursalRegistrar'])->name('admin.articulos.sucursales.duplicar');

//Detalles
Route::post('/admin/detalles/registrar', [DetallesController::class, 'registrardetalles'])->name('admin.registrar.detalles');
Route::post('/admin/detalles/editar-varios', [DetallesController::class, 'editardetalles'])->name('admin.editar.detalles');
Route::post('/admin/detalles/editar-uno', [DetallesController::class, 'editardetalle'])->name('admin.editar.detalle');
Route::post('/admin/detalles/eliminar-uno', [DetallesController::class, 'eliminarDetalle'])->name('admin.eliminar.detalle');

//caracteristicas
Route::post('/admin/caracteristicas/registrar', [CaracteristicasController::class, 'registrarcaracteristicas'])->name('admin.registrar.caracteristicas');
Route::post('/admin/caracteristicas/editar-varios', [CaracteristicasController::class, 'editarcaracteristicas'])->name('admin.editar.caracteristicas');
Route::post('/admin/caracteristicas/editar-uno', [CaracteristicasController::class, 'editarCaracteristica'])->name('admin.editar.caracteristica');
Route::post('/admin/caracteristicas/elimiar-uno', [CaracteristicasController::class, 'eliminarCaracteristica'])->name('admin.eliminar.caracteristica');
