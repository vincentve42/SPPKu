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
         Schema::create("nilai", function (Blueprint $table) {
            $table->id();
            $table->timestamp("created_at");
            $table->timestamp("updated_at");
            $table->string('nis')->default(null);;
            // Relation
            $table->string("nama_siswa");
            $table->string("mata_pelajaran");
            $table->string("kelas_siswa");
            $table->bigInteger("user_id")->references('id')->on("users")->onDelete("cascade");
            $table->bigInteger("siswa_id")->references('id')->on("siswas")->onDelete("cascade");
            $table->bigInteger("mata_id")->references('id')->on("mapel")->onDelete("cascade");
            $table->float('nilai')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("nilai");
    }
};
