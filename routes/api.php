<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ContractorController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\CityProjectsController;
use App\Http\Controllers\Api\CountryCitiesController;
use App\Http\Controllers\Api\ContractorProjectsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        Route::apiResource('countries', CountryController::class);

        // Country Cities
        Route::get('/countries/{country}/cities', [
            CountryCitiesController::class,
            'index',
        ])->name('countries.cities.index');
        Route::post('/countries/{country}/cities', [
            CountryCitiesController::class,
            'store',
        ])->name('countries.cities.store');

        Route::apiResource('cities', CityController::class);

        // City Projects
        Route::get('/cities/{city}/projects', [
            CityProjectsController::class,
            'index',
        ])->name('cities.projects.index');
        Route::post('/cities/{city}/projects', [
            CityProjectsController::class,
            'store',
        ])->name('cities.projects.store');

        Route::apiResource('projects', ProjectController::class);

        Route::apiResource('contractors', ContractorController::class);

        // Contractor Projects
        Route::get('/contractors/{contractor}/projects', [
            ContractorProjectsController::class,
            'index',
        ])->name('contractors.projects.index');
        Route::post('/contractors/{contractor}/projects', [
            ContractorProjectsController::class,
            'store',
        ])->name('contractors.projects.store');
    });
