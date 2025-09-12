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
        Schema::create('table_message', function (Blueprint $table) {
            $table->id(); // Kolom ID (primary key)
            $table->string('name'); // Kolom nama dengan tipe string
            $table->string('email'); // Kolom email dengan tipe string
            $table->text('message'); // Kolom pesan dengan tipe teks
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_message');
    }
};
