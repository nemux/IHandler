<?php

class CustomerController extends Controller
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
        $i = Input::all();

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

        $socialmedia = new CustomerSocialmedia();
        $socialmedia->customer_id = $i['customer_id'];
        $socialmedia->reference = $i['reference'];
        $socialmedia->description = $i['description'];
        $socialmedia->recommendation = $i['recommendation'];

        $socialmedia->save();

        if ($i['images-evidence']) {
            foreach ($i['images-evidence'] as $img) {
                $this->compareAndUpload($img, $customer_id, $socialmedia->id);
            }
        }

        $message = 'Se agregó la nueva red social: ' . $i['reference'];

        return Response::json(array("customer_id" => $customer_id, 'message' => $message, 'object' => $socialmedia));
    }

    private function compareAndUpload($i, $customer_id, $socialmedia_id)
    {
        if ($i) {
            $name = $i->getClientOriginalName();
            $files = explode('.', $name);
            $extension = end($files);
            if (strcasecmp($extension, 'jpg') == 0 || strcasecmp($extension, 'png') == 0) {
                $new_name = date("Ymd_his") . "_" . $customer_id . "_" . $socialmedia_id . "_" . $files[0] . "." . $extension;

                try {
//                    Log::info('files/socialmedia-evidence/' . $new_name);
                    $i->move('files/socialmedia-evidence/', $new_name);
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }

                //consideraremos esto una limitante en el documento de vison.
                usleep(100000);

                $test_file_read = file_get_contents('files/socialmedia-evidence/' . $new_name);

                $sha1 = hash('sha1', $test_file_read);
                $sha256 = hash('sha256', $test_file_read);
                $md5 = hash('md5', $test_file_read);

                $im = new SocialMediaEvidence();
                $im->customer_id = $customer_id;
                $im->socialmedia_id = $socialmedia_id;

                $im->file = "files/socialmedia-evidence/" . $new_name;
                $im->name = $new_name;
                $im->footnote = 'footnote-test';

                $im->md5 = $md5;
                $im->sha1 = $sha1;
                $im->sha256 = $sha256;

                $im->save();

                return true;
            } else {
                return 'La extensión no es JPG o PNG: ' . $extension;
            }
        }
    }
}