<?php

namespace App\Models;

use App\Events\EventModel;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function save(array $options = [])
    {
        //Definimos si es un update o create
        $action = ($this->exists) ? 'UPDATE' : 'CREATE';

        parent::save($options);

        //Almacenamos el objeto después de almacenarlo en la base de datos para poder obtener el ID
        BaseModel::log($action);
    }

    public function delete()
    {
        //Almacenamos en el log antes de eliminar el objeto de la base de datos
        BaseModel::log('DELETE');

        parent::delete();
    }

    private function log($action)
    {

        if (\Auth::user() !== null)
            $username = \Auth::user()->username;
        else
            $username = 'GUEST';

        \Event::fire(new EventModel($username, $action, $this));
    }
}
