<?php

namespace App\Jobs\Survey;

use App\Models\SurveyPelanggan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MultiInsertPasien implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $failOnTimeout = true;

    // public $uniqueFor = 3600;
    public $data = [];

    /**
     * Create a new job instance.
     */
    public function __construct($dataNilai)
    {
        $this->data = $dataNilai;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            foreach ($this->data as $value) {
                SurveyPelanggan::create($value);
            }
        } catch (\Throwable $th) {
            Log::channel('daily')->error($th->getMessage());
        }
    }

    public function failed(): void
    {
        $this->release();
    }
}
