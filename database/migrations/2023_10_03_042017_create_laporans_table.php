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
        Schema::create('laporan', function (Blueprint $table) {
            $table->uuid('id_laporan')->primary();
            $table->foreignUuid('id_kasir');
            $table->foreign('id_kasir')->references('id_karyawan')->on('karyawan');
            $table->foreignUuid('id_manager');
            $table->foreign('id_manager')->references('id_karyawan')->on('karyawan');
            $table->foreignUuid('id_akun');
            $table->foreign('id_akun')->references('id_akun')->on('akun');
            $table->foreignUuid('id_klasifikasi');
            $table->foreign('id_klasifikasi')->references('id_klasifikasi')->on('klasifikasi_laporan');
            $table->foreignUuid('id_usaha');
            $table->foreign('id_usaha')->references('id_usaha')->on('usaha');
            $table->foreignUuid('id_sub_akun_1')->nullable();
            $table->foreign('id_sub_akun_1')->references('id_sub_akun_1')->on('sub_akun_1');
            $table->foreignUuid('id_sub_akun_2')->nullable();
            $table->foreign('id_sub_akun_2')->references('id_sub_akun_2')->on('sub_akun_2');
            $table->foreignUuid('id_sub_akun_3')->nullable();
            $table->foreign('id_sub_akun_3')->references('id_sub_akun_3')->on('sub_akun_3');
            $table->foreignUuid('id_sub_akun_4')->nullable();
            $table->foreign('id_sub_akun_4')->references('id_sub_akun_4')->on('sub_akun_4');
            $table->foreignUuid('id_sub_akun_5')->nullable();
            $table->foreign('id_sub_akun_5')->references('id_sub_akun_5')->on('sub_akun_5');
            $table->string('kode_laporan');
            $table->timestamp('tanggal_laporan');
            $table->string('nominal');
            $table->string('gambar_bukti');
            $table->string('status_cek');
            $table->timestamp('tanggal_cek')->nullable();
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
