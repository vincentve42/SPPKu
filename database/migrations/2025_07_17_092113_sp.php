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
         Schema::create("sp", function (Blueprint $table) {
            $table->id();
            $table->timestamp("created_at");
            $table->timestamp("updated_at");
            $table->string('nis')->default(null);;
            // Relation
            $table->string("nama_siswa");
            $table->string("keterangan");
            $table->integer("surat");
            $table->json("image");
            $table->string("kelas_siswa");
            $table->bigInteger("user_id")->references('id')->on("users")->onDelete("cascade");
            $table->bigInteger("siswa_id")->references('id')->on("siswas")->onDelete("cascade");



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("sp");
    }
};
