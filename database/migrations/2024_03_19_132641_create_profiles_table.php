<?php

use App\Models\Profile;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('last_name')->nullable();
            $table->string('about')->nullable();
            $table->text('skills')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('phone')->nullable();
            $table->integer('views')->default(0);
            $table->enum('category', Profile::$categories);
            $table->enum('location', Profile::$locations);
            $table->string('profile_photo')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
