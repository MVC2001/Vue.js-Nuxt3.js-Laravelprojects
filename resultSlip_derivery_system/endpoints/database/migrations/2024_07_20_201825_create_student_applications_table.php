<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('index_number');
            $table->date('year');
            $table->string('clearance_form');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_applications');
    }
}
