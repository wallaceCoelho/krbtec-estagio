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
        Schema::create('gallery_pets', function (Blueprint $table) {
            $table->id();
            $table->string('img_header')->nullable(false);
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
            $table->string('img4');
            $table->foreignId('pets_id')->constrained(
                table: 'pets'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery__pets');
    }
};
