<?php

namespace App\Http\Controllers;

use App\Models\Deployment;
use Inertia\Inertia;

class DeploymentController extends Controller
{
    public function index()
    {
        return Inertia::render("Dashboard", [
            "deployments" => Deployment::all(),
        ]);
    }

    public function deploy(Deployment $deployment)
    {
        $deployment->deploy();
    }
}
