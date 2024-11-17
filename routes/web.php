<?php

use App\Http\Controllers\DispatcheController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;


Route::middleware("cache.headers:no-store")->group(function () {
    Route::redirect("/", "login");
    Route::get("/login", function () {
        return view("login");
    })->name("login");
    Route::post("login", [LoginController::class, "login"]);
    Route::group(["middleware" => "auth", "prefix" => "/admin"], function () {
        Route::get("/", function () {
            return view("menu");
        })->name("menu");
        Route::resource("worker", WorkerController::class);
        Route::resource("event", EventController::class);
        Route::resource("dispatche", DispatcheController::class);
        Route::post("logout", [LoginController::class, "logout"])->name("logout");
    });
});