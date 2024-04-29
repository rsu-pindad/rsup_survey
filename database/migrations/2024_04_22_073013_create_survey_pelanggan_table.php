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
        Schema::create('survey_pelanggan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->unsignedBigInteger('penjamin_layanan_id');
            $table->string('nama_pelanggan');
            $table->string('handphone_pelanggan')->unique();
            $table->enum('shift', ['pagi','siang','malam']);
            $table->tinyInteger('nilai_skor')->default(0);
            $table->foreign('karyawan_id')->references('id')->on('karyawan')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('penjamin_layanan_id')->references('id')->on('penjamin_layanan')
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
        Schema::dropIfExists('survey_pelanggan');
    }
};
