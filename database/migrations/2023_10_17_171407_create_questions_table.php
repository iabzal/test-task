<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreignId('subcategory_id')->nullable()->references('id')->on('subcategories')->cascadeOnDelete();
            $table->string('title');
            $table->text('message');
            $table->foreignId('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->string('file')->nullable();
            $table->enum('status', ['created', 'answered'])->default('created');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
