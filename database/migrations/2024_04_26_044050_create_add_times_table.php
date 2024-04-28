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
        Schema::create('add_times', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('start_hour');
            $table->string('start_minute');
            $table->string('end_hour');
            $table->string('end_minute');
            $table->unsignedBigInteger('clinic_id');
            $table->boolean('is_saved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_times');
    }
};
