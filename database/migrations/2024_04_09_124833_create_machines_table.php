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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customer_id")->nullable(false);
            $table->string('customer_type', 100)->nullable(false);
            $table->unsignedBigInteger("area_id")->nullable(false);
            $table->string('branch', 150);
            $table->string('terminal_id',100)->index();
            $table->string('sn',100)->index()->unique();
            $table->string('machine_type',100);
            $table->string('address')->nullable(false);
            $table->integer('zona')->nullable(false);
            $table->string('service_status')->nullable(false);
            $table->string('pengelola')->nullable(false);
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->timestamps();
            $table->foreign("customer_id")->on("customers")->references("id");
            $table->foreign("area_id")->on("area_groups")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
