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
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->nullable()->after('remember_token');
            $table->string('phone',15)->nullable()->default(null)->after('type');
            $table->string('vehicle_1')->nullable()->default(null)->after('phone');
            $table->string('vehicle_2')->nullable()->default(null)->after('vehicle_1');
            $table->string('vehicle_3')->nullable()->default(null)->after('vehicle_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
