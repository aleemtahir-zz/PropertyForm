<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropFromRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
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
    public function store(PropFromRequest $request)
    {
        //echo "<pre>"; print_r($request->all()); echo "</pre>";
        $error = false;
        $PropertyObj = new Property();

        //Transaction
        DB::beginTransaction();

        $data     = $request->input('property');
        $devId  = $PropertyObj->check_developer($data);

        $vendor             = $request->input('vendor');
        $ids['vendor']      = $PropertyObj->add_developer($vendor, $devId, $error);

        if($error)
            return back()->withErrors($error->getMessage())->withInput();

        $payment            = $request->input('monetary');
        $ids['payment']     = $PropertyObj->add_payment($payment, $error);

        if($error)
            return back()->withErrors($error->getMessage())->withInput();

        $buyer              = $request->input('buyer');
        $ids['buyer']       = $PropertyObj->add_purchaser($buyer, $error);

        if($error)
            return back()->withErrors($error->getMessage())->withInput();

        $attorney           = $request->input('attorney');
        $ids['attorney']    = $PropertyObj->add_attorney($attorney, $error);

        if($error)
            return back()->withErrors($error->getMessage())->withInput();

        $property           = $request->input('property');
        $PropertyObj->add_property($property, $ids, $error);
        DB::commit();

        if($error)
            return back()->withErrors($error->getMessage())->withInput();
        else
        {
          // Store all input
          $request->session()->put('propRequest', $request->all());

          //Show Word Templates
          $templates = array(
            'application_for_membership',
            'building_agreement',
            'developer_name_maintenance_agreement',
            'insrtument_of_transfer'
          );

          return view('forms.response',compact('templates'));
          
        }

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
        $templates = array(
            'application_for_membership',
            'building_agreement',
            'developer_name_maintenance_agreement',
            'insrtument_of_transfer' 
        );

        return view('forms.response',compact('templates'));
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

            $vcount = 0;
            $bcount = 0;
            $id = $response['p-id']['value']; 
            $vendors = $PropObj->getAllVendors($id, $vcount);
            $buyers = $PropObj->getAllBuyers($id, $bcount);
            $response['vcount'] = $vcount;
            $response['bcount'] = $bcount;
            $response = array_merge($response,$vendors, $buyers);
            //pre($response);die;
        }
        else if(!empty($folio))
        {
            $PropObj    = new Property();
            $response   = $PropObj->get_development($folio);
        }

        //pre($response); die;
        return json_encode($response);
    }

    public function mergeDownload(Request $request)
    {   
        
        if($request->templates)
          $template_name = $request->templates;
        elseif($request->mergeBtn)
          $template_name[] = $request->mergeBtn;
        else
          return Redirect::to('property/show')->with('message', 'Please Select Any Template.');
        
        $req = $request->session()->get('propRequest');
         
        $values['volume']    = $req['property']['volume_no']; 
        $values['folio']    = $req['property']['folio_no']; 
        $values['lot']      = $req['property']['lot_no'];

        $PropertyObj = new Property(); 
        $data = $PropertyObj->get_all($values);
        $id = $data['p-id']['value']; 
        $allVendors = $PropertyObj->getAllVendors($id);
        $allBuyers = $PropertyObj->getAllBuyers($id);
        
        //Organize Data
        foreach ($data as $key => $value) {
          $array[$value['prefix']][$value['key']] = $value['value'];
        }
        unset($array['v']);
        unset($array['b']);
        foreach ($allVendors as $k => $vendor) {
          foreach ($vendor as $key => $value) {
            $array[$value['prefix']][$k][$value['key']] = $value['value'];
          }
        }

        foreach ($allBuyers as $k => $buyer) {
          foreach ($buyer as $key => $value ) {
            $array[$value['prefix']][$k][$value['key']] = $value['value'];
          }
        }
        
        
        //File Counter
        $var = file_get_contents('counter.txt');
        $var++;
        file_put_contents('counter.txt', $var);

        //File Save As Name
        if(!empty($request->filename))
          $file = $request->filename;
        else
          $file = $array['b'][0]['middle'].'_'.$array['v'][0]['middle'].'_'.$array['p']['volume_no'].'/'.$array['p']['folio_no'].'_'.$var;

        $file = str_replace('__', '_', $file);

        //Action
        saveDoc($template_name, $file, $array);


        //Show Word Templates
        $templates = array(
            'application_for_membership',
            'building_agreement',
            'developer_name_maintenance_agreement',
            'insrtument_of_transfer'

        );

        return view('forms.response',compact('templates'));

        //pre($file_name); die;

    }

}
