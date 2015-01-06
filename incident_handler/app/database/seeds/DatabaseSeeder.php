<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->truncate();
		$users  = array(

			['name' => 'leonel', 'lastname' => 'de leon', 'mail' => 'ldeleon@globalcybersec.com', 'phone' => '5529020079', 'type' => '1', 'other' => 'data', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['name' => 'nemux', 'lastname' => 'araujo', 'mail' => 'jaraujo@globalcybersec.com', 'phone' => '565656565', 'type' => '2', 'other' => 'data', 'created_at' => new DateTime, 'updated_at' => new DateTime],
			['name' => 'alonso', 'lastname' => 'villalobos', 'mail' => 'avillalobos@globalcybersec.com', 'phone' => '54435', 'type' => '3', 'other' => 'data', 'created_at' => new DateTime, 'updated_at' => new DateTime],
						);
			



		 DB::table('users')->insert($users);
		
		//Eloquent::unguard();

		// $this->call('UserTableSeeder');
	}

}
