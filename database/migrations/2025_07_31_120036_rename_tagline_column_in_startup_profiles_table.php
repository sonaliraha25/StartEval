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
    Schema::table('startup_profiles', function (Blueprint $table) {
        $table->renameColumn('tagline', 'business_tagline');
    });
}

};
