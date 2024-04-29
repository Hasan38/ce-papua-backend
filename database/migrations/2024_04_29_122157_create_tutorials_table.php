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
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->json('machine_type')->index();
            $table->string('customer')->nullable();
            $table->enum('type', ['text', 'video'])->default('text');
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
            $table->foreign("user_id")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorials');
    }
};
