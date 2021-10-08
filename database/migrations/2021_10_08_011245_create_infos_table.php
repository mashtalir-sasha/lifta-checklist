<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');

            $table->text('meta_title');
            $table->text('meta_description');

            $table->text('title');
            $table->text('sub_title');
            $table->text('text')->nullable();

            $table->text('form_title');
            $table->text('sender_title');
            $table->text('form_btn');
            $table->text('link');
            $table->text('thanks_text');

            $table->text('note')->nullable();
            $table->text('note_xs')->nullable();

            $table->text('image');
            $table->text('image_xs');

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
        Schema::dropIfExists('infos');
    }
}
