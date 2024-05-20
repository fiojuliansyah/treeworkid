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
        Schema::create('generates', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('allowance_one')->nullable();
            $table->string('allowance_two')->nullable();
            $table->string('allowance_three')->nullable();
            $table->string('allowance_four')->nullable();
            $table->string('allowance_five')->nullable();
            $table->string('allowance_six')->nullable();
            $table->string('allowance_seven')->nullable();
            $table->string('letter_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generates');
    }
};
