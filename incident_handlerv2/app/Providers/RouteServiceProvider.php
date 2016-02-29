<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Models\Helpdesk\User\User as HelpdeskUser;
use Models\IncidentManager\User\User;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);

        $router->model('user', User::class);
        $router->bind('user', function ($username, $route) {
            $user = User::whereUsername($username)->first();

            if (!$user) {
                abort(404, 'No se encontró al usuario que se buscaba');
            }

            return $user;
        });

        $router->model('customer_user', HelpdeskUser::class);
        $router->bind('customer_user', function ($username, $route) {
            $user = HelpdeskUser::whereUsername($username)->first();

            if (!$user) {
                abort(404, 'No se encontró al usuario que se buscaba');
            }

            return $user;
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
