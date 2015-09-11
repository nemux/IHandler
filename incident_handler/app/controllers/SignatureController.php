<?php

class SignatureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $signatures = Signature::all();
        return View::make('signature.index', array('signatures' => $signatures));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
//	public function create()
//	{
//		//
//	}


    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request
     * @return Response
     */
    public function store()
    {
        $input = Input::except(['_token', 'query_string']);

        $validator = Validator::make($input, [
            'signature' => 'required|max:255',
            'description' => 'required',
            'recommendation' => 'required',
            'reference' => '',
            'risk' => ''
        ]);

        if ($validator->fails()) {
            Input::flash();
            return Redirect::to('signatures')->withInput()->with(['message' => 'Revise el formulario'])->withErrors($validator);
        }

        Signature::insert($input);
        $message = 'Se agregó la nueva firma: ' . $input['signature'];

        return Redirect::route('signatures.index')->with('message_add_signature', $message);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
//	public function show($id)
//	{
//		//
//	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
//	public function edit($id)
//	{
//		//
//	}

//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  int $id
//     * @return Response
//     */
//    public function update($id)
//    {
//        //
//    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
//	public function destroy($id)
//	{
//		//
//	}


}
