<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\InsertOnDuplicateKey;
use Exception;

class Development extends Model
{
    //User Trait
    use InsertOnDuplicateKey;

    public function add_developer($developer)
    { 
        $address_id   = null;
        $dev_officer1 = null;
        $dev_officer2 = null;

        //UNSET KEYS WHICH ARE EMPTY
        scanArray($developer);

        //GET ADDRESS ID
        if(!empty($developer['address'])){

          $address_obj = $developer['address'];
          nullToString($address_obj);

          $address_id = get_address($address_obj);

        }
          
        //GET DEVELOPER OFFICER 1        
        if(!empty($developer['do1'])){

            $do1 = $developer['do1'];
            nullToString($do1);

            $dev_officer1 = get_officer($do1,'developer_officer',1);
        }
                    
        //GET DEVELOPER OFFICER 2
        if(!empty($developer['do2'])){

            $do2 = $developer['do2'];
            nullToString($do2);

            $dev_officer2 = get_officer($do2,'developer_officer',2);

        }  

        //Upload Developer Logo
        $logo_path = '';
        $filename = 'developer_logo';
        
        if(isset($_FILES[$filename])){
          $dev_logo = upload_logo($filename);
          //pre($dev_logo);
          $logo_path = "";
          if($dev_logo['status'] == 1)
          {
            $logo_path = $dev_logo['path'];
          }  
        }
        

        //******************
        //ADD DEVELOPER INFO
        //******************

        /*CHECK DEVELOPER INFO IF EXIST ALREADY*/
        $dev_info = DB::table('tbl_developer_detail')
                       ->select('id')
                       ->where('company_name', '=', $developer['company_name'])
                       ->where('officer_id_1', '=', $dev_officer1)
                       ->where('officer_id_2', '=', $dev_officer2)
                       ->where('mobile', '=', $developer['mobile'])
                       ->where('email', '=', $developer['email'])
                       ->where('address_id', '=', $address_id)
                       ->where('logo', '=', $logo_path)
                       ->orderBy('id', 'desc')
                       ->first();


        if( empty($dev_info) ){

          /*INSERT DEV INFO */
          DB::table('tbl_developer_detail')->insert(
                [
                    'company_name'  => $developer['company_name'], 
                    'officer_id_1'  => $dev_officer1, 
                    'officer_id_2'  => $dev_officer2,
                    'mobile'        => $developer['mobile'],
                    'email'         => $developer['email'],
                    'address_id'    => $address_id,
                    'logo'          => $logo_path
                ]
            );
            /*GET DEV ID */
            $dev_id = DB::getPdo()->lastInsertId();
        } 
        else
        {
          $dev_id = $dev_info->id;

        }
        
        //echo "<pre>"; print_r($dev_id); echo "</pre>";
        
        return $dev_id;
    }

    public function add_developement($developement, $ids)
    { 
        $address_id     = null;
        $officer_id     = null;
        $developer_id   = $ids['developer'];
        $contractor_id  = $ids['contractor'];
        $payment_id     = $ids['payment'];

        //GET ADDRESS ID
        if(!empty($developement['address'])){

          $address_obj = $developement['address'];
          nullToString($address_obj);

          $address_id = get_address($address_obj);

        }
          
        //GET DEVELOPEMENT SURVEYOR        
        if(!empty($developement['surveyor'])){

            $surveyor = $developement['surveyor'];
            nullToString($surveyor);

            $officer_id = get_officer($surveyor,'development_surveyor');
        }

        //******************
        //ADD DEVELOPEMENT INFO
        //******************
        $total_lots_s       = null;
        $common_lots_s      = null;
        $residential_lots_s = null;
        $folio_key = explode(',', $developement['folio_no']);
        $folio_key = $folio_key[0];

        if(!empty($developement['t_lots_i']))
          $total_lots_s = convertNumberToWord($developement['t_lots_i']);

        if(!empty($developement['r_lots_i']))
          $residential_lots_s = convertNumberToWord($developement['r_lots_i']);

        if(!empty($developement['c_lots_i']))
          $common_lots_s = convertNumberToWord($developement['c_lots_i']);
        
        $table_name = 'tbl_developement_detail';
        $data = [
                    'id'                => $folio_key, 
                    'name'              => $developement['name'], 
                    'folio_no'          => $developement['folio_no'], 
                    'plan_no'           => $developement['plan_no'], 
                    'address_id'        => $address_id, 
                    'surveyor_id'       => $officer_id,
                    'developer_id'      => $developer_id,
                    'contractor_id'     => $contractor_id,
                    'payment_id'        => $payment_id,
                    'total_lots_i'      => $developement['t_lots_i'],
                    'total_lots_s'      => $total_lots_s,
                    'residential_lots_i'=> $developement['r_lots_i'],
                    'residential_lots_s'=> $residential_lots_s,
                    'common_lots_i'     => $developement['c_lots_i'],
                    'common_lots_s'     => $common_lots_s,
                    'lot_ids'           => $developement['lot_ids'],
                    'rsrv_road_no'      => $developement['rsrv_road']
                ];

        //Insert Update Development Data
        Development::insertOnDuplicateKey($data,$table_name);

    }

