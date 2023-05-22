<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->date('tanggal');
            $table->string('kategori');
            $table->string('asal_surat');
            $table->string('perihal');
            $table->string('slug')->unique();
            $table->string('tujuan');
            $table->text('isi');
            $table->text('komentar');
            $table->string('berkas');
            $table->foreignId('user_id');
            $table->string('status')->default('menunggu');
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
        Schema::dropIfExists('arsips');
    }
};
