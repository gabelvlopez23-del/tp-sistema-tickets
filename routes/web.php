<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

// Ruta principal por defecto
Route::get('/', function () {
    return view('welcome');
});

// RUTAS DEL CRUD DE TICKETS (PROTEGIDAS POR AUTENTICACIÓN)
Route::middleware('auth')->group(function () {
    
    // Mapea automáticamente index, create, store, show, edit, update
    Route::resource('tickets', TicketController::class)->except(['destroy']);
    
    // Cuando Livewire intente redirigir a 'dashboard', lo mandamos al listado de tickets
    Route::get('/dashboard', [TicketController::class, 'index'])->name('dashboard');
    
    // Ruta personalizada de tipo PATCH para la acción específica de cerrar el ticket
    Route::patch('/tickets/{ticket}/cerrar', [TicketController::class, 'cerrar'])->name('tickets.cerrar');
});

// 💡 SOLUCIÓN: Volvemos a activar las rutas de login y registro de Laravel Breeze
require __DIR__.'/auth.php';
