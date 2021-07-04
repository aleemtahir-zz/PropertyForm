<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropFromRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use NestedJsonFlattener\Flattener\Flattener;
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
    public function index(Request $request)
    { 
        //Getting Session data and render it to Property Form

        if(!empty($request->session()->get('devForm')))
        {
          $data['property'] = $request->session()->get('devForm')['developement'];
          $data['vendor']   = $request->session()->get('devForm')['developer'];
          $data['monetary'] = $request->session()->get('devForm')['payment'];
          $data['developement'] = $request->session()->get('devForm')['developement'];
          
          $data['property']['dev_id']     = $data['developement']['id'];
          
          $data['property']['volume_str'] = implode(',', $data['property']['volume_no']);
          $data['property']['folio_str']  = implode(',', $data['property']['folio_no']);
          $data['property']['volume_no']  = $data['property']['volume_no'][0] ? $data['property']['volume_no'][0] : '';
          $data['property']['folio_no']   = $data['property']['folio_no'][0]  ? $data['property']['folio_no'][0]  : ''; 

          $data['monetary']['half_title']          = !empty($data['monetary']['title_cost']) ? 
                                                      (int)str_replace(',', '', $data['monetary']['title_cost']) / 2 : '';
          $data['monetary']['half_land_agreement'] = !empty($data['monetary']['land_agreement_cost']) ? 
                                                      str_replace(',', '', $data['monetary']['land_agreement_cost']) / 2 : '';
          $data['monetary']['half_build_agreement']= !empty($data['monetary']['build_agreement_cost']) ? 
                                                      str_replace(',', '', $data['monetary']['build_agreement_cost']) / 2 : '';
          $data['monetary']['identification_fee']  = !empty($data['monetary']['identification_fee']) ? 
                                                      str_replace(',', '', $data['monetary']['identification_fee']) : '';
        }
        //pre($data); die;
        return view('forms.property',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropFromRequest $request)
    {
        
        //print_r($req['property']); die;
        // echo "<pre>"; print_r($request->all()); echo "</pre>";
        // $flattener = new Flattener();
        // $flattener->setArrayData($request->all());
        // $flattener->writeCsv();
        // $flat = $flattener->getFlatData();
        // pre($flat); 
        // die;
        // $csv = array_map('str_getcsv', file('file_88426349.csv'));
        // $a = csvToArray('file_88426349');

        $error = false;
        $req = $request->all();
        $PropertyObj = new Property();

        //Check Duplicate Property Key
        if($PropertyObj->validateRequest($req))
            return back()->withErrors("*Record Already Exist with same Developer Name and Lot No.")->withInput();  

        //Transaction
        DB::beginTransaction();

        $error = $PropertyObj->initialize($req);
        
        DB::commit();

        if($error)
            return back()->withErrors($error)->withInput();
        else
        {
          // Store all input
          $request->session()->put('propRequest', $request->all());

          //Show Word Templates
          $templates = array(
            'application_for_membership' => 'Application For Membership',
            'building_agreement' => 'Building Agreement',
            'developer_name_maintenance_agreement' => 'Developer Name Maintenance Agreement',
            'instrument_of_transfer' => 'Instrument Of Transfer',
            'letter_of_title_issuance' => 'Letter Of Title Issuance',
            'memorandum_of_sale' => 'Memorandum Of Sale',
            'statement_of_account' => 'Statement Of Account'
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
      /*$url = Storage::url('tara.jpg'); 
      pre($url); die;*/

      if(!empty($id) && $id != 'show')
      { 
        $data = csvToArray($id);
      
        foreach ($data as $key => $value) {
          // pre($value); die;
          $PropertyObj = new Property();
          //Transaction
          DB::beginTransaction();

          $error = $PropertyObj->initialize($value);
          
          DB::commit();
          if(!empty($error))
            return $error->getMessage()."<br>File: ".__FILE__."<br>Line: ".__LINE__;
        }

        //Delete File
        $url = storage_path() . '/app/public/sheets/'.$id;
        unlink($url);
      }
      

      //Show Word Templates
      $templates = array(
            'application_for_membership' => 'Application For Membership',
            'building_agreement' => 'Building Agreement',
            'developer_name_maintenance_agreement' => 'Developer Name Maintenance Agreement',
            'instrument_of_transfer' => 'Instrument Of Transfer',
            'letter_of_title_issuance' => 'Letter Of Title Issuance',
            'memorandum_of_sale' => 'Memorandum Of Sale',
            'statement_of_account' => 'Statement Of Account'
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
        $id         = $request->input('id');
        $flag       = $request->input('devFlag');
        $PropObj    = new Property();
        $response   = '';

        if(!empty($id) && $flag != 1)
        {
            $values['id'] = $PropObj->get_id('tbl_key_id','property_key',$id);
            $response   = $PropObj->get_property($values);

            $vcount = 0;
            $bcount = 0;
            //pre($response); die;
            //If Record found
            if(isset($response['p-id']['value']))
            {
              $id = $response['p-id']['value']; 
              $vendors = $PropObj->getAllVendors($id, $vcount);
              $buyers = $PropObj->getAllBuyers($id, $bcount);
              $response['vcount'] = $vcount;
              $response['bcount'] = $bcount;
              $response = array_merge($response,$vendors, $buyers);

            }
        }
        else
        {
            $PropObj    = new Property();
            $response   = $PropObj->get_development($id);
        }

        return json_encode($response);
    }

    public function mergeDownload(Request $request)
    {   
        $PropObj    = new Property();
        
	      if($request->mergeBtn)
          $template_name = $request->mergeBtn;
        /*else
          return Redirect::to('property/show')->with('message', 'Please Select Any Template.');*/
        
        // if(!empty($request->session()->get('propRequest')))
        // {
        //   $req = $request->session()->get('propRequest'); 
        //   $values['volume']   = $req['property']['volume_no']; 
        //   $values['folio']    = $req['property']['folio_no']; 
        //   $values['lot']      = $req['property']['lot_no'];
        // }
        
        if(empty($request->autocomplete))
          return Redirect::to('property/show')->with('message', 'Please Select Any Record ID.');
        else
        {
          $filename = $PropObj->mergeIntoTemplates($request->autocomplete, $template_name, $request->filename);
          return Redirect::to(env('VIEW_DOC').$filename.'.docx');
        } 
        // dd($filename);
        //Show Word Templates
        $templates = array(
            'application_for_membership' => 'Application For Membership',
            'building_agreement' => 'Building Agreement',
            'developer_name_maintenance_agreement' => 'Developer Name Maintenance Agreement',
            'instrument_of_transfer' => 'Instrument Of Transfer',
            'letter_of_title_issuance' => 'Letter Of Title Issuance',
            'memorandum_of_sale' => 'Memorandum Of Sale',
            'statement_of_account' => 'Statement Of Account'
          );

        return view('forms.response',compact('templates'));

        //pre($file_name); die;

    }

    public function autocomplete(){
      
      //pre($_GET['term']); die;
      $search = $_GET['term'];
      $results = array();
      
      $queries = DB::table('tbl_key_id')
        ->where('property_key', 'LIKE', '%'.$search.'%');
 
        
      $queries = $queries->take(5)->get();
      
      foreach ($queries as $query)
      {
          $results[] = [ 'id' => $query->id, 'value' => $query->property_key ];
      }
      return Response::json($results);
    }

    public function autoDevName(){
      
      //pre($_GET['term']); die;
      $search = $_GET['term'];
      $results = array();
      
      $queries = DB::table('tbl_developement_detail')
        ->where('name', 'LIKE', '%'.$search.'%');  
        
      $queries = $queries->take(5)->get();
      
      foreach ($queries as $query)
      {
          $results[] = [ 'id' => $query->id, 'value' => $query->name ];
      }
      return Response::json($results);
    }

}
