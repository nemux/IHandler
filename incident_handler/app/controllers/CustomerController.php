<?php

class CustomerController extends BaseController
{

    protected $layout = 'layouts.master';

    /**
     * Muestra el perfil de un usuario dado.
     */

    public function postUpdate()
    {
        $input = Input::all();
        $id = $input['id'];
        $log = new Log\Logger();

        $customer = Customer::find($id);

        if ($input) {
            $customer->name = $input['name'];
            $customer->company = $input['company'];
            $customer->phone = $input['phone'];
            $customer->mail = $input['mail'];
            $customer->save();

            $log->info(Auth::user()->id, Auth::user()->username, 'Se actualizo el cliente con ID: ' . $customer->id);

            return Redirect::to('customer/view/' . $customer->id);
        }
    }

    public function getUpdate($id)
    {

        $customer = Customer::find($id);
        return $this->layout = View::make("customer.form", array(
            'customer' => $customer,
            'action' => 'CustomerController@postUpdate',
            'title' => "Actualizar Cliente",
            'update' => "1"
        ));

    }

    public function view($id)
    {
        //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $customer = Customer::find($id);

//        $page_types = array();
//        array_push($page_types, ['0' => 'Selecciona una opción']);
        $page_types = PageType::lists('type', 'id');

        return $this->layout = View::make('customer.view', array(
            'customer' => $customer,
            'page_types' => $page_types,
            'action' => 'CustomerController@getUpdate',
        ));
    }

    public function index()
    {
        $customer = Customer::all();
        return $this->layout = View::make('customer.index', array(
            'customer' => $customer
        ));
    }

//    public function pageTypes()
//    {
//        $pages_types = PageType::all(['id', 'type']);
//        return Response::json(['page_types' => $pages_types]);
//    }

    public function storeAsset()
    {
        $input = Input::except(['_token']);

        $validator = Validator::make($input, [
            'customer_id' => 'required',
            'domain_name' => 'required|max:255',
            'ip' => 'required|max:36',
            'comments' => 'required'
        ]);

        $customer_id = $input['customer_id'];

        if ($validator->fails()) {
            return Response::json(array("customer_id" => $customer_id, 'message' => 'Revise el formulario', 'errores' => $validator->errors()));
        }

        $asset = new CustomerAsset();
        $asset->customer_id = $input['customer_id'];
        $asset->domain_name = $input['domain_name'];
        $asset->ip = $input['ip'];
        $asset->comments = $input['comments'];

        $asset->save();

        $message = 'Se agregó el nuevo activo: ' . $input['domain_name'];

        return Response::json(array("customer_id" => $customer_id, 'message' => $message, 'object' => $asset));

    }

    public function storeEmployee()
    {
        $i = Input::except(['_token']);

        $validator = Validator::make($i, [
            'customer_id' => 'required',
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'corp_email' => 'required|email',
            'personal_email' => 'required|email',
            'socialmedia' => 'required',
            'comments' => 'required'
        ]);

        $customer_id = $i['customer_id'];

        if ($validator->fails()) {
            return Response::json(array("customer_id" => $customer_id, 'message' => 'Revise el formulario', 'errores' => $validator->errors()));
        }

        $employee = new CustomerEmployee();
        $employee->customer_id = $i['customer_id'];
        $employee->name = $i['name'];
        $employee->lastname = $i['lastname'];
        $employee->corp_email = $i['corp_email'];
        $employee->personal_email = $i['personal_email'];
        $employee->comments = $i['comments'];
        $employee->socialmedia = $i['socialmedia'];

        $employee->save();

        $message = 'Se agregó el nuevo empleado: ' . $i['name'] . ' ' . $i['lastname'];

        return Response::json(array("customer_id" => $customer_id, 'message' => $message, 'object' => $employee));
    }

    public function storePage()
    {
        $i = Input::except(['_token']);

        $validator = Validator::make($i, [
            'customer_id' => 'required',
            'page_type_id' => 'required|not_in:0',
            'url' => 'required|max:255|active_url',
            'comments' => 'required'
        ]);

        $customer_id = $i['customer_id'];

        if ($validator->fails()) {
            return Response::json(array("customer_id" => $customer_id, 'message' => 'Revise el formulario', 'errores' => $validator->errors()));
        }

        $page = new CustomerPage();
        $page->customer_id = $i['customer_id'];
        $page->page_type_id = $i['page_type_id'];
        $page->url = $i['url'];
        $page->comments = $i['comments'];

        $page->save();

        $page['type'] = CustomerPage::find($page->id)->type->type;

        $message = 'Se agregó la nueva página: ' . $i['url'];

        return Response::json(array("customer_id" => $customer_id, 'message' => $message, 'object' => $page));
    }

    public function storeSocialmedia()
    {
        $i = Input::except(['_token']);

        $validator = Validator::make($i, [
            'customer_id' => 'required',
            'reference' => 'required|max:255|url',
            'description' => 'required',
            'recommendation' => 'required'
        ]);

        $customer_id = $i['customer_id'];

        if ($validator->fails()) {
            return Response::json(array("customer_id" => $customer_id, 'message' => 'Revise el formulario', 'errores' => $validator->errors()));
        }

        $page = new CustomerSocialmedia();
        $page->customer_id = $i['customer_id'];
        $page->reference = $i['reference'];
        $page->description = $i['description'];
        $page->recommendation = $i['recommendation'];

        $page->save();

        $message = 'Se agregó la nueva red social: ' . $i['reference'];

        return Response::json(array("customer_id" => $customer_id, 'message' => $message, 'object' => $page));
    }
}