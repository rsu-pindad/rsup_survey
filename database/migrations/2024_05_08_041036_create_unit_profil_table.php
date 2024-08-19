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
        Schema::create('unit_profil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id')->unique();
            $table->string('unit_main_logo')->nullable();
            $table->string('unit_sub_logo')->nullable();
            $table->string('unit_alamat')->nullable();
            $table->string('unit_motto')->nullable();
            $table->foreign('unit_id')->references('id')->on('unit')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_profil');
    }
};
