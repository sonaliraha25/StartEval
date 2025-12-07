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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('title');
        $table->string('status')->default('Draft');
        $table->text('description');
        $table->decimal('revenue', 12, 2)->default(0);
        $table->decimal('profit', 12, 2)->default(0);
        $table->decimal('asking_price', 12, 2)->default(0);
        $table->string('logo')->nullable();
       $table->string('product_type')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
