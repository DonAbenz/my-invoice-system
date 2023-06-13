<?php

namespace App\Jobs;

use App\Actions\UpdateInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessInvoiceUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoiceCode;
    protected $name;
    protected $invoiceItems;
    /**
     * Create a new job instance.
     */
    public function __construct($invoiceCode, $name, $invoiceItems)
    {
        $this->invoiceCode = $invoiceCode;
        $this->name = $name;
        $this->invoiceItems = $invoiceItems;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new UpdateInvoice)->execute(
            $this->invoiceCode,
            $this->name,
            $this->invoiceItems,
        );
    }
}
