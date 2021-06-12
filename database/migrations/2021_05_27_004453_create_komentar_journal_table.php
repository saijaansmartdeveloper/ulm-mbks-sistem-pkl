<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar_jurnal', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('komentar_jurnal');
            $table->string('status_updated')->nullable();
            $table->foreignUuid('jurnal_uuid')->nullable();
            $table->foreignUuid('dosen_uuid')->nullable();
            $table->timestamps();


            $table->foreign('dosen_uuid')->references('uuid')->on('dosen')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('jurnal_uuid')->references('uuid')->on('jurnal')->cascadeOnUpdate()->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komentar_journal');
    }
}
