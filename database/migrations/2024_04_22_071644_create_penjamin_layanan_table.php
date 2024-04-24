<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjamin_layanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjamin_id');
            $table->unsignedBigInteger('layanan_id');
            $table->foreign('penjamin_id')->references('id')->on('penjamin')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('layanan_id')->references('id')->on('layanan')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjamin_layanan');
    }
};
