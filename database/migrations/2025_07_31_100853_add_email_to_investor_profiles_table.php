<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investor_profiles', function (Blueprint $table) {
            $table->string('email')->after('full_name');
        });
    }

    public function down(): void
    {
        Schema::table('investor_profiles', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
