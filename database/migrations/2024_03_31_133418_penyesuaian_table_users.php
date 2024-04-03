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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger("area_id")->nullable(false);
            $table->string("nik")->unique();
            $table->text("address")->nullable();
            $table->string("phone")->nullable();
            $table->string("avatar")->nullable();
            $table->enum("status", [1, 0]);
            $table->foreign("area_id")->on("area_groups")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("nik");
            $table->dropColumn("address");
            $table->dropColumn("phone");
            $table->dropColumn("avatar");
            $table->dropColumn("status");
        });
    }
};
