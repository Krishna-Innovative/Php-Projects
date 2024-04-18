DatabaseSeeder<?php

class DatabaseSeeder extends Seeder 
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserGroupsSeeder');
		$this->call('ParametersSeeder');
		// $this->call('UserTableSeeder');
	}

}
