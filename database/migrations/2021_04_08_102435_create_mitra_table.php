<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nama_mitra', 100);
            $table->string('divisi_mitra')->nullable();
            $table->text('alamat_mitra')->nullable();
            $table->string('penanggung_jawab_mitra');
            $table->string('pamong_mitra')->nullable();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone', 20)->nullable();
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
        Schema::dropIfExists('mitra');
    }
}
