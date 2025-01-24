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
        // Tabel Staff
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('jabatan_id');
            $table->string('email')->unique();
            $table->string('no_tlp')->unique();
            $table->timestamps();
        });   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
