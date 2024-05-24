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
        Schema::create('app_setting', function (Blueprint $table) {
            $table->id();
            $table->string('initial_domain_logo');
            $table->string('initial_header_logo');
            $table->string('initial_body_logo');
            $table->string('initial_body_text');
            $table->string('initial_moto_text');
            $table->string('initial_alamat_text');
            $table->softDeletes();
            $table->timestamps();
        });

        $data = [
            'initial_domain_logo' => 'default_domain.png',
            'initial_header_logo' => 'default_header.png',
            'initial_body_logo' => 'default_body.png',
            'initial_body_text' => 'mohon_isi_nama_unit',
            'initial_moto_text' => 'mohon_isi_motto_unit',
            'initial_alamat_text' => 'mohon_isi_alamat_unit',
        ];

        DB::table('app_setting')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_setting');
    }
};
