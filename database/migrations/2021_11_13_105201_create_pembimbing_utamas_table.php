<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembimbingUtamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembimbing_utamas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->references('id')->on('users');
            $table->foreignId('mahasiswa_id')->references('id')->on('users');
            $table->enum('status_persetujuan', ['0','1'])->default('0');
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
        Schema::dropIfExists('pembimbing_utamas');
    }
}
