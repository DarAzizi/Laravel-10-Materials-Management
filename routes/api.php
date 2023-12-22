<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\NatureController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\ContractorController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\SubLocationController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\CityProjectsController;
use App\Http\Controllers\Api\CountryCitiesController;
use App\Http\Controllers\Api\UserWarehousesController;
use App\Http\Controllers\Api\SubSubLocationController;
use App\Http\Controllers\Api\SubSubCategoryController;
use App\Http\Controllers\Api\ProjectWarehousesController;
use App\Http\Controllers\Api\SubSubSubLocationController;
use App\Http\Controllers\Api\SubSubSubCategoryController;
use App\Http\Controllers\Api\ContractorProjectsController;
use App\Http\Controllers\Api\WarehouseLocationsController;
use App\Http\Controllers\Api\LocationSubLocationsController;
use App\Http\Controllers\Api\CategorySubCategoriesController;
use App\Http\Controllers\Api\SubLocationSubSubLocationsController;
use App\Http\Controllers\Api\SubCategorySubSubCategoriesController;
use App\Http\Controllers\Api\SubSubLocationSubSubSubLocationsController;
use App\Http\Controllers\Api\SubSubCategorySubSubSubCategoriesController;

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

        // User Warehouses
        Route::get('/users/{user}/warehouses', [
            UserWarehousesController::class,
            'index',
        ])->name('users.warehouses.index');
        Route::post('/users/{user}/warehouses', [
            UserWarehousesController::class,
            'store',
        ])->name('users.warehouses.store');

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

        // Project Warehouses
        Route::get('/projects/{project}/warehouses', [
            ProjectWarehousesController::class,
            'index',
        ])->name('projects.warehouses.index');
        Route::post('/projects/{project}/warehouses', [
            ProjectWarehousesController::class,
            'store',
        ])->name('projects.warehouses.store');

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

        Route::apiResource('warehouses', WarehouseController::class);

        // Warehouse Locations
        Route::get('/warehouses/{warehouse}/locations', [
            WarehouseLocationsController::class,
            'index',
        ])->name('warehouses.locations.index');
        Route::post('/warehouses/{warehouse}/locations', [
            WarehouseLocationsController::class,
            'store',
        ])->name('warehouses.locations.store');

        Route::apiResource('locations', LocationController::class);

        // Location Sub Locations
        Route::get('/locations/{location}/sub-locations', [
            LocationSubLocationsController::class,
            'index',
        ])->name('locations.sub-locations.index');
        Route::post('/locations/{location}/sub-locations', [
            LocationSubLocationsController::class,
            'store',
        ])->name('locations.sub-locations.store');

        Route::apiResource('sub-locations', SubLocationController::class);

        // SubLocation Sub Sub Locations
        Route::get('/sub-locations/{subLocation}/sub-sub-locations', [
            SubLocationSubSubLocationsController::class,
            'index',
        ])->name('sub-locations.sub-sub-locations.index');
        Route::post('/sub-locations/{subLocation}/sub-sub-locations', [
            SubLocationSubSubLocationsController::class,
            'store',
        ])->name('sub-locations.sub-sub-locations.store');

        Route::apiResource(
            'sub-sub-locations',
            SubSubLocationController::class
        );

        // SubSubLocation Sub Sub Sub Locations
        Route::get(
            '/sub-sub-locations/{subSubLocation}/sub-sub-sub-locations',
            [SubSubLocationSubSubSubLocationsController::class, 'index']
        )->name('sub-sub-locations.sub-sub-sub-locations.index');
        Route::post(
            '/sub-sub-locations/{subSubLocation}/sub-sub-sub-locations',
            [SubSubLocationSubSubSubLocationsController::class, 'store']
        )->name('sub-sub-locations.sub-sub-sub-locations.store');

        Route::apiResource(
            'sub-sub-sub-locations',
            SubSubSubLocationController::class
        );

        Route::apiResource('categories', CategoryController::class);

        // Category Sub Categories
        Route::get('/categories/{category}/sub-categories', [
            CategorySubCategoriesController::class,
            'index',
        ])->name('categories.sub-categories.index');
        Route::post('/categories/{category}/sub-categories', [
            CategorySubCategoriesController::class,
            'store',
        ])->name('categories.sub-categories.store');

        Route::apiResource('sub-categories', SubCategoryController::class);

        // SubCategory Sub Sub Categories
        Route::get('/sub-categories/{subCategory}/sub-sub-categories', [
            SubCategorySubSubCategoriesController::class,
            'index',
        ])->name('sub-categories.sub-sub-categories.index');
        Route::post('/sub-categories/{subCategory}/sub-sub-categories', [
            SubCategorySubSubCategoriesController::class,
            'store',
        ])->name('sub-categories.sub-sub-categories.store');

        Route::apiResource(
            'sub-sub-categories',
            SubSubCategoryController::class
        );

        // SubSubCategory Sub Sub Sub Categories
        Route::get(
            '/sub-sub-categories/{subSubCategory}/sub-sub-sub-categories',
            [SubSubCategorySubSubSubCategoriesController::class, 'index']
        )->name('sub-sub-categories.sub-sub-sub-categories.index');
        Route::post(
            '/sub-sub-categories/{subSubCategory}/sub-sub-sub-categories',
            [SubSubCategorySubSubSubCategoriesController::class, 'store']
        )->name('sub-sub-categories.sub-sub-sub-categories.store');

        Route::apiResource(
            'sub-sub-sub-categories',
            SubSubSubCategoryController::class
        );

        Route::apiResource('natures', NatureController::class);
    });
