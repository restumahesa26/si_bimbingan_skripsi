<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBimbingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->references('id')->on('users');
            $table->foreignId('mahasiswa_id')->references('id')->on('users');
            $table->string('bab_pembahasan');
            $table->text('uraian_konsultasi');
            $table->string('file_mahasiswa');
            $table->string('file_dosen')->nullable();
            $table->text('komentar_dosen')->nullable();
            $table->enum('status', ['ACC',"Revisi","Terkirim","Dibaca"])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bimbingans');
    }
}
