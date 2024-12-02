<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pulse_aggregates');
        Schema::dropIfExists('pulse_entries');
        Schema::dropIfExists('pulse_values');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pulse_aggregates');
        Schema::dropIfExists('pulse_entries');
        Schema::dropIfExists('pulse_values');
        Schema::enableForeignKeyConstraints();
    }
};
