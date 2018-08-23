<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Development;
use App\Http\Requests\DevForm;
use Mail;
use Exception;

class DevController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('forms.thank_you');
        if(strpos($_SERVER['REQUEST_URI'], 'DeveloperDataFormA') !== false)
            $template = 'DeveloperDataFormA';
        else
            $template = 'DeveloperDataFormB';

        return view('forms.dev', compact('template'));
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
    public function store(DevForm $request)
    {

        // print_r($request->all()); die;
        $error = false;
        $DevObj = new Development();

        $data     = $request->input('developement');
        $data['volume_str'] = implode(',', $data['volume_no']);
        $data['folio_str']  = implode(',', $data['folio_no']);
        $data['volume_no']  = $data['volume_no'][0] ? $data['volume_no'][0] : '';
        $data['folio_no']   = $data['folio_no'][0]  ? $data['folio_no'][0]  : ''; 
        
        $devId    = $DevObj->check_developer($data);

        $developer          = $request->input('developer');
        $ids['developer']   = $DevObj->add_developer($developer, $devId, $error);

        if($error)
            return back()->withErrors($error->getMessage())->withInput();

        $contractor         = $request->input('contractor');
        $ids['contractor']  = $DevObj->add_contractor($contractor, $error);

        if($error)
            return back()->withErrors($error->getMessage())->withInput();

        $payment                        = $request->input('payment');
        $payment['half_title']          = !empty($payment['half_title']) ? $payment['half_title'] / 2 : '';
        $payment['half_agreement']      = !empty($payment['half_agreement']) ? $payment['half_agreement'] / 2 : '';
        $payment['identification_fee']  = !empty($payment['identification_fee']) ? $payment['identification_fee'] : '';

        $ids['payment']     = $DevObj->add_payment($payment, $error);

        if($error)
            return back()->withErrors($error->getMessage())->withInput();

        $developement_id    = $DevObj->add_developement($data, $ids, $error);

        if(!$error)
        {
            // Store result
            $request->session()->put('devRequest', $request->input('developement'));
            $request->session()->put('devForm', $request->all());

            if(strpos($_SERVER['REQUEST_URI'], 'DeveloperDataFormA') !== false)
                $template = 'FormA';
            else
                $template = 'FormB';
   
            return view('forms.thank_you',compact('template'));
        }
        else
            return back()->withErrors($error->getMessage())->withInput();

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

    public function sendEmail(Request $request)
    {
        $to_address = $request->input('email');
        $data = $request->session()->get('devRequest');

        Mail::send('layouts.email',$data, function ($message) use ($to_address) /*variable innheriting*/{
            $message->from('hmf@williamswebs.com','HMF Property');
            $message->to($to_address);
            $message->subject('HMF Property Code');
        });

        $template = 'FormA';
        return view('forms.thank_you',compact('template'));
    }
}
