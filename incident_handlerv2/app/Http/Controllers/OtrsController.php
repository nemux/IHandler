<?php

namespace App\Http\Controllers;

use App\Library\Otrs\OtrsClient;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\Person;
use App\Models\PersonContact;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OtrsController extends Controller
{
    /**
     * Devuelve una vista con un conjunto de botones para poder obtener informacion desde el OTRS
     */
    public function index()
    {
        return view('otrs.index');
    }

    /**
     * Efectúa una sincronización de datos de los clientes definidos en el OTRS hacia el Incident Handler
     *
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function customerSynch(Request $request)
    {
        if ($request->ajax()) {
            $oClient = new OtrsClient();
            $otrsCustomerUsers = $oClient->getCustomerUsers();

            $returnList = array();
            foreach ($otrsCustomerUsers as $otrsCustomerUser) {
                if ($otrsCustomerUser !== 0) {
                    $otrsCustomer = $oClient->getCustomerInfo($otrsCustomerUser['UserName']);

                    $userID = $otrsCustomer['UserID'];
                    $userCustomerID = $otrsCustomer['UserCustomerID'];

                    $count = Customer::whereOtrsUserId($userID)->whereOtrsCustomerId($userCustomerID)->count();

                    \Log::info("Count $count $userID $userCustomerID");

                    if ($count === 0) {
                        $customer = new Customer();
                        $customer->name = $otrsCustomer['UserFirstname'] . " " . $otrsCustomer['UserLastname'];
                        $customer->otrs_customer_id = $userCustomerID;
                        $customer->otrs_user_id = $userID;
                        $customer->save();

                        $person = new Person();
                        $person->name = $otrsCustomer['UserFirstname'];
                        $person->lname = $otrsCustomer['UserLastname'];
                        $person->sex = 'O';
                        $person->save();

                        $contact = new PersonContact();
                        $contact->person_id = $person->id;
                        $contact->email = $otrsCustomer['UserEmail'];
                        $contact->save();

                        $customerContact = new CustomerContact();
                        $customerContact->person_id = $person->id;
                        $customerContact->customer_id = $customer->id;
                        $customerContact->save();

                        array_push($returnList, ['customer' => $customer, 'person' => $person, 'contact' => $contact, 'customerContact' => $customerContact]);
                    }
                }
            }

            return \Response::json(['status' => true, 'count' => sizeof($returnList)]);
        } else {
            return \Response::json(['status' => false]);
        }
    }
}
