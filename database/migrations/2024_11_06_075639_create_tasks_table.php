<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // The project that the task belongs to
            $table->string('title'); // Task title
            $table->text('description')->nullable(); // Task description
            $table->enum('status', ['to_do', 'in_progress', 'completed'])->default('to_do'); // Status of the task
            $table->timestamp('due_date')->nullable(); // Due date of the task
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
