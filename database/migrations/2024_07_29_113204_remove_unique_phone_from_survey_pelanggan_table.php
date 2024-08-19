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
        Schema::dropIfExists('survey_pelanggan');
        Schema::create('survey_pelanggan', function (Blueprint $table) {
            // $table->dropUnique('survey_pelanggan_handphone_pelanggan_unique');
            // $table->string('nilai_skor')->nullable()->change();
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->unsignedBigInteger('penjamin_id');
            $table->unsignedBigInteger('layanan_id');
            $table->string('nama_pelanggan')->nullable();
            $table->string('handphone_pelanggan')->nullable();
            $table->enum('shift', ['pagi','siang','malam']);
            $table->string('nilai_skor')->nullable();
            $table->dateTimeTz('survey_masuk', $precision = 0);
            $table->foreign('karyawan_id')->references('id')->on('karyawanprofile')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        // Schema::dropIfExists('survey_pelanggan');
        // Schema::table('survey_pelanggan', function (Blueprint $table) {
        //     // $table->addUnique('survey_pelanggan_handphone_pelanggan_unique');
        //     // $table->unique('handphone_pelanggan','survey_pelanggan');
        //     // $table->tinyInteger('nilai_skor')->default(0)->change();
        // });
    }
};
