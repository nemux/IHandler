<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
			Eloquent::unguard();
			  $this->call('IncidentHandlerSeeder');
			  $this->command->info('Done!');

    	  $this->call('AccesTypeTableSeeder');
			  $this->command->info('Done1!');

  			$this->call('AccesTableSeeder');
			  $this->command->info('Done(consider acces_type)');

			  //$this->command->info('Done!5');
			  $this->call('CategoryTableSeeder');

			  $this->command->info('Done!10');
			 // $this->call('CustomerTableSeeder');

			  //$this->command->info('Done!11');
			  $this->command->info('Done!8');

			  $this->command->info('Done!9');
			  //until here we are good¡
			  $this->call('AttackTableSeeder');
        //$this->call('SensorSeeder');
			  //$this->call('IncidentTableSeeder');
			  //$this->command->info('Done!14');
			  //$this->call('ImageTableSeeder');
			  //$this->command->info('Done!12');


			  //$this->call('ApplicationTableSeeder');
			  //$this->command->info('Done!6');
				$this->call('IncidentStatusTableSeeder');
			  $this->command->info('Done!15');
			  //$this->call('MethodTableSeeder');
			  //$this->command->info('Done!16');
			  $this->call('TimeTypeTableSeeder');
			  $this->command->info('Done!19');

			  //$this->call('TimeTableSeeder');
			  //$this->command->info('Done!18');

			  //$this->call('IncidentHistoryTableSeeder');
			  //$this->command->info('Done!13');
			  //$this->call('ReferenceTableSeeder');
			 //$this->command->info('Done!17');
				$this->command->info('Que la verga');
				//$this->call('EventsTypeTableSeeder');
			  //$this->call('EventsTableSeeder');
			  //$this->call('AttackerHistorySeeder');






	}

}
