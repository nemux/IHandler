<?php

namespace App\Models\Helpdesk;

use App\Models\Person\Person;
use Illuminate\Database\Eloquent\Model;

class CustomerUserPerson extends Person
{

    protected $connection = 'hd_pgsql';

    protected $table = 'person';

    /**
     * Relación Person->PersonContact
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contact()
    {
        return $this->hasOne(CustomerUserPersonContact::class, 'person_id');
    }
}
