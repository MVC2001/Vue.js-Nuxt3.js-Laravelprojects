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
        Schema::create('all_requests', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('category');
        $table->decimal('price');
        $table->text('description');
        $table->text('accountno');
        $table->text('paymethod');
        $table->text('amount');
         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_requests');
    }
};
