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
        $criticities = Criticity::lists('name', 'id');

        return $this->layout = View::make('customer.view', array(
            'customer' => $customer,
            'page_types' => $page_types,
            'criticities' => $criticities,
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
            'ip' => 'required|max:36'
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
            'corp_email' => 'required|max:255|email',
            'personal_email' => 'email|max:255'
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
            'url' => 'required|url'
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

        if ($i['p-images-evidence']) {
            foreach ($i['p-images-evidence'] as $img) {
                $this->compareAndUpload($img, $customer_id, $page->id, 'P');
            }
        }

        $page['type'] = CustomerPage::find($page->id)->type->type;

        $message = 'Se agregó la nueva página: ' . $i['url'];

        return Response::json(array("customer_id" => $customer_id, 'message' => $message, 'object' => $page));
    }

    public function storeSocialmedia()
    {
        $i = Input::all();

        $validator = Validator::make($i, [
            'customer_id' => 'required',
            'criticity_id' => 'required|not_in:0',
            'title' => 'required|max:255'
        ]);

        $customer_id = $i['customer_id'];

        if ($validator->fails()) {
            return Response::json(array("customer_id" => $customer_id, 'message' => 'Revise el formulario', 'errores' => $validator->errors()));
        }

        $socialmedia = new CustomerSocialmedia();
        $socialmedia->customer_id = $i['customer_id'];
        $socialmedia->title = $i['title'];
        $socialmedia->reference = 'http://';
        $socialmedia->description = $i['description'];
        $socialmedia->recommendation = $i['recommendation'];

        $socialmedia->save();

        if ($i['sm-images-evidence']) {
            foreach ($i['sm-images-evidence'] as $img) {
                $this->compareAndUpload($img, $customer_id, $socialmedia->id, 'SM');
            }
        }

        $message = 'Se agregó la nueva red social: ' . $i['title'];

        return Response::json(array("customer_id" => $customer_id, 'message' => $message, 'object' => $socialmedia));
    }

    private function compareAndUpload($i, $customer_id, $id, $type)
    {
        if ($i) {
            $name = $i->getClientOriginalName();
            $files = explode('.', $name);
            $extension = end($files);
            if (strcasecmp($extension, 'jpg') == 0 || strcasecmp($extension, 'png') == 0) {
                $new_name = date("Ymd_his") . "_" . $customer_id . "_" . $type . $id . "_" . $files[0] . "." . $extension;

                try {
//                    Log::info('files/socialmedia-evidence/' . $new_name);
                    if ($type == 'SM') {
                        $i->move('files/socialmedia-evidence/', $new_name);
                    } else {
                        $i->move('files/pages-evidence/', $new_name);
                    }
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }

                //consideraremos esto una limitante en el documento de vison.
                usleep(100000);

                if ($type == 'SM') {
                    $test_file_read = file_get_contents('files/socialmedia-evidence/' . $new_name);
                } else {
                    $test_file_read = file_get_contents('files/pages-evidence/' . $new_name);
                }

                $sha1 = hash('sha1', $test_file_read);
                $sha256 = hash('sha256', $test_file_read);
                $md5 = hash('md5', $test_file_read);

                if ($type == 'SM') {
                    $im = new SocialMediaEvidence();
                    $im->file = "files/socialmedia-evidence/" . $new_name;
                    $im->socialmedia_id = $id;
                } else {
                    $im = new PageEvidence();
                    $im->file = "files/pages-evidence/" . $new_name;
                    $im->pages_id = $id;
                }


                $im->customer_id = $customer_id;
                $im->name = $new_name;
                $im->footnote = '[[FOOT-NOTE]]';
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

    /**
     * Genera el reporte de cibervigilancia
     */
    public function cvReport()
    {
        return $this->cvGetHtml(Input::all());
    }

    public function cvMail()
    {
        $i = Input::all();

        $validator = Validator::make($i, [
            'customer_id' => 'required',
            'from_date' => 'required',//|date_format:d/m/Y',
            'to_date' => 'required',//|date_format:d/m/Y'
        ]);

        if ($validator->fails()) {
            return Response::json(array('message' => 'Revise el formulario', 'errores' => $validator->errors()));
        }

        $customer_id = $i['customer_id'];

        $customer = Customer::find($customer_id);
        $socialmedias = CustomerSocialmedia::whereBetween('created_at', array($i['from_date'] . ' 00:00:00', $i['to_date'] . ' 23:59:59'))->get();
        $pages = CustomerPage::whereBetween('created_at', array($i['from_date'] . ' 00:00:00', $i['to_date'] . ' 23:59:59'))->get();
        $month = '[[MES]]';

        $subject = '[GCS-IM][' . $customer->otrs_userID . ']- Reporte de cibervigilancia de ' . $month . '.';

        try {
            Mail::send('customer.report.cyber-surv',
                array('from_date' => $i['from_date'],
                    'to_date' => $i['to_date'],
                    'customer' => $customer,
                    'socialmedias' => $socialmedias,
                    'pages' => $pages,
                    'mail' => true),
                function ($message) use ($customer, $subject, $socialmedias) {
                    $log = new Log\Logger();
                    $temp_mails = str_replace(array(",", ";"), ",", $customer->mail);
                    $mails = explode(",", $temp_mails);

//                    $message->to($mails)->cc('soc@globalcybersec.com')->subject($subject); //TODO cambiar en producción
                    $message->to($mails)->cc('dlopez@globalcybersec.com')->subject($subject);
                    $log->info(Auth::user()->id, Auth::user()->username, 'Se envió Email a ' . $customer->mail . ' referente al reporte de Cibervigilancia');
                });
        } catch (Exception $e) {
//            $log->error(Auth::user()->id, Auth::user()->username, 'Error al intentar enviar el correo a ' . $incident->customer->mail . ' referente al incidente: ' . $incident->id . ' Excepción: ' . $e->getMessage());
            Log::info(Auth::user()->id . " " . Auth::user()->username . ' Error al intentar enviar el correo a ' . $customer->mail . ' reference al reporte de Cibervigilancia. Excepción: ' . $e->getMessage());
        }
    }

    private function cvGetHtml($i)
    {
        $validator = Validator::make($i, [
            'customer_id' => 'required',
            'from_date' => 'required',//|date_format:m/d/Y',
            'to_date' => 'required',//|date_format:m/d/Y'
        ]);

        if ($validator->fails()) {
            return Response::json(array('message' => 'Revise el formulario', 'errores' => $validator->errors()));
        }

        $customer_id = $i['customer_id'];

//
        $headers = array(
            "Content-Type" => "application/vnd.ms-word;charset=utf-8",
            "Content-Disposition" => "attachment;Filename=cyber-surveillance" . $i['customer_id'] . ".doc"
        );

        $from_date = DateTime::createFromFormat('m/d/Y', $i['from_date']);
        $to_date = DateTime::createFromFormat('m/d/Y', $i['to_date']);
        $from_date = $from_date->format('Y-m-d');
        $to_date = $to_date->format('Y-m-d');

        $customer = Customer::find($customer_id);
        $socialmedias = CustomerSocialmedia::whereBetween('created_at', array($from_date . ' 00:00:00', $to_date . ' 23:59:59'))->get();

        $pages = CustomerPage::whereBetween('created_at', array($from_date . ' 00:00:00', $to_date . ' 23:59:59'))->get();

        $htmlReport = View::make('customer.report.cyber-surv',
            array('from_date' => $i['from_date'],
                'to_date' => $i['to_date'],
                'customer' => $customer,
                'socialmedias' => $socialmedias,
                'pages' => $pages,
                'mail' => false))->render();

//        return Response::make($htmlReport, 200, $headers);
//        return Response::make($htmlReport, 200);
        return $htmlReport;
    }
}