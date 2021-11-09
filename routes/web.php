<?php

use App\Http\Livewire\Asistance\CloseAttendance;
use App\Http\Livewire\Asistance\CreateAttendance;
use App\Http\Livewire\Events\EventIndex;
use App\Http\Livewire\Events\EventShow;
use App\Http\Livewire\Users\UserIndex;
use App\Http\Livewire\Asistance\IndexAttendance;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Event
Route::get('ver_evento/{id}', EventShow::class)
    ->name('ver-evento');
Route::get('/eventos_index', EventIndex::class)->name('event.index');

// User
Route::get('/users', UserIndex::class)->name('user.index');

// Attendance
Route::middleware('guest')
    ->get('registrar_asistencias', CreateAttendance::class)
    ->name('attendance.create');
Route::middleware('guest')
    ->get('cerrar_asistencias', CloseAttendance::class)
    ->name('attendance.close');
Route::middleware('auth:sanctum')
    ->get('asistenicas_index', IndexAttendance::class)
    ->name('attendance.index');
