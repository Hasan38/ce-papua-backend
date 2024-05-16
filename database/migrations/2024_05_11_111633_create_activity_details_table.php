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
        Schema::create('activity_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("activity_id");
            $table->unsignedBigInteger("machine_id");
            $table->integer('status');
            $table->timestamps();
            $table->foreign("activity_id")->on("activities")->references("id");
            $table->foreign("machine_id")->on("machines")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_details');
    }
};
