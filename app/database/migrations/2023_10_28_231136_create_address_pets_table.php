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
        Schema::create('address_pets', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('cep');
            $table->string('street');
            $table->string('neighborhood');
            $table->integer('number');
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
        Schema::dropIfExists('address_pets');
    }
};
