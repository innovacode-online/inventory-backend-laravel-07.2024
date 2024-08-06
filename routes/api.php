<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get("/categories", [CategoryController::class, "index"]);
Route::get("/categories/{term}", [CategoryController::class, "show"]);
Route::post("/categories", [CategoryController::class, "store"]);
Route::delete("/categories/{id}", [CategoryController::class, "destroy"]);
Route::patch("/categories/{id}", [CategoryController::class, "update"]);

Route::apiResource("products", ProductController::class);