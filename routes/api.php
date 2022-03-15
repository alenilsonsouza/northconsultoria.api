<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\{
    AuthController,
    LeadController,
    RegisterController,
    PlanController,
    UserController,
    AddressController,
    FileController,
    AsaasController
};
use Illuminate\Support\Facades\Artisan;

// Comandos via rota
Route::get('/storage', function (){
    Artisan::call('storage:link');
});

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('/401', [AuthController::class, 'unauthorized'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/registerpeople', [RegisterController::class, 'insert']);
Route::get('/register/{id}/{type}', [RegisterController::class, 'getOne']);
Route::get('/verifycpf/{cpf}', [RegisterController::class, 'verifyCPF']);
Route::get('/verifyemail/{email}', [RegisterController::class, 'verifyEmail']);

Route::get('/plan/{id}', [PlanController::class, 'getOne']);

Route::post('/address', [AddressController::class, 'insert']);

Route::post('/file', [FileController::class, 'insert']);

// Vindo do Asaas
Route::post('/storageasaas', [AsaasController::class, 'storageAsaas']);

Route::middleware('auth:api')->group(function () {
    Route::post('/auth/validate', [AuthController::class, 'validateToken']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/leads', [LeadController::class, 'getList']);

    Route::get('/users', [UserController::class, 'getList']);
    Route::get('/userlogged', [UserController::class, 'getOne']);
    Route::post('/users', [UserController::class, 'insert']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
});


