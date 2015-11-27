<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'dashboard/evidence/upload/surveillance',
        'dashboard/evidence/upload/incident',
        'dashboard/otrs/customer/synch',
        'dashboard/incident/delete/evidence/*',
        'dashboard/incident/delete/event/*'
    ];
}
