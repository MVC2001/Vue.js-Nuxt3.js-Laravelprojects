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
        Schema::create('smans', function (Blueprint $table) {
        $table->id();
        $table->string('fullname');
        $table->string('address');
        $table->decimal('contact');
        $table->text('gender');
        $table->string('image')->nullable();
        $table->text('role');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smans');
    }
};
