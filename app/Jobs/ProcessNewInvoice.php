<?php

namespace App\Jobs;

use App\Actions\CreateNewInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNewInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $invoiceItems;
    /**
     * Create a new job instance.
     */
    public function __construct($name, $invoiceItems)
    {
        $this->name = $name;
        $this->invoiceItems = $invoiceItems;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new CreateNewInvoice)->execute(
            $this->name,
            $this->invoiceItems,
        );
    }
}
