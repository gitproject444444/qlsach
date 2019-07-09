<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_book', function (Blueprint $table) {
            $table->integer('book_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('pay');
            $table->boolean('status')->default(1);
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

        Schema::table('user_book', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('user_book');
    }
}
