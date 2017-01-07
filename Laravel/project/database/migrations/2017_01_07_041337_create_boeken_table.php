<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoekenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boeken', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seller');
            $table->string('title');
            $table->string('author');
            $table->integer('newprice');
            $table->integer('price');
            $table->string('comment');


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
        Schema::dropIfExists('boeken');
    }
}
