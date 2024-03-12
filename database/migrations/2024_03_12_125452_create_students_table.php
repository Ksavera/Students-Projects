<?php

use App\Models\Student;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->text('about')->nullable();
            $table->text('skills')->nullable();
            $table->string('linkedin');
            $table->string('github');
            $table->string('phone')->nullable();
            $table->integer('views')->default(0);
            $table->enum('category', Student::$categories);
            $table->enum('location', Student::$locations);
            $table->string('photo_path')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
