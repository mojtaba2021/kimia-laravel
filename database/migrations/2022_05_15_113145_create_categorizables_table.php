<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('categorizables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->morphs('categorizable');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('categorizables');
    }
};
