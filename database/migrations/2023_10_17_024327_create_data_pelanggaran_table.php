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
        Schema::create('data_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->string('NISN');
            $table->unsignedBigInteger('id_pelanggaran');
            $table->foreign('id_pelanggaran')->references('id')->on('pelanggaran');
            $table->foreign('NISN')->references('NISN')->on('siswa');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelanggaran');
    }
};
