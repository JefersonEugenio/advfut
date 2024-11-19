<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Console\Scheduling\Event;

Route::get('/teste', [EventController::class, 'teste']);
Route::get('/', [EventController::class, 'index']);
Route::get('/adversary', [EventController::class, 'eventos']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/createteams', [EventController::class, 'createteams'])->middleware('auth');
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/eventscreateteam', [EventController::class, 'createteam']); //teste

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');

Route::get('/teamsdashboard', [EventController::class, 'teams'])->middleware('auth');
Route::get('/events/teamsedit/{id}', [EventController::class, 'teamsedit'])->middleware('auth');
Route::put('/events/teamsupdate/{id}', [EventController::class, 'teamsupdate'])->middleware('auth');
Route::delete('/teamsevents/{id}', [EventController::class, 'teamsdestroy'])->middleware('auth');

Route::get('/notifications', [EventController::class, 'notifications'])->name('notifications');

Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');