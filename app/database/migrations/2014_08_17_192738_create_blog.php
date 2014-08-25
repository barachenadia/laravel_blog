<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlog extends Migration {

public function up()
    {
        Schema::create('users', function($table) {
            $table->increments('id')->unsigned();
            $table->string('username', 64)->unique();
            $table->string('password', 64);
            $table->string('email', 64)->unique();
            $table->enum('statut', array('user', 'admin'))->default('user');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
        Schema::create('categories', function($table) {
            $table->increments('id')->unsigned();
            $table->string('title', 128)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('articles', function($table) {
            $table->increments('id')->unsigned();
            $table->string('title', 128);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('categorie_id')->unsigned();
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->text('intro_text');
            $table->text('full_text');
            $table->enum('allow_comment', array('no', 'yes'))->default('yes');
            $table->timestamps();
        });
        Schema::create('comments', function($table) {
            $table->increments('id')->unsigned();
            $table->string('title', 128);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('article_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
            $table->text('text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('articles', function($table) {
            $table->dropForeign('articles_categorie_id_foreign');
            $table->dropForeign('articles_user_id_foreign');
        });
        Schema::table('comments', function($table) {
            $table->dropForeign('comments_user_id_foreign');
            $table->dropForeign('comments_article_id_foreign');
        });
        Schema::drop('categories');
        Schema::drop('users');
        Schema::drop('comments');
        Schema::drop('articles');
    }

}