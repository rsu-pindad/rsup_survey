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
        Schema::create('respon', function (Blueprint $table) {
            $table->id();
            $table->string('nama_respon');
            $table->string('icon_respon');
            $table->string('tag_warna_respon');
            $table->tinyInteger('skor_respon');
            $table->tinyInteger('urutan_respon');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respon');
    }
};
