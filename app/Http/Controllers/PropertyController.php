<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Property;
use Carbon\Carbon;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.property');
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
        //echo "<pre>"; print_r($request->all()); echo "</pre>";
        $PropertyObj = new Property();

        $data     = $request->input('property');
        $devId  = $PropertyObj->check_developer($data);

        $vendor             = $request->input('vendor');
        $ids['vendor']      = $PropertyObj->add_developer($vendor, $devId);

        $payment            = $request->input('monetary');
        $ids['payment']     = $PropertyObj->add_payment($payment);

        $buyer              = $request->input('buyer');
        $ids['buyer']       = $PropertyObj->add_purchaser($buyer);

        $attorney           = $request->input('attorney');
        $ids['attorney']    = $PropertyObj->add_attorney($attorney);

        $property           = $request->input('property');
        $PropertyObj->add_property($property, $ids);

        // Store all input
        $request->session()->put('request', $request->all());

        //Show Word Templates
        $templates = array(
            'developer_name_maintenance_agreement'/*,
            'membership' */
        );

        return view('forms.response',compact('templates'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show Word Templates
        /*$templates = array(
            'developer_name_maintenance_agreement',
            'membership' 
        );

        return view('forms.response',compact('templates'));*/
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

    public function updateProperty(Request $request)
    {   

        $response   = '';
        $lot        = $request->input('lot');
        $folio      = $request->input('folio');

        if(!empty($folio) && !empty($lot))
        {
            $values['folio'] = $folio;
            $values['lot'] = $lot;
            $PropObj    = new Property();
            $response   = $PropObj->get_property($values);
        }
        else if(!empty($folio))
        {
            $PropObj    = new Property();
            $response   = $PropObj->get_development($folio);
        }


        return json_encode($response);
    }

    public function mergeDownload(Request $request)
    {   
        $file_name = '';
        switch($request->mergeBtn) {

            case 'developer_name_maintenance_agreement': 
                $file_name = 'developer_name_maintenance_agreement';
            break;

            case 'membership': 
                $file_name = 'membership';
            break;
        }
        $req = $request->session()->get('request');
        $values['folio']    = $req['property']['folio_no']; 
        $values['lot']      = $req['property']['lot_no'];

        $PropertyObj = new Property(); 
        $data = $PropertyObj->get_all($values);

        //Date
        $date['day']    = date('l');
        $date['month']  = date('F');
        $date['year']   = date('Y');

        // Include classes 
        // Load the TinyButStrong template engine 
        require_once base_path('vendor/mbence/opentbs-bundle/MBence/OpenTBSBundle/lib/tbs_class.php'); 
        // Load the OpenTBS plugin 
        require_once base_path('vendor/mbence/opentbs-bundle/MBence/OpenTBSBundle/lib/tbs_plugin_opentbs.php'); 

        // Initialize the TBS instance 
        $TBS = new \clsTinyButStrong; // new instance of TBS 
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

        // load your template
        $TBS->LoadTemplate('templates/'.$file_name.'.docx');

        //pre($data); die;
        if(!empty($data)){
            foreach ($data as $key => $value) {

            $array[$value['prefix']][$value['key']] = $value['value'];
    
            }
            //pre($array); die;
            try{
                // replace variables
                $TBS->MergeField('date', $date);
                $TBS->MergeField('v', $array['v']);
                $TBS->MergeField('p', $array['p']);
                $TBS->MergeField('b', $array['b']);
            }
            catch(\Exception $e)
            {
              pre($e->getMessage());
              //$property_info = '';  
              //return $property_info;
            }

            // send the file
            $var = file_get_contents('counter.txt');
            $var++;
            file_put_contents('counter.txt', $var);
            $file = $array['v']['middle'].'_'.$array['b']['middle'].$var;
            $TBS->Show(OPENTBS_DOWNLOAD, $file.'.docx');    
        }
        

        //Show Word Templates
        $templates = array(
            'developer_name_maintenance_agreement'/*,
            'membership' */
        );

        return view('forms.response',compact('templates'));

        //pre($file_name); die;

    }

}
