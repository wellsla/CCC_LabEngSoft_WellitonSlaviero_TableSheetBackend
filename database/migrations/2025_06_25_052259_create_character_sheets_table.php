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
        Schema::create('character_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->foreignId('race_id')->constrained('races')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->string('name');
            $table->integer('level')->default(1);
            $table->integer('strength');
            $table->integer('dexterity');
            $table->integer('constitution');
            $table->integer('intelligence');
            $table->integer('wisdom');
            $table->integer('charisma');
            $table->integer('current_hit_points');
            $table->integer('max_hit_points');
            $table->integer('armor_class');
            $table->integer('initiative');
            $table->integer('speed');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('portrait_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_sheets');
    }
};
