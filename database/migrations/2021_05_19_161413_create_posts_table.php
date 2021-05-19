<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // bigint(11) unsigned A_I 'id'
            $table->unsignedBigInteger('author')->comment('User ID of author.');
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes(); // timestamp 'deleted_at'

            /**
             * KEINE NEUE SPALTE!! sondern
             */
            $table->foreign('author')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}