<?php

namespace App\Jobs;

use App\Enums\Status;
use App\Events\DeploymentUpdated;
use App\Models\Deployment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DeployProcess implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Deployment $deployment)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach (Status::cases() as $status) {
            sleep(2);

            $this->deployment->update([
                "status" => $status->value,
            ]);

            DeploymentUpdated::dispatch($this->deployment);
        }

        $this->deployment->update([
            "pending" => false,
        ]);

        DeploymentUpdated::dispatch($this->deployment);
    }
}
