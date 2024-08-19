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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username')->unique();
            $table->string('given_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('family_name')->nullable();
            $table->string('nickname')->nullable();

            $table->date('birthdate')->nullable();
            $table->string('location')->nullable();
            $table->string('gender')->nullable();
            $table->bigInteger('contact')->nullable();

            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();

            $table->string('github_id')->nullable();
            $table->string('github_name')->nullable();
            $table->string('github_avatar_url')->nullable();
            $table->string('github_page_url')->nullable();
            $table->timestamp('github_joined_date')->nullable();

            $table->string('google_id')->nullable();
            $table->string('google_name')->nullable();
            $table->string('google_avatar_url')->nullable();

            $table->string('facebook_id')->nullable();
            $table->string('facebook_name')->nullable();
            $table->string('facebook_avatar_url')->nullable();
            $table->string('facebook_profile_url')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
