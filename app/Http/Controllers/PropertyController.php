<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
class PropertyController extends Controller
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
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "<pre>"; print_r($request->all()); echo "</pre>";
        $PropertyObj = new Property();

        $vendor             = $request->input('vendor');
        $ids['vendor']      = $PropertyObj->add_developer($vendor);

        $payment            = $request->input('monetary');
        $ids['payment']     = $PropertyObj->add_payment($payment);

        $buyer              = $request->input('buyer');
        $ids['buyer']       = $PropertyObj->add_purchaser($buyer);

        $attorney           = $request->input('attorney');
        $ids['attorney']    = $PropertyObj->add_attorney($attorney);

        
        $property           = $request->input('property');
        $property_id        = $PropertyObj->add_property($property, $ids);
        die;

        //return view('forms.response');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('forms.property');

        /*// load your template
        $TBS->LoadTemplate('templates/membership.docx');
        // replace variables
        $TBS->MergeField('a', array('v_first' => 'Ford Prefect'));
        // send the file
        $TBS->Show(OPENTBS_DOWNLOAD, 'file_name.docx');*/
        //return view('forms.property');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
