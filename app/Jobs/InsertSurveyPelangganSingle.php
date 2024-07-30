<?php

namespace App\Jobs;

use App\Models\SurveyPelanggan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;

class InsertSurveyPelangganSingle implements ShouldQueue
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
        // DB::table('survey_pelanggan')->insert([
        //     $this->items
        // ]);
        SurveyPelanggan::create($this->items);
    }

    public function failed(?Throwable $exception): void
    {
        $this->info($exception);
    }
}
