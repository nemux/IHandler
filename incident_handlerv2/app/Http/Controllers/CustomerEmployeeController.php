<?php

namespace App\Http\Controllers;

use App\Models\Customer\Customer;
use App\Models\Customer\CustomerEmployee;
use App\Models\Person\PersonContact;
use App\Models\Person\Person;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerEmployeeController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($customer_id)
    {
        $customer = Customer::findOrNew($customer_id);
        $employee = new CustomerEmployee();
        $person = new Person();
        $contact = new PersonContact();
        return view('customer.employee.create', compact('customer', 'person', 'employee', 'contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer_id = $request->get('customer_id');

        \Log::info($request->except('_token'));

        Person::validateCreate($request, $this);
        PersonContact::validateCreate($request, $this);
        CustomerEmployee::validateCreate($request, $this);

        $person = new Person();
        $person->name = $request->get('name');
        $person->lname = $request->get('lname');
        $person->mname = $request->get('mname');
        $person->sex = $request->get('sex');
        $person->save();

        $contact = new PersonContact();
        $contact->person_id = $person->id;
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->save();

        $employee = new CustomerEmployee();
        $employee->customer_id = $customer_id;
        $employee->person_id = $person->id;
        $employee->comments = $request->get('corp_comments');
        $employee->email = $request->get('corp_email');
        $employee->phone = $request->get('corp_phone');
        $employee->save();

        return redirect()->route('customer.show', $customer_id)->withMessage('Se agregó el empleado')->withTab('employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = CustomerEmployee::findOrNew($id);

        return view('customer.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = CustomerEmployee::findOrNew($id);
        $person = $employee->person;

        return view('customer.employee.edit', compact('employee', 'person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Person::validateUpdate($request, $this);
        PersonContact::validateUpdate($request, $this);
        CustomerEmployee::validateUpdate($request, $this);


        $employee = CustomerEmployee::findOrNew($id);
        $employee->comments = $request->get('corp_comments');
        $employee->email = $request->get('corp_email');
        $employee->phone = $request->get('corp_phone');
        $employee->save();

        $person = $employee->person;
        $person->name = $request->get('name');
        $person->lname = $request->get('lname');
        $person->mname = $request->get('mname');
        $person->sex = $request->get('sex');
        $person->save();

        $contact = $person->contact;
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->save();

        return redirect()->route('customer.show', $employee->customer_id)->withMessage('Se actualizó el empleado')->withTab('employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = CustomerEmployee::findOrNew($id);
        $employee_name = $employee->person->fullName();
        $customer_id = $employee->customer_id;
        $employee->delete();

        return redirect()->route('customer.show', $customer_id)->withMessage('Se eliminó el empleado ' . $employee_name)->withTab('employee');
    }
}
