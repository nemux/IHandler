<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//la tabla de acceso desde este lado se realizara el manejor de las sesiones
		Schema::create('acces',function(Blueprint $table){

	  $table->increments('id');
      $table->integer('incident_handler_id')->unsigned();
      $table->integer('acces_type_id')->unsigned();
      $table->string('user');
      $table->string('pass');
      $table->boolean('active');
      $table->rememberToken();
      $table->timestamps();
		});

		//Schema::table('acces', function(Blueprint $table){
		//	$table->foreign('incident_handler_id')->references('id')->on('incident_handler');
		//	$table->foreign('acces_type_id')->references('id')->on('acces_type');
		//});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// la convencion marca que prmero debo deshacer la llave y luego la tabla
		Schema::table('acces',function(Blueprint $table)
		{
			$table->dropForeign('acces_incident_handler_id_foreign');
			$table->dropForeign('acces_acces_type_id_foreign');
		});
		Schema::drop('acces');
	}

}
