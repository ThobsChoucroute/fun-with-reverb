<?php

namespace App\Models;

use App\Enums\Status;
use App\Jobs\DeployProcess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "status",
        "pending",
    ];

    protected $casts = [
        "status" => Status::class,
        "pending" => 'boolean',
    ];

    public function deploy()
    {
        $this->update([
            "pending" => true,
        ]);

        DeployProcess::dispatch($this);
    }
}
