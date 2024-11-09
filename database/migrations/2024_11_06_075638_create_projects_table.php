<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The user who owns the project
            $table->string('name'); // Project name
            $table->text('description')->nullable(); // Project description
            $table->timestamp('start_date')->nullable(); // Start date of the project
            $table->timestamp('end_date')->nullable(); // End date of the project
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
