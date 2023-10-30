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
        Schema::create('sub_akun_5', function (Blueprint $table) {
            $table->uuid('id_sub_akun_5')->primary();
            $table->foreignUuid('id_sub_akun_4');
            $table->foreign('id_sub_akun_4')->references('id_sub_akun_4')->on('sub_akun_4');
            $table->string('sub_akun_5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_akun_5');
    }
};
