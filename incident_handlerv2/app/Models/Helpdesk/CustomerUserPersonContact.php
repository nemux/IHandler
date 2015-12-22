<?php

namespace App\Models\Helpdesk;

use App\Models\Person\PersonContact;
use Illuminate\Database\Eloquent\Model;

class CustomerUserPersonContact extends PersonContact
{

    protected $connection = 'hd_pgsql';

    protected $table='person_contact';
}
