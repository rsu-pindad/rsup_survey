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
        Schema::create('unit_multi_layanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('layanan_id');
            $table->tinyInteger('urutan_multi_layanan')->nullable()->default(null);
            $table
                ->foreign('unit_id')
                ->references('id')
                ->on('unit')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('layanan_id')
                ->references('id')
                ->on('layanan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_multi_layanan');
    }
};
