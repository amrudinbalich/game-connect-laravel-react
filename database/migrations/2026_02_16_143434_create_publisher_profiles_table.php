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
        // all fields are optionable
        Schema::create('publisher_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable(); // picks user.name by default
            $table->text('summary')->nullable();
            $table->string('website_url')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publisher_profiles');
    }
};
