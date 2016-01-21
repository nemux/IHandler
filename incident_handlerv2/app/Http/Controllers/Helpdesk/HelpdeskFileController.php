<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Contracts\Filesystem\Filesystem;
use Models\Helpdesk\File;
use Models\Helpdesk\Ticket\TicketMessageFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HelpdeskFileController extends Controller
{

    /**
     * @var Filesystem
     */
    private static $disk;

    /**
     * Constructor de la clase
     */
    public function __construct()
    {
        self::$disk = \Storage::disk(env('FTP_NAME_HD'));
    }

    /**
     * Sube un archivo $file al servidor
     *
     * @param UploadedFile $file
     * @param $customer_path
     *
     * @return bool|File
     */
    public static function uploadFile(UploadedFile $file, $customer_path)
    {
        $extension = $file->getClientOriginalExtension();
        $md5_name = md5($file->getFilename());

        $mimeType = $file->getClientMimeType();

        $md5 = hash_file('md5', $file);
        $sha1 = hash_file('sha1', $file);
        $sha256 = hash_file('sha256', $file);

        // Crea un árbol de directorios con la fecha definiendo: año/mes/día/{md5}.{ext}
        //        $directory = 'upload/evidences/' . date('Y/m/d/');
        $path = strtolower($customer_path) . '/' . date('Y/m/d/');

        //Renombrar archivo
        $filename = $md5_name . '.' . $extension;

        //Valida si ya se almacenó un fichero con ese nombre
        $file_ = File::whereName($filename)->first();

        //Si no está definido el ID
        if (!isset($file_->id)) {
            //Almacenamos el archivo en disco
            self::$disk->put("$path$md5_name.$extension", \File::get($file), Filesystem::VISIBILITY_PRIVATE);

            $file_ = new File();
            $file_->mime_type = $mimeType;
            $file_->path = $path;
            $file_->name = $filename;
            $file_->original_name = $file->getClientOriginalName();
            $file_->note = 'SN';
            $file_->md5 = $md5;
            $file_->sha1 = $sha1;
            $file_->sha256 = $sha256;
            $file_->save();

            return $file_;
        } else {
            return $file_;
        }
    }

    /**
     * Retrieves the file stored on filesystem
     *
     * @param $ticket_message_id
     * @param $filename
     * @return mixed
     */
    public function getFile($ticket_message_id, $filename)
    {
        $ticketmessagefile = TicketMessageFile::whereTicketMessageId($ticket_message_id)->first();

        //Si se encontró el objeto con el ticket_message_id pasado como parámetro del método
        if ($ticketmessagefile) {
            //Obtener el ticket para comparar los customer_id del usuario y el ticket
            $ticket = $ticketmessagefile->ticketmessage->ticket;

            //Obtener el file con base en el file_id y el filename
            $file = File::whereId($ticketmessagefile->file_id)
                ->whereName($filename)
                ->first();

            //Si se encontró el archivo y los customer_id son iguales
            if ($file) {
                $file_ = self::$disk->get($file->path . $file->name);

                $headers = ['Content-Type' => $file->mime_type];

                //Regresa el archivo
                return response($file_, 200, $headers);
            }
        }

        abort(404);
    }
}

