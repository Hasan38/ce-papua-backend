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
        Schema::create('area_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("regional_id")->nullable(false);
            $table->string('name', 100)->nullable(false)->unique();
            $table->string('lat', 100)->nullable();
            $table->string('long', 100)->nullable();
            $table->timestamps();
            $table->foreign("regional_id")->on("regionals")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_groups');
    }
};
