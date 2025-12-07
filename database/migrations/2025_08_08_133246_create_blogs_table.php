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
    Schema::create('blogs', function (Blueprint $table) {
        $table->id();
        $table->string('title');                        // blog title
        $table->string('slug')->unique();               
        $table->string('short_description', 300);       // preview/excerpt
        $table->longText('long_description');           // full article body
        $table->string('image')->nullable();            // store image path
        $table->timestamp('posted_at')->useCurrent();   // default to now
        $table->timestamps();                           // created_at & updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
