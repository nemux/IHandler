<?php

class IncidentHandlerController extends Controller
{
    protected $layout = 'layouts.master';

    /**
     * Muestra el perfil de un usuario dado.
     */
    public function create()
    {
        $input = Input::all();
        $chars = "#*.!_<>abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $handler = new IncidentHandler;
        $access = new Access;
        $types = AccessType::lists('name', 'id');
        $log = new Log\Logger();

        if (isset($input['name'])) {
            $handler->name = $input['name'];
            $handler->lastname = $input['lastname'];
            $handler->phone = $input['phone'];
            $handler->mail = $input['mail'];
            $handler->save();
            $pass = substr(str_shuffle($chars), 0, 8);
            $access->username = $input['username'];
            $access->password = Hash::make($pass);
            $access->access_types_id = $input['access_types_id'];
            $access->incident_handler_id = $handler->id;
            $access->active = 0;
            $access->save();

            $log->info(Auth::user()->id, Auth::user()->username, 'Se creó el Incident Handler con ID: ' . $handler->id);

            Mail::send('usuarios.mail', array('user' => $input['username'], 'pass' => $pass), function ($message) {
                $message->to(Input::get('mail'))->subject('[GCS-IM]-Alta en Incident Manager');
            });
            return Redirect::to('handler/view/' . $handler->id);
        } else {
            //$this->layout = View::make("incidentHandler.create",array('handler' => $handler));
            return $this->layout = View::make("incidentHandler.form", array(
                'handler' => $handler,
                'access' => $access,
                'types' => $types,
                'action' => 'IncidentHandlerController@create',
                'title' => "Nuevo Incident Handler",
            ));
        }

    }

    public function passwordUpdate()
    {
        $input = Input::all();

        $new_pass = $input['new_pass'];
        $user_token = IncidentHandlerToken::where('incident_handler_id', "=", Auth::user()->id);
        $userData = array(
            'username' => Auth::user()->username,
            'password' => $input['old_pass'],
        );

        if (Auth::attempt($userData) && $user_token->first() != null && $user_token->first()->token == $input['token'] && (strtotime('now') - strtotime($user_token->first()->updated_at)) <= 600) {
            $user = IncidentHandler::find(Auth::user()->id);
            $user->access->password = Hash::make($new_pass);
            $user->access->save();
            Mail::send('usuarios.mail', array('user' => Auth::user()->username, 'pass' => $new_pass), function ($message) {
                $user = IncidentHandler::find(Auth::user()->id);
                $message->to($user->mail)->subject('[GCS-IM] - Cambio de password exitoso');
            });

            return Redirect::to('/incident/');
        } else {
            Mail::send('usuarios.mail', array('user' => '', 'pass' => ''), function ($message) {
                $user = IncidentHandler::find(Auth::user()->id);
                $message->to($user->mail)->subject('[GCS-IM] - Error en cambio de password');
            });
            return Redirect::to('/incident/');
        }

    }

    public function sendToken()
    {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $token = substr(str_shuffle($chars), 0, 32);

        \Illuminate\Support\Facades\Log::info("Token: " . $token);

        $user_token = IncidentHandlerToken::where('incident_handler_id', "=", Auth::user()->id);
        if ($user_token->first() != null) {
            $user_token = $user_token->first();
            $user_token->token = $token;
            $user_token->incident_handler_id = Auth::user()->id;
            $user_token->save();
            Mail::send('usuarios.mail', array('user' => null, 'pass' => null, 'token' => $token), function ($message) {
                $user = IncidentHandler::find(Auth::user()->id);
                $message->to($user->mail)->subject('[GCS-IM] - Token de Confirmación - Incident Manager');
            });
            return Redirect::to('/incident/');
        } else {
            $user_token = new IncidentHandlerToken;
            $user_token->token = $token;
            $user_token->incident_handler_id = Auth::user()->id;
            $user_token->save();
            Mail::send('usuarios.mail', array('user' => null, 'pass' => null, 'token' => $token), function ($message) {
                $user = IncidentHandler::find(Auth::user()->id);
                $message->to($user->mail)->subject('[GCS-IM] - Token de Confirmación - Incident Manager');
            });
            return Redirect::to('/incident/');
        }
        /*

        */
    }

    public function postUpdate()
    {
        $input = Input::all();
        $chars = "#*.!_<>abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $id = $input['id'];
        $handler = IncidentHandler::find($id);
        $access = $handler->access;
        $types = AccessType::lists('name', 'id');
        $log = new Log\Logger();

        if ($input) {
            $handler->name = $input['name'];
            $handler->lastname = $input['lastname'];
            $handler->phone = $input['phone'];
            $handler->mail = $input['mail'];
            $handler->save();
            $access->username = $input['username'];
            $pass = substr(str_shuffle($chars), 0, 8);
            $access->password = Hash::make($pass);
            $access->access_types_id = $input['access_types_id'];
            $access->incident_handler_id = $handler->id;
            $access->active = 0;
            $access->save();
            $log->info(Auth::user()->id, Auth::user()->username, 'Se actualizó el Incident Handler con ID: ' . $handler->id);

            Mail::send('usuarios.mail', array('user' => $input['username'], 'pass' => $pass), function ($message) {
                $message->to(Input::get('mail'))->subject('[GCS-IM]-Actualización en Incident Manager');
            });
            return Redirect::to('handler/view/' . $handler->id);
        }


    }

    public function getUpdate($id)
    {

        $handler = IncidentHandler::find($id);
        $access = $handler->access;
        $types = AccessType::lists('name', 'id');
        return $this->layout = View::make("incidentHandler.form", array(
            'handler' => $handler,
            'access' => $access,
            'types' => $types,
            'action' => 'IncidentHandlerController@postUpdate',
            'update' => 'update',
            'title' => 'Actualización de Incident Handler'
        ));

    }

    public function view($id)
    {
        //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $handler = IncidentHandler::find($id);
        $access = Access::where('incident_handler_id', '=', $id)->first();
        $types = AccessType::lists('name', 'id');


        return $this->layout = View::make('incidentHandler.view', array(
            'handler' => $handler,
            'access' => $access,
            'types' => $types,

        ));


    }

    public function index()
    {
        $handler = IncidentHandler::all();
        return $this->layout = View::make('incidentHandler.index', array(
            'handler' => $handler,

        ));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */

}
