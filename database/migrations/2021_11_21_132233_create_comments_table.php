<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('post_id');
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('body');
            $table->timestamps();

            //$table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
