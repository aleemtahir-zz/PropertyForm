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
        $data = array();
        $req  = $request->All();
        $data = array_merge($data, $req);
        $record_id = $data['monetary']['record_id'];

        if(empty($record_id))
            return back()->withErrors("* Record # is empty!")->withInput();

        $PropObj    = new Property();
        $filename   = $PropObj->mergeIntoTemplates($data['monetary']['record_id'], 'statement_of_account', $data);
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
        $path = storage_path() . '/app/public/docs/' . $filename;

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        // unlink($path);
        // $type = File::mimeType($path);

        // $response = Response::make($file, 200);
        // // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
        // $response->header('Pragma', ' no-cache');
        // $response->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
        // $response->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        // $response->header('Content-Disposition', 'attachment; filename='.$filename.';');
        // $response->header('Content-Transfer-Encoding', 'binary');
        // $response->header('Content-Length', .filesize($file));
        // readfile('GIE.docx');
        $name = "filename=".$filename.";";
        header('Pragma: no-cache');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; '.$name);
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize($path));
        readfile($path);
        unlink($path);
        // return $response;

    }
}
