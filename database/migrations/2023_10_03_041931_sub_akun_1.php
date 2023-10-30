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
        Schema::create('sub_akun_1', function (Blueprint $table) {
            $table->uuid('id_sub_akun_1')->primary();
            $table->foreignUuid('id_akun');
            $table->foreign('id_akun')->references('id_akun')->on('akun');
            $table->string('sub_akun_1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_akun_1');
    }
};
