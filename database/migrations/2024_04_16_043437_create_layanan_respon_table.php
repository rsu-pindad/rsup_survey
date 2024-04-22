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
        Schema::create('layanan_respon', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('layanan_id')->unique()->constrained();
            $table->unsignedBigInteger('layanan_id');
            $table->unsignedBigInteger('respon_id');
            $table->foreign('layanan_id')->references('id')->on('layanan')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('respon_id')->references('id')->on('respon')
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
        Schema::dropIfExists('layanan_respon');
    }
};
