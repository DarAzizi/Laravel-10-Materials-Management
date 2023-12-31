<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubLocationController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\JetPositionController;
use App\Http\Controllers\EquipmentCodeController;
use App\Http\Controllers\SubSubLocationController;
use App\Http\Controllers\SubSubCategoryController;
use App\Http\Controllers\SubSubSubLocationController;
use App\Http\Controllers\SubSubSubCategoryController;

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
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('cities', CityController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('contractors', ContractorController::class);
        Route::resource('warehouses', WarehouseController::class);
        Route::resource('locations', LocationController::class);
        Route::resource('sub-locations', SubLocationController::class);
        Route::resource('sub-sub-locations', SubSubLocationController::class);
        Route::resource(
            'sub-sub-sub-locations',
            SubSubSubLocationController::class
        );
        Route::resource('categories', CategoryController::class);
        Route::resource('sub-categories', SubCategoryController::class);
        Route::resource('sub-sub-categories', SubSubCategoryController::class);
        Route::resource(
            'sub-sub-sub-categories',
            SubSubSubCategoryController::class
        );
        Route::resource('natures', NatureController::class);
        Route::resource('equipment-codes', EquipmentCodeController::class);
        Route::resource('jets', JetController::class);
        Route::resource('jet-positions', JetPositionController::class);
        Route::resource('materials', MaterialController::class);
    });
