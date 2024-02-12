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
        Schema::create('donaturs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('nama_outlet')->nullable();
            $table->text('alamat');
            $table->string('no_hp',20)->nullable();
            $table->string('no_rek',20)->nullable();
            $table->enum('jenkel',['L','P'])->default('L');
            $table->enum('status',['1','0'])->default('0');
            $table->text('map',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaturs');
    }
};
