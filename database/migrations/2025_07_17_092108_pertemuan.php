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
        Schema::create("pertemuan", function (Blueprint $table) {
            $table->id();
            $table->timestamp("created_at");
            $table->timestamp("updated_at");
            // Relation
            $table->string("nama_siswa");
            $table->string("keterangan");
            $table->string("image")->nullable();
            $table->string("kelas_siswa");
            $table->integer('done')->default(0);
            $table->bigInteger("user_id")->references('id')->on("users")->onDelete("cascade");
            $table->bigInteger("siswa_id")->references('id')->on("siswas")->onDelete("cascade");



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("pertemuan");
    }
};
