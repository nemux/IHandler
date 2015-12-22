<?php

namespace App\Models\Helpdesk;

use App\Models\User\UserType;

class CustomerUserType extends UserType
{


    protected $connection = 'hd_pgsql';

    protected $table = 'user_type';

    /**
     * Relación UserType->User
     *
     * @return static
     */
    static function types()
    {
        return CustomerUserType::all()->lists('description', 'id');
    }
}
