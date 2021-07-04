<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.payment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->All();
        $record_id = $data['monetary']['record_id'];

        if(empty($record_id))
            return back()->withErrors("* Record # is empty!")->withInput();


        $total_expense      = !empty($data['monetary']['total_expense']) ? str_replace(',', '', $data['monetary']['total_expense']) : 0;
        $total_payment_j    = !empty($data['monetary']['total_payment_j']) ? str_replace(',', '', $data['monetary']['total_payment_j']) : 0;
        $rate               = !empty($data['payment']['rate'][0]) ? str_replace(',', '', $data['payment']['rate'][0]) : 1;
        $fc_name            = $data['payment']['fc_name'];
        // $data['monetary']['balance'] = $total_payment - $total_expense;
        $data['monetary']['total_payment']  = $total_payment_j / $rate;
        $data['monetary']['fc_name']        = $fc_name[0];
        // pre($rate); die;


        //Set Data
        $expense = array();
        foreach ($data['expense'] as $key => $value) {
            foreach ($value as $k => $v) {
                $expense[$k][$key] = $v;
            }
        }
        $payment = array();
        foreach ($data['payment'] as $key => $value) {
            foreach ($value as $k => $v) {
                $payment[$k][$key] = $v;
            }
        }

        $data['expense'] = $expense;
        $data['payment'] = $payment;

        //Create File Name
        $filename  = "SOA_".$record_id."_".date("Y-m-d");
        $filename  = preg_replace('/\s+/', '', $filename);

        //Start Mergeing
        $PropObj    = new Property();
        $filename   = $PropObj->mergeIntoTemplates($record_id, 'statement_of_account', $filename, $data);
        $showModal = true; 
        // $filename  = "SOA_Record#_date";
        return view('forms.payment',compact('showModal','filename'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {

        /*Merge Statement of Account Template*/
        saveDoc("statement_of_account", $file, $data);

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
    public function destroy($file)
    {
        $filePath = storage_path() . '/app/public/docs/' . $file.'.docx';
        pre($filePath);

        /*$ok = Storage::url('app/public/docs/'.$file);   
        pre($ok);  
        $file = Storage::get('docs/'.$file);   
        pre($file);  

        if ($file)
        {
            $response = Response::make($file, 200);
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

            return $response;
        }*/



        // Check file exist or not
        if( file_exists($filePath) ){
            // pre("start");
            // Remove file 
            unlink($filePath);

        }
        // pre("end"); die;
    }

    public function download($filename='')
    {
        $dirname = storage_path() . "/app/public/docs";
    
        $path = $dirname .'/'. $filename;
        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        
        $name = "filename=".$filename.";";
        header('Pragma: no-cache');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; '.$name);
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize($path));
        readfile($path);
        // unlink($path);
        // return $response;

    }
}