    public function add_contractor($contractor)
    { 
        $address_id  = null;
        $officer_id  = null;

        //UNSET KEYS WHICH ARE EMPTY
        scanArray($contractor);

        //GET ADDRESS ID
        if(!empty($contractor['address'])){

          $address_obj = $contractor['address'];
          nullToString($address_obj);

          $address_id = get_address($address_obj);

        }
          
        //GET CONTRACTOR OFFICER         
        if(!empty($contractor['co'])){

            $co = $contractor['co'];
            nullToString($co);

            $officer_id = get_officer($co,'contractor_officer');
        }


        //******************
        //ADD CONTRACTOR INFO
        //******************

        /*CHECK contractor INFO IF EXIST ALREADY*/
        $cont_info = DB::table('tbl_contractor_detail')
                       ->select('id')
                       ->where('company_name', '=', $contractor['company_name'])
                       ->where('officer_id', '=', $officer_id)
                       ->where('address_id', '=', $address_id)
                       ->orderBy('id', 'desc')
                       ->first();


        if( empty($cont_info) ){

          /*INSERT DEV INFO */
          DB::table('tbl_contractor_detail')->insert(
                [
                    'company_name'  => $contractor['company_name'], 
                    'officer_id'  => $officer_id,
                    'address_id'=> $address_id,
                ]
            );
            /*GET DEV ID */
            $cont_id = DB::getPdo()->lastInsertId();
        } 
        else
        {
          $cont_id = $cont_info->id;

        }

        //echo "<pre>"; print_r($cont_id); echo "</pre>";
        
        return $cont_id;
    }

    public function add_payment($payment)
    { 
        $fc_id       = null;

        //UNSET KEYS WHICH ARE EMPTY
        scanArray($payment);

        //GET FORIEGN CURRENCY ID
        if(!empty($payment['fc'])){

          $fc_obj = $payment['fc'];
          nullToString($fc_obj);

          $fc_id = get_foriegn_currency($fc_obj);

        }


        //******************
        //ADD PAYMENT DETAIL
        //******************
        $price_w  = null;
        $jprice_w = null;

        if(!empty($payment['price_i']))
          $price_w = convertNumberToWord($payment['price_i']);

        if(!empty($payment['jprice_i']))
          $jprice_w = convertNumberToWord($payment['jprice_i']);

        /*CHECK PAYMENT INFO IF EXIST ALREADY*/
        $payment_info = DB::table('tbl_dev_contract_payment')
                       ->select('id')
                       ->where('fc_id', '=', $fc_id)
                       ->where('price_i', '=', $payment['price_i'])
                       ->where('price_w', '=', $price_w)
                       ->where('j_price_i', '=', $payment['jprice_i'])
                       ->where('j_price_w', '=', $jprice_w)
                       ->where('deposit', '=', $payment['deposit'])
                       ->where('second_payment', '=', $payment['second_pay'])
                       ->where('third_payment', '=', $payment['third_pay'])
                       ->where('fourth_payment', '=', $payment['fourth_pay'])
                       ->where('final_payment', '=', $payment['final_pay'])
                       ->orderBy('id', 'desc')
                       ->first();


        if( empty($payment_info) ){

          /*INSERT CONTRACT PAYMENT DETAIL */
          DB::table('tbl_dev_contract_payment')->insert(
                [
                    'fc_id'         => $fc_id, 
                    'price_i'       => $payment['price_i'],
                    'price_w'       => $price_w,
                    'j_price_i'     => $payment['jprice_i'],
                    'j_price_w'      => $jprice_w,
                    'deposit'       => $payment['deposit'],
                    'second_payment'=> $payment['second_pay'],
                    'third_payment' => $payment['third_pay'],
                    'fourth_payment'=> $payment['fourth_pay'],
                    'final_payment' => $payment['final_pay'],
                ]
            );
            /*GET CONTRACT PAYMENT ID */
            $payment_id = DB::getPdo()->lastInsertId();
        } 
        else
        {
          $payment_id = $payment_info->id;

        }

        //echo "<pre>"; print_r($payment_id); echo "</pre>";
        
        return $payment_id;
    }

