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
        Schema::create('user_template_response', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('template_id')->unsigned()->index();
            $table->string('form_id')->nullable();
            $table->string('section');
            $table->string('section_name');
            $table->string('title');
            $table->string('type');
            $table->string('isrequired');
            $table->string('field_type_response');
            $table->string('field_value');
            $table->string('notes');
            $table->string('photos',700);
            $table->string('video');
            $table->string('document');
            $table->string('isactive');
            $table->string('isLive');
            $table->string('savedOnDate');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('user_template_response');
    }
};
