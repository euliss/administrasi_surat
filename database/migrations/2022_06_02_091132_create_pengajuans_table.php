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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('suratMasuk_id')->nullable();
            $table->string('kategori');
            $table->date('tanggal');
            $table->string('tujuan_surat');
            $table->string('perihal');
            $table->string('status')->default('Menunggu');
            $table->text('komentar')->nullable();
            $table->string('berkas')->nullable();
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
        Schema::dropIfExists('pengajuans');
    }
};
