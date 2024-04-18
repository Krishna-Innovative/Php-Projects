<?php

class ParametersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents(app_path()."/database/seeds/parameters.sql"));
    }

} 