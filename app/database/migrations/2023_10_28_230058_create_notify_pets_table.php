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
        Schema::create('notify_pets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('cpf')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->date('dt_birth')->nullable(false);
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
        Schema::dropIfExists('notify_pets');
    }
};
