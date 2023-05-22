<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pengajuan_id')->nullable();
            $table->string('nomor_surat')->unique();
            $table->string('kategori')->nullable();
            $table->date('tanggal');
            $table->string('tujuan_surat');
            $table->string('perihal');
            $table->string('status')->default('Menunggu');
            $table->text('komentar')->nullable();
            $table->text('isi')->nullable();
            $table->string('berkas')->nullable();
            $table->string('ttd1')->nullable();
            $table->string('ttd2')->nullable();
            $table->string('ttd3')->nullable();
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
        Schema::dropIfExists('surat_keluars');
    }
};
