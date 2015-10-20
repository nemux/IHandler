<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use App\Models\EvidenceType;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
     * Método para subir archivos diréctamente en el folder correspondiente
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadSurveillance(Request $request)
    {
        $file = $request->file('file');
        $evidence = false;
        $type = EvidenceType::whereName('Cibervigilancia')->first();

        if (!is_array($file)) {
            $evidence = $this->uploadSingleFile($file, $type);
        } else {
            foreach ($file as $i => $f) {
                $thisFile = $this->uploadSingleFile($f, $type);

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

    private function uploadSingleFile($file, EvidenceType $type)
    {
        $mimeType = \File::mimeType($file);

        $md5 = hash_file('md5', $file);
        $sha1 = hash_file('sha1', $file);
        $sha256 = hash_file('sha256', $file);

        // Crea un árbol de directorios con la fecha definiendo: año/mes/día/{md5}.{ext}
        $directory = 'evidences/' . date('Y/m/d/');

        $filename = $md5 . "." . \File::extension($file->getClientOriginalName());

        if ($file->move($directory, $filename)) {
            $evidence = Evidence::whereName($filename)->wherePath($directory)->first();

            if (!isset($evidence->id))
                $evidence = new Evidence();

            $evidence->evidence_type_id = $type->id;
            $evidence->mime_type = $mimeType;
            $evidence->path = $directory;
            $evidence->name = $filename;
            $evidence->original_name = $file->getClientOriginalName();
            $evidence->note = 'SN';
            $evidence->md5 = $md5;
            $evidence->sha1 = $sha1;
            $evidence->sha256 = $sha256;
            $evidence->save();

            $imgbinary = fread(fopen($directory . $filename, "r"), filesize($directory . $filename));
            $evidence->base64 = 'data:' . $mimeType . ';base64,' . base64_encode($imgbinary);

            return $evidence;
        } else {
            return false;
        }
    }
}
