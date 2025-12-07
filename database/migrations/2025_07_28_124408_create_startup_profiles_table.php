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
    Schema::create('startup_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('business_name');
        $table->string('business_tagline')->nullable();
        $table->string('industry');
        $table->string('website')->nullable();
        $table->text('description')->nullable();
        $table->string('owner_name')->nullable();
        $table->string('logo')->nullable();
        $table->json('revenue_data')->nullable(); 
        $table->json('sales_data')->nullable();
        $table->string('tax_receipt')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('startup_profiles');
    }
};
