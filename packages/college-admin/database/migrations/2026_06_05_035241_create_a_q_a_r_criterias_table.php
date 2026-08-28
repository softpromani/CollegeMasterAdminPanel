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
        Schema::create('a_q_a_r_criterias', function (Blueprint $table) {
            $table->id();
          $table->unsignedBigInteger('aqar_id');
            $table->string('criteria_name');
            $table->string('criteria_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_q_a_r_criterias');
    }
};