    function get_development($id='')
    {
      /*DB::enableQueryLog();*/
      if(empty($id))
        return 0;
      else
      {
        $ids  = explode(',', $id);
        $id   = $ids[0];  //1st part is key

        /*CHECK DEVELOPER INFO IF EXIST ALREADY*/
        $dev_info = DB::table('tbl_developement_detail as dt')
                        ->select('dt.name as dt-name','dt.folio_no as dt-folio_no','dt.plan_no as dt-plan_no','dt.total_lots_i as dt-t_lots_i', 'dt.total_lots_s as dt-t_lots_w', 'dt.residential_lots_i as dt-r_lots_i',
                          'dt.residential_lots_s as dt-r_lots_w', 'dt.common_lots_i as dt-c_lots_i',
                          'dt.common_lots_s as dt-c_lots_w', 'dt.lot_ids as dt-lot_ids', 'dt.rsrv_road_no as dt-rsrv_road', 
                          //Development Address
                          'dta.line1 as dt-address-line1','dta.line2 as dt-address-line2','dta.city as dt-address-city','dta.state as dt-address-state',
                          'dta.country as dt-address-country',    
                          //Development Surveyor
                          'so.title as dt-surveyor-title','so.first_name as dt-surveyor-first','so.last_name as dt-surveyor-last',
                          //Development Contractor
                          'c.company_name as c-company_name',
                          //Contractor Address
                          'ca.line1 as c-address-line1','ca.line2 as c-address-line2','ca.city as c-address-city','ca.state as c-address-state', 'ca.country as c-address-country', 
                          //Contractor Officer
                          'co.title as c-co-title','co.first_name as c-co-first','co.last_name as c-co-last','co.suffix as c-co-suffix',
                          'co.capacity as c-co-capacity','co.landline as c-co-landline',
                          //Developer                       
                          'd.company_name as d-company_name','d.mobile as d-mobile','d.email as d-email',
                          'd.logo as d-logo',
                          //Developer Address
                          'da.line1 as d-address-line1','da.line2 as d-address-line2','da.city as d-address-city','da.state as d-address-state',
                          'da.country as d-address-country',
                          //Developer Officer 1
                          'do1.title as d-do1-title1','do1.first_name as d-do1-first1','do1.last_name as d-do1-last1','do1.suffix as d-do1-suffix1',
                          'do1.capacity as d-do1-capacity1','do1.landline as d-do1-landline1',
                          //Developer Officer 1
                          'do2.title as d-do2-title2','do2.first_name as d-do2-first2','do2.last_name as d-do2-last2','do2.suffix as d-do2-suffix2',
                          'do2.capacity as d-do2-capacity2','do2.landline as d-do2-landline2',
                          //Contract Payment
                          'cp.price_i as cp-price_i','cp.j_price_i as cp-jprice_i','cp.deposit as cp-deposit','cp.second_payment as cp-second_pay','cp.third_payment as cp-third_pay','cp.fourth_payment as cp-fourth_pay','cp.final_payment as cp-final_pay',
                          //Contract Payment Foriegn Currency
                          'fc.name as cp-fc-name','fc.symbol as cp-fc-symbol','fc.exchange_rate as cp-fc-rate'
                        )
                        ->join('tbl_address as dta', 'dt.address_id', '=', 'dta.id')
                        ->join('tbl_developer_detail as d', 'dt.developer_id', '=', 'd.id')
                        ->join('tbl_address as da', 'd.address_id', '=', 'da.id')
                        ->join('tbl_person_info as so', 'dt.surveyor_id', '=', 'so.id')
                        ->join('tbl_person_info as do1', 'd.officer_id_1', '=', 'do1.id')
                        ->join('tbl_person_info as do2', 'd.officer_id_2', '=', 'do2.id')
                        ->join('tbl_contractor_detail as c', 'dt.contractor_id', '=', 'c.id')
                        ->join('tbl_address as ca', 'c.address_id', '=', 'ca.id')
                        ->join('tbl_person_info as co', 'c.officer_id', '=', 'co.id')
                        ->join('tbl_dev_contract_payment as cp', 'dt.payment_id', '=', 'cp.id')
                        ->join('tbl_foriegn_currency as fc', 'cp.fc_id', '=', 'fc.id')
                        ->where('dt.id', '=', $id)
                        ->get(); 
        /*dd(DB::getQueryLog());*/

        $mapper = array(
          'dt'  => 'developement',
          'd'   => 'developer',
          'c'   => 'contractor',
          'cp'  => 'payment',
        );                

        try{
          $dev_info = (array) $dev_info[0];
        }
        catch(\Exception $e)
        {
          //pre($e->getMessage());
          $dev_info = '';  
          return $dev_info;
        }

        foreach ($dev_info as $key => $value) 
        {
            $pieces = explode('-', $key);
            $i = $pieces[0];
            $pieces = array_reverse($pieces);
            
            if(count($pieces) == 3){
              $input = $mapper[$i]."[".$pieces[1]."]"."[".$pieces[0]."]";
            }
            else if(count($pieces) == 2){
              $input = $mapper[$i]."[".$pieces[0]."]";
            }

            $dev_info[$key]    = array(
              'key'   => $input,
              'value' => $value
            );          
            
        }                
                         
        return $dev_info;
      }
    }

}
