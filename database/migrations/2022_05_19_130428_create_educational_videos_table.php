<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('educational_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('youtube_link')->nullable();
            $table->string('aparat_link')->nullable();
            $table->boolean('is_active')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('educational_videos');
    }
};
