<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Sale\SaleController;
use Illuminate\Support\Facades\Route;


// Route::get("/categories", [CategoryController::class, "index"]);
// Route::get("/categories/{term}", [CategoryController::class, "show"]);
// Route::post("/categories", [CategoryController::class, "store"]);
// Route::delete("/categories/{id}", [CategoryController::class, "destroy"]);
// Route::patch("/categories/{id}", [CategoryController::class, "update"]);

// ->except(["destroy", "update"]);



// Route::controller(AuthController::class)->group(function () {
//     Route::post('/auth/login', 'login');
// });


Route::post("/auth/login", [AuthController::class, "login"]);

// Route::middleware(["auth:sanctum", "role.admin"])->group(function () {

    Route::apiResource("categories", CategoryController::class);

    Route::apiResource("products", ProductController::class);

    Route::apiResource("sales", SaleController::class)
        ->only(["index", "store", "show"]);


    Route::controller(AuthController::class)->group(function () {
        Route::post('/auth/register', 'register');
        Route::post('/auth/logout', 'logout');
        Route::get('/auth/checkToken', 'checkToken');
    });
// });
