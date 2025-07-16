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
        Schema::create("kelas", function (Blueprint $table) {
            $table->id();
            $table->string("nama")->default(null);
            $table->bigInteger("harga")->default(null);
            $table->bigInteger("user_id")->references("id")->on("users")->onDelete('cascade');   
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('kelas');
    }
};
