<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->unsignedBigInteger('actual_price');
            $table->unsignedBigInteger('discount_price')->nullable();
            $table->BigInteger('view_count')->nullable();
            $table->BigInteger('subscriber_count')->nullable();
            $table->boolean('is_active')->default(0);
            $table->string('course_lang');
            $table->string('course_time');
            $table->string('course_size');
            $table->string('course_kind');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
