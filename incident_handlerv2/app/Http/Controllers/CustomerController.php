<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Models\IncidentManager\Customer\Customer;
use Models\IncidentManager\Customer\CustomerAsset;
use Models\IncidentManager\Customer\CustomerContact;
use Models\IncidentManager\Person\Person;
use Models\IncidentManager\Person\PersonContact;

class CustomerController extends Controller
{

    /**
     * Muestra una lista de los clientes actuales
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customers = Customer::orderBy('id')->get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Regresa la vista con el formulario para agregar un nuevo cliente
     */
    public function create()
    {
        $customer = new Customer();
        $person = new Person();
        return view('customer.create', compact('customer', 'person'));
    }

    /**
     * Almacena en la base de datos los elementos
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        Customer::validateCreate($request, $this);
        Person::validateCreate($request, $this);
        PersonContact::validateCreate($request, $this);

        $customer = new Customer();
        $customer->name = $request->get('customer_name');
        $customer->business_name = $request->get('business_name');
        $customer->save();

        $person = new Person();
        $person->name = $request->get('name');
        $person->mname = $request->get('mname');
        $person->lname = $request->get('lname');
        $person->sex = $request->get('sex');
        $person->save();

        $contact = new PersonContact();
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->person_id = $person->id;
        $contact->save();

        $customerContact = new CustomerContact();
        $customerContact->person_id = $person->id;
        $customerContact->customer_id = $customer->id;
        $customerContact->save();

        return redirect()->route('customer.index')->withMessage('Nuevo cliente creado');
    }

    /**
     * Muestra la vista con la información de un cliente
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $customer = Customer::findOrNew($id);

        if (\Session::has('tab')) {
            $tab = \Session::get('tab');
        } else {
            $tab = 'customer';
        }

        return view('customer.show', compact('customer'))->withTab($tab);
    }

    /**
     * Elimina un objeto de la base de datos
     * @param $id
     */
    public function destroy($id)
    {
        $customer = Customer::findOrNew($id);
        $name = $customer->name;

        $customer->delete();

        return redirect()->route('customer.index')->withMessage("Se eliminó el cliente: $name");
    }

    /**
     * Edita la información de un cliente
     */

    public function edit($id)
    {
        $customer = Customer::findOrNew($id);
        $person = sizeof($customer->contacts) == 0 ? new Person() : $customer->contacts[0]->person;
        $contact = $person->contact;

        return view('customer.edit', compact('customer', 'person', 'contact'));
    }

    /**
     * Actualiza la información de un cliente
     * @param Request $request
     * @param $id
     */
    public function  update(Request $request, $id)
    {
        Customer::validateCreate($request, $this);

        $customer = Customer::findOrNew($id);
        $customer->name = $request->get('customer_name');
        $customer->business_name = $request->get('business_name');

//        \Log::info($request->file('logo')->getClientOriginalName());

        if ($request->file('logo')) {
            $customer->logo = 'customer/logo/' . hash('md5', $id) . "." . $request->file('logo')->getClientOriginalExtension();
            $customer->mimetype = $request->file('logo')->getClientMimeType();

            //Almacena el logo del cliente en la localidad correspondiente
            \Storage::put($customer->logo, \File::get($request->file('logo')));
        }

        $customer->save();

        $person = sizeof($customer->contacts) == 0 ? new Person() : $customer->contacts[0]->person;
        $person->name = $request->get('name');
        $person->mname = $request->get('mname');
        $person->lname = $request->get('lname');
        $person->sex = $request->get('sex');
        $person->save();

        $contact = $person->contact;
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->save();

        return redirect()->route('customer.show', $customer->id)->withMessage('Datos del cliente actualizados');
    }

    /**
     * Devuelve la imagen del logo del cliente
     * @param $id
     */
    public function getLogo($id)
    {
        $customer = Customer::whereId($id)->first();
        $file = $customer->logo;

        $file_ = \Storage::get($file);

        //Regresa el archivo
        return response($file_, 200)->header('Content-Type', $customer->mimetype);
    }
}
