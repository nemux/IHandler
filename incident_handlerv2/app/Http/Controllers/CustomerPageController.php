<?php

namespace App\Http\Controllers;

use App\Models\Customer\CustomerPage;
use App\Models\Link\Link;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerPageController extends Controller
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
        \Log::info($request->except('_token'));

        Link::validateCreate($request, $this);

        $customer_id = $request->get('customer_id');

        $link = new Link();
        $link->title = $request->get('title');
        $link->link = $request->get('link');
        $link->comments = $request->get('link_comments');
        $link->link_type_id = $request->get('link_type_id');
        $link->save();

        $page = new CustomerPage();
        $page->link_id = $link->id;
        $page->customer_id = $customer_id;
        $page->save();

        return redirect()->route('customer.show', $customer_id)->withMessage('Se agregó una nueva página');//->withTab('page');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $customerPage = CustomerPage::findOrNew($id);
        $link = $customerPage->link;

        \Log::info($link);

        return view('link.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customerPage = CustomerPage::findOrNew($id);
        $link = $customerPage->link;

        return view('link.edit', compact('link'));
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
        Link::validateUpdate($request, $this);

        $customerPage = CustomerPage::findOrNew($id);

        $link = $customerPage->link;
        $link->title = $request->get('title');
        $link->link = $request->get('link');
        $link->comments = $request->get('link_comments');
        $link->link_type_id = $request->get('link_type_id');
        $link->save();

        return redirect()->route('customer.show', $customerPage->customer_id)->withMessage('Se actualizó la página ' . $link->title);//->withTab('page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customerPage = CustomerPage::findOrNew($id);
        $customer_id = $customerPage->customer_id;
        $page_title = $customerPage->link->title;
        $customerPage->delete();

        return redirect()->route('customer.show', $customer_id)->withMessage('Se eliminó la página ' . $page_title);//->withTab('page');
    }
}
