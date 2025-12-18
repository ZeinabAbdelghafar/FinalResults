<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('seat_number')->unique();
            $table->string('student_name');
            $table->json('grades'); 
            $table->integer('passed_subjects')->default(0);
            $table->integer('failed_subjects')->default(0);
            $table->integer('total')->default(0);
            $table->float('overall_average')->default(0);
            $table->float('overall_averagee')->default(0);
            $table->string('grade')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
