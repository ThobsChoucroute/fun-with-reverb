<?php

use App\Http\Controllers\DeploymentController;
use Illuminate\Support\Facades\Route;

Route::controller(DeploymentController::class)->group(function () {
    Route::get("/", "index")->name("deployments.index");
    Route::post("deployments/{deployment}/deploy", "deploy")->name("deployments.deploy");
});
