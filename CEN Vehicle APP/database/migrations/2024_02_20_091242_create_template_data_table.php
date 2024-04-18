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
        Schema::create('template_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->string('form_id')->nullable();
            $table->string('section');
            $table->string('section_name')->nullable();
            $table->string('title');
            $table->string('type');
            $table->string('isrequired');
            $table->string('field_type_response');
            $table->string('notes');
            $table->string('photos');
            $table->string('video');
            $table->string('document');
            $table->string('list');
            $table->string('isactive');
            $table->timestamps();
            $table->foreign('template_id')
              ->references('id')->on('templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_data');
    }
};
