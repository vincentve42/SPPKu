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
        Schema::create("siswas", function (Blueprint $table) {
            $table->id();
            $table->string('nama')->default(null);
            $table->string('kelas')->default(null);;
            $table->string('absen')->default(null);;
            $table->string('nis')->default(null);;
            $table->timestamp('updated_at')->default(null);
            $table->timestamp('created_at')->default(null);;
            $table->bigInteger('kelas_id')->references('id')->on('kelas')->onDelete('cascade')->nullable();
            $table->bigInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('kategori')->default(null);;
            $table->integer('harga')->default(null);;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
