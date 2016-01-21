<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Models\IncidentManager\Evidence\Evidence;
use Models\IncidentManager\Evidence\EvidenceType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Método para subir archivos directamente en el folder de Incidentes
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadIncident(Request $request)
    {
        $file = $request->file('file');

        return $this->upload($file);
    }

    /**
     * Método para subir archivos diréctamente en el folder de Cibervigilancia
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadSurveillance(Request $request)
    {
        $file = $request->file('file');

        return $this->upload($file);
    }

    /**
     * Con base en el archivo y el tipo de evidencia, se subirá la evidencia
     *
     * @param $file
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(UploadedFile $file)
    {
        $evidence = false;

        if (!is_array($file)) {
            $evidence = $this->uploadSingleFile($file);
        } else {
            foreach ($file as $i => $f) {
                $thisFile = $this->uploadSingleFile($f);

                if (!$thisFile) {
                    $evidence = $thisFile;
                }
            }
        }

        if ($evidence) {
            return \Response::json($evidence, 200);
        } else {
            return \Response::json('No se pudo guardar el archivo', 400);
        }
    }

    /**
     * Sube un archivo $file al servidor
     *
     * @param $file
     * @return bool|Evidence
     */
    public static function uploadSingleFile(UploadedFile $file)
    {
        $mimeType = $file->getMimeType();

        $md5 = hash_file('md5', $file);
        $sha1 = hash_file('sha1', $file);
        $sha256 = hash_file('sha256', $file);

        // Crea un árbol de directorios con la fecha definiendo: año/mes/día/{md5}.{ext}
        $directory = 'evidences/' . date('Y/m/d/');

        $filename = $md5 . "." . \File::extension($file->getClientOriginalName());

        $writed = \Storage::put($directory . $filename, \File::get($file));

        if ($writed) {
            $evidence = Evidence::whereName($filename)->wherePath($directory)->first();

            if (!isset($evidence->id))
                $evidence = new Evidence();

            $evidence->mime_type = $mimeType;
            $evidence->path = $directory;
            $evidence->name = $filename;
            $evidence->original_name = $file->getClientOriginalName();
            $evidence->note = 'SN';
            $evidence->md5 = $md5;
            $evidence->sha1 = $sha1;
            $evidence->sha256 = $sha256;
            $evidence->save();

            $imgbinary = \Storage::get($directory . $filename);

            $evidence->base64 = 'data:' . $mimeType . ';base64,' . base64_encode($imgbinary);

            return $evidence;
        } else {
            return false;
        }
    }

    /**
     * Obtiene de un $request todos los elementos que estén relacionados con evidencia.
     * @param Request $request
     * @return array
     */
    public static function getEvidences(Request $request)
    {
        $values = $request->all();
        $evidences = array();
        foreach ($values as $field => $value) {
            $pos = strpos($field, 'evidence_');
            if ($pos !== false) {
                $evidence = Evidence::whereId($value)->first();
                array_push($evidences, $evidence);
            }
        }

        return $evidences;
    }

    /**
     * Obtiene el archivo por ID
     *
     * @param $evidence_id
     * @return mixed
     */
    public function getFile($evidence_id)
    {
        $evidence = Evidence::whereId($evidence_id)->first();

        $file = \Storage::get($evidence->path . $evidence->name);

        $headers = ['Content-Type' => $evidence->mime_type, 'Content-Disposition' => 'inline; filename="' . $evidence->original_name . '"'];

        //Regresa el archivo
        return response($file, 200, $headers);
    }
}
