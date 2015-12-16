<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Person\Person;
use App\Models\Person\PersonContact;
use App\Models\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $person = new Person();
        $contact = new PersonContact();

        return view('user.create', compact('user', 'person', 'contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Person::validateCreate($request, $this);
        PersonContact::validateCreate($request, $this);
        User::validateCreate($request, $this);

        $person = new Person();
        $person->name = $request->get('name');
        $person->mname = $request->get('mname');
        $person->lname = $request->get('lname');
        $person->sex = $request->get('sex');
        $person->save();

        $personContact = new PersonContact();
        $personContact->person_id = $person->id;
        $personContact->phone = $request->get('phone');
        $personContact->email = $request->get('email');
        $personContact->save();

        $password = str_random(12);

        $user = new User();
        $user->person_id = $person->id;
        $user->user_type_id = $request->get('user_type');
        $user->active = $request->get('active') ? true : false;
        $user->username = $request->get('username');
        $user->password = bcrypt($password);
        $user->save(['username' => \Auth::user()->username, 'user' => $user]);

        \Mail::send('email.newuser', compact(['user', 'password']), function ($mail) use ($user) {
            $mailTo = PersonContact::compareEmail($user->person->contact->email);

            $mail->to($mailTo, $user->person->fullName())->subject('[GCS-IH] Nuevo Usuario');
        });

        return redirect()->route('user.index')->withMessage('Nuevo usuario creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $person = $user->person;
        $contact = $person->contact;
        return view('user.edit', compact('user', 'person', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        User::validateUpdate($request, $this);
        Person::validateUpdate($request, $this);
        PersonContact::validateUpdate($request, $this);

        $user->user_type_id = $request->get('user_type');
        $user->active = $request->get('active') ? true : false;
        $user->save(['username' => \Auth::user()->username, 'user' => $user]);

        $user->person->name = $request->get('name');
        $user->person->lname = $request->get('lname');
        $user->person->mname = $request->get('mname');
        $user->person->sex = $request->get('sex');
        $user->person->save();

        if (!$user->person->contact) {
            $user->person->contact = new PersonContact();
            $user->person->contact->person_id = $user->person->id;
        }

        $user->person->contact->email = $request->get('email');
        $user->person->contact->phone = $request->get('phone');
        $user->person->contact->save();

        return redirect()->route('user.edit', $user->username)->withMessage('Datos actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $username = $user->username;
        $user->delete();

        return redirect()->route('user.index')->withMessage("Usuario $username eliminado");
    }

    /**
     * Changes the password from a user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePass(Request $request)
    {
        $user = User::whereId($request->get('id'))->first();

        User::validateChangePassword($request, $this);

        $password = $request->get('password');
        $user->password = bcrypt($password);

        $user->update();

        \Mail::send('email.changepass', compact(['user', 'password']), function ($mail) use ($user) {
            $mailTo = PersonContact::compareEmail($user->person->contact->email);

            $mail->to($mailTo, $user->person->fullName())->subject('[GCS-IH] Cambio de Contraseña');
        });

        return redirect()->route('user.edit', $user->username)->withMessage('Contraseña actualizada');
    }

}
