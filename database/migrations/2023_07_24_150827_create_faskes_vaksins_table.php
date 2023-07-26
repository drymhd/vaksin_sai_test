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
        Schema::create('faskes_vaksins', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('faskes_id');
            $table->foreign('faskes_id')->references('id')->on('faskes')->onDelete('cascade');
            $table->unsignedBigInteger('vaksin_id');
            $table->foreign('vaksin_id')->references('id')->on('vaksins')->onDelete('cascade');
            $table->integer('kuota')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faskes_vaksins');
    }
};
