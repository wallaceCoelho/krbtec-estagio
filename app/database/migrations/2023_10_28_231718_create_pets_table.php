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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->decimal('weight');
            $table->string('size')->nullable(false);
            $table->string('age')->nullable(false);
            $table->string('desc_pets')->nullable(false);
            $table->boolean('status')->nullable(false);
            $table->foreignId('specie_id')->constrained( 
                table: 'species'
            );
            $table->foreignId('breed_id')->constrained( 
                table: 'breed'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
