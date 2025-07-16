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
        Schema::create("pembayarans", function(Blueprint $table)
        {
            $table->id();
            $table->timestamp("created_at");
            $table->timestamp("updated_at");
            $table->bigInteger("siswa_id")->references("id")->on("siswas");
            $table->bigInteger("harga");
            $table->string("nama_siswa");
            $table->string("nama_kategori");
            $table->string("dibayar");
            $table->string("image");
            $table->bigInteger("kelas_id")->references("id")->on("kelas");
            $table->bigInteger("user_id")->references("id")->on("users");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
