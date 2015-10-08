<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //

    var $table = 'person';

    public function fullName()
    {
        return $this->name . " " . $this->lname . " " . $this->mname;
    }
}
