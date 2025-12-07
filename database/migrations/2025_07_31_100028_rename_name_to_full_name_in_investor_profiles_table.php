<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investor_profiles', function (Blueprint $table) {
            $table->string('full_name')->after('user_id'); // Add the missing name column
        });
    }

    public function down(): void
    {
        Schema::table('investor_profiles', function (Blueprint $table) {
            $table->dropColumn('full_name');
        });
    }
};
