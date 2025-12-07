<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email_verified_at', 'remember_token']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken(); // Adds `remember_token` as nullable string(100)
        });
    }
};
