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
        $data['property'] = $request->session()->get('devForm')['developement'];
        $data['vendor']   = $request->session()->get('devForm')['developer'];
        $data['monetary'] = $request->session()->get('devForm')['payment'];
        
        $data['property']['volume_str'] = implode(',', $data['property']['volume_no']);
        $data['property']['folio_str']  = implode(',', $data['property']['folio_no']);
        $data['property']['volume_no']  = $data['property']['volume_no'][0] ? $data['property']['volume_no'][0] : '';
        $data['property']['folio_no']   = $data['property']['folio_no'][0]  ? $data['property']['folio_no'][0]  : ''; 

        $data['monetary']['half_title']          = !empty($data['monetary']['half_title']) ? $data['monetary']['half_title'] / 2 : '';
        $data['monetary']['half_agreement']      = !empty($data['monetary']['half_agreement']) ? $data['monetary']['half_agreement'] / 2 : '';
        $data['monetary']['identification_fee']  = !empty($data['monetary']['identification_fee']) ? $data['monetary']['identification_fee'] : '';
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
        //echo "<pre>"; print_r($request->all()); echo "</pre>";
        //$flattener = new Flattener();
        //$flattener->setArrayData($request->all());
        //$flattener->writeCsv();
        //$flat = $flattener->getFlatData();
        //$csv = array_map('str_getcsv', file('file_88426349.csv'));
        //$a = csvToArray('file_88426349');
        //pre($a); 
        //die;

        $error = false;
        $req = $request->all();
        $PropertyObj = new Property();

        //Transaction
        DB::beginTransaction();

        $error = $PropertyObj->initialize($req);
        
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
            'insrtument_of_transfer',
            'letter_of_title_issuance',
            'memorandum_of_sale',
            'statement_of_account'
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
      
        for ($i=0; $i < count($data) ; $i++) { 
          $PropertyObj = new Property();
          //Transaction
          DB::beginTransaction();

          $error = $PropertyObj->initialize($data[$i]);
          
          DB::commit();
          if(!empty($error))
            return $error->getMessage();
        }
      }
      
      //Show Word Templates
      $templates = array(
          'application_for_membership',
          'building_agreement',
          'developer_name_maintenance_agreement',
          'insrtument_of_transfer',
          'letter_of_title_issuance',
          'memorandum_of_sale',
          'statement_of_account'             
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

            if(isset($response['p-id']['value']))
            {
              $id = $response['p-id']['value']; 
              $vendors = $PropObj->getAllVendors($id, $vcount);
              $buyers = $PropObj->getAllBuyers($id, $bcount);
              $response['vcount'] = $vcount;
              $response['bcount'] = $bcount;
              $response = array_merge($response,$vendors, $buyers);
            }
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
       
	      if($request->mergeBtn)
          $template_name[] = $request->mergeBtn;
        /*else
          return Redirect::to('property/show')->with('message', 'Please Select Any Template.');*/
        
        if(!empty($request->session()->get('propRequest')))
        {
          $req = $request->session()->get('propRequest'); 
          $values['volume']   = $req['property']['volume_no']; 
          $values['folio']    = $req['property']['folio_no']; 
          $values['lot']      = $req['property']['lot_no'];
        }
        
        if(empty($request->autocomplete))
          return Redirect::to('property/show')->with('message', 'Please Select Any Record ID.');
        else
        {
          $ids = explode(' ', $request->autocomplete);

          $values['volume']   = $ids[0]; 
          $values['folio']    = $ids[1]; 
          $values['lot']      = $ids[2];
        } 

	      $PropertyObj = new Property(); 
        $data = $PropertyObj->get_all($values);
        $id = $data['p-id']['value']; 
        $allVendors = $PropertyObj->getVendors($id,$vCount);
        $allBuyers = $PropertyObj->getBuyers($id,$bCount);
        
        //Organize Data
        foreach ($data as $key => $value) {
          $array[$value['prefix']][$value['key']] = $value['value'];
        }
        unset($array['v']);
        unset($array['b']);
        //pre($allVendors); die;
        
        $i = 0;
        foreach ($allVendors as $k => $vendor) {
          foreach ($vendor as $key => $value) {
            $array[$vendor['prefix']][$vendor['index']][$vendor['key']] = $vendor['value'];    
          }

          if($vendor['index'] < $vCount - 1)
          {
            $array[$vendor['prefix']][$vendor['index']]['cand'] = 'AND';
            $array[$vendor['prefix']][$vendor['index']]['and'] = 'and';
            $array[$vendor['prefix']][$vendor['index']]['comma'] = ',';
            $i++;
          }
          else
            $array[$vendor['prefix']][$vendor['index']]['cand'] = '';
            $array[$vendor['prefix']][$vendor['index']]['and'] = '';
            $array[$vendor['prefix']][$vendor['index']]['comma'] = '';

        }
        
        foreach ($allBuyers as $k => $buyer) {
          foreach ($buyer as $key => $value ) {
            $array[$buyer['prefix']][$buyer['index']][$buyer['key']] = $buyer['value'];
          }

          if($buyer['index'] < $bCount - 1)
          {
            $array[$buyer['prefix']][$buyer['index']]['and'] = 'AND';
            $i++;
          }
          else
            $array[$buyer['prefix']][$buyer['index']]['and'] = '';
        }
        //pre($array); die;
        
        //File Counter
        $var = file_get_contents('counter.txt');
        $var++;
        file_put_contents('counter.txt', $var);
        
        if(strlen($var) == 1)
          $var = '000'.$var;
        elseif(strlen($var) == 2)
          $var = '00'.$var;
        elseif(strlen($var) == 3)
          $var = '0'.$var;

        //pre(strlen($var)); die;

        //File Save As Name
        $buyer = (isset($array['b'][0]['middle'])) ? $array['b'][0]['middle'] : $array['b'][0]['last'];
        $vendor = (isset($array['v'][0]['middle'])) ? $array['v'][0]['middle'] : $array['v'][0]['last'];



        if(!empty($request->filename))
          $file = $request->filename;
        else
          $file = $buyer.'_'.$vendor.'_'.$array['p']['volume_no'].'/'.$array['p']['folio_no'].'_'.$var;

        $file = str_replace('__', '_', $file);

        //Action
        saveDoc($template_name, $file, $array);


        //Show Word Templates
        $templates = array(
            'application_for_membership',
            'building_agreement',
            'developer_name_maintenance_agreement',
            'insrtument_of_transfer',
            'letter_of_title_issuance',
            'memorandum_of_sale',
            'statement_of_account'


        );

        return view('forms.response',compact('templates'));

        //pre($file_name); die;

    }

    public function autocomplete(){
      
      //pre($_GET['term']); die;
      $search = $_GET['term'];
      $ids = explode('/', $search);
      $results = array();
      
      $queries = DB::table('tbl_key_id')
        ->where('volume_no', 'LIKE', '%'.$ids[0].'%');

      if(isset($ids[1])){
        $queries->where('folio_no', 'LIKE', '%'.$ids[1].'%');
      }  

      if(isset($ids[2])){
        $queries->where('lot_no', 'LIKE', '%'.$ids[2].'%');
      }  
        
      $queries = $queries->take(5)->get();
      
      foreach ($queries as $query)
      {
          $results[] = [ 'id' => $query->id, 'value' => $query->volume_no.' '.$query->folio_no.' '.$query->lot_no ];
      }
      return Response::json($results);
    }

}
