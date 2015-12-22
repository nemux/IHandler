<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Helpdesk\CustomerUser;
use App\Models\Helpdesk\CustomerUserPerson;
use App\Models\Helpdesk\CustomerUserPersonContact;
use Illuminate\Http\Request;

class HelpdeskUserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = CustomerUser::orderBy('id')->get();

        \Log::info($users);

        return view('helpdesk.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new CustomerUser();
        $person = new CustomerUserPerson();
        $contact = new CustomerUserPersonContact();

        return view('helpdesk.user.create', compact('user', 'person', 'contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CustomerUserPerson::validateCreate($request, $this);
        CustomerUserPersonContact::validateCreate($request, $this);
        CustomerUser::validateCreate($request, $this);

        $person = new CustomerUserPerson();
        $person->name = $request->get('name');
        $person->mname = $request->get('mname');
        $person->lname = $request->get('lname');
        $person->sex = $request->get('sex');
        $person->save();

        $personContact = new CustomerUserPersonContact();
        $personContact->person_id = $person->id;
        $personContact->phone = $request->get('phone');
        $personContact->email = $request->get('email');
        $personContact->save();

        $password = str_random(12);

        $user = new CustomerUser();
        $user->person_id = $person->id;
        $user->user_type_id = $request->get('user_type');
        $user->active = $request->get('active') ? true : false;
        $user->username = $request->get('username');
        $user->customer_id = $request->get('customer');
        $user->password = bcrypt($password);
        $user->save();

        \Mail::send('email.newuser', compact(['user', 'password']), function ($mail) use ($user) {
            $mailTo = CustomerUserPersonContact::compareEmail($user->person->contact->email);

            $mail->to($mailTo, $user->person->fullName())->subject('[GCS-HelpDesk] Nuevo Usuario');
        });

        return redirect()->route('helpdesk.user.index')->withMessage('Nuevo usuario creado');
    }

    /**
     * Display the specified resource.
     *
     * @param CustomerUser $user
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerUser $user)
    {
        return view('helpdesk.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CustomerUser $user
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerUser $user)
    {
        $person = $user->person;
        $contact = $person->contact;
        return view('helpdesk.user.edit', compact('user', 'person', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CustomerUser $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerUser $user)
    {
        CustomerUser::validateUpdate($request, $this);
        CustomerUserPerson::validateUpdate($request, $this);
        CustomerUserPersonContact::validateUpdate($request, $this);

        $user->user_type_id = $request->get('user_type');
        $user->active = $request->get('active') ? true : false;
        $user->save();

        $user->person->name = $request->get('name');
        $user->person->lname = $request->get('lname');
        $user->person->mname = $request->get('mname');
        $user->person->sex = $request->get('sex');
        $user->person->save();

        if (!$user->person->contact) {
            $user->person->contact = new CustomerUserPersonContact();
            $user->person->contact->person_id = $user->person->id;
        }

        $user->person->contact->email = $request->get('email');
        $user->person->contact->phone = $request->get('phone');
        $user->person->contact->save();

        return redirect()->route('helpdesk.user.edit', $user->username)->withMessage('Datos actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CustomerUser $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerUser $user)
    {
        $username = $user->username;
        $user->delete();

        return redirect()->route('helpdesk.user.index')->withMessage("Usuario $username eliminado");
    }

    /**
     * Changes the password from a user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePass(Request $request)
    {
        $user = CustomerUser::whereId($request->get('id'))->first();

        CustomerUser::validateChangePassword($request, $this);

        $password = $request->get('password');
        $user->password = bcrypt($password);

        $user->update();

        \Mail::send('email.changepass', compact(['user', 'password']), function ($mail) use ($user) {
            $mailTo = CustomerUserPersonContact::compareEmail($user->person->contact->email);

            $mail->to($mailTo, $user->person->fullName())->subject('[GCS-HelpDesk] Cambio de Contraseña');
        });

        return redirect()->route('helpdesk.user.edit', $user->username)->withMessage('Contraseña actualizada');
    }
}
