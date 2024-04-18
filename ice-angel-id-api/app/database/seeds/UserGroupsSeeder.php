<?php

class UserGroupsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        Sentry::createGroup(array(
            'name' => 'Account',
            'permissions' => array(),
        ));

        Sentry::createGroup(array(
            'name' => 'Member',
            'permissions' => array(),
        ));
    }

} 