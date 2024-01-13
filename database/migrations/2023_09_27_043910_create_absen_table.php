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
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->foreign('NISN')->references('NISN')->on('siswa');
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->string('NISN');
            $table->date('tanggal');
            $table->string('status');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('id_kelas');


            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen');
    }
};
