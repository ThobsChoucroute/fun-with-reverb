<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeploymentController;

Route::controller(DeploymentController::class)->group(function () {
    Route::get("/", "index")->name("deployments.index");
});
