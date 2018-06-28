<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Development;

class DevController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.dev');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $DevObj = new Development();

        //echo "<pre>"; print_r($request->all()); echo "</pre>";

        $developer          = $request->input('developer');
        $ids['developer']   = $DevObj->add_developer($developer);

        $contractor         = $request->input('contractor');
        $ids['contractor']  = $DevObj->add_contractor($contractor);

        $payment            = $request->input('payment');
        $ids['payment']     = $DevObj->add_payment($payment);

        $developement       = $request->input('developement');
        $developement_id    = $DevObj->add_developement($developement, $ids);

        return view('forms.thank_you');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

    public function updateView(Request $request)
    {   
        $id = $request->input('key');

        $DevObj = new Development();
        $response = $DevObj->get_development($id);

        return json_encode($response);
    }
}
