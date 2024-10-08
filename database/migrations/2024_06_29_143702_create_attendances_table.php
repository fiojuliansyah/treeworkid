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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('latlong')->nullable();
            $table->string('user_id')->nullable();
            $table->string('site_id')->nullable();
            $table->string('imagein_url')->nullable();
            $table->string('imagein_public_id')->nullable();
            $table->string('clock_in')->nullable();
            $table->string('imageout_url')->nullable();
            $table->string('imageout_public_id')->nullable();
            $table->string('clock_out')->nullable();
            $table->string('type')->nullable();
            $table->string('is_reliver')->nullable();
            $table->string('backup_id')->nullable();
            $table->string('leave_id')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
