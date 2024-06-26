<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Revolution\Google\Sheets\Facades\Sheets;

class GoogleSheetInsert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $items = [];

    /**
     * Create a new job instance.
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Sheets::spreadsheet(config('google.config.sheet_id'))
            ->sheet(config('google.config.sheet_name'))
            ->append($this->items);
    }
}
