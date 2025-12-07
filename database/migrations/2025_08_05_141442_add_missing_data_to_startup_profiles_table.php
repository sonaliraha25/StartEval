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
    Schema::table('startup_profiles', function (Blueprint $table) {
        $table->boolean('has_missing_data')->default(false);
        $table->text('missing_fields')->nullable(); // or use ->json() if you're on MySQL 5.7+ or PostgreSQL
    });
}

public function down()
{
    Schema::table('startup_profiles', function (Blueprint $table) {
        $table->dropColumn('has_missing_data');
        $table->dropColumn('missing_fields');
    });
}

};
