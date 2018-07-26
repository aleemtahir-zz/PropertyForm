<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\InsertOnDuplicateKey;
use Exception;
use App\Helper;

class Property extends Model
{
    //User Trait
    use InsertOnDuplicateKey;

    public function check_developer($data)
    {
      $folio_key = $data['volume_no'].'_'.$data['folio_no'];
      $dev_info = DB::table('tbl_developement_detail')
                         ->select('developer_id')
                         ->where('id', $folio_key)
                         ->first();
      $dev_id = '';                   
      if(!empty($dev_info))
        $dev_id = $dev_info->developer_id;
      
      return $dev_id;                    
    }

    public function check_purchaser($data)
    {
      //$folio_key = $data['volume_no'].'_'.$data['folio_no'];
      $rs = DB::table('tbl_key_id as key')
                         ->select('pba.purchaser_id')
                         ->join('tbl_property_buyer_assoc as pba','key.id', '=', 'pba.property_id')
                         ->where('volume_no', $data['volume_no'])
                         ->where('folio_no', $data['folio_no'])
                         ->where('lot_no', $data['lot_no'])
                         ->first();
      $id = '';                   
      if(!empty($rs))
        $id = $rs->purchaser_id;
      
      return $id;                    
    }

    public function add_developer($developer, $devId='', &$error=false)
    {

    	  $address_id   = null;

        $company_name = $developer['company_name'];
        unset($developer['company_name']);

        //UNSET KEYS WHICH ARE EMPTY
        //scanArray($developer);
        $developer = arrangeMultiArray($developer);

        $i = 0;
        foreach ($developer as $key => $developer) {

        	//GET ADDRESS ID
	        if(!empty($developer['address'])){

	          $address_obj = $developer['address'];
	          nullToString($address_obj);

	          $address_id = get_address($address_obj, $error);

	        }
	          
	        //******************
	        //ADD DEVELOPER INFO
	        //******************

	        $mapper = array(
  			    'name','last','middle','suffix','trn_no','dob','occupation',
  			    'phone','mobile','email'
    			);

    			foreach ($mapper as $key) {

    				if( !array_key_exists($key, $developer) )
    				  $developer[$key] = null;
    			}

    			if( !empty($developer['dob']) ){
    				$developer['dob'] = date('Y-m-d',strtotime($developer['dob']));
    			}

          $developer_data = array(
              'company_name'  => $company_name, 
              'fname'         => $developer['first'], 
              'mname'         => $developer['middle'], 
              'lname'         => $developer['last'], 
              'suffix'        => $developer['suffix'], 
              'trn_no'        => $developer['trn_no'], 
              'dob'           => $developer['dob'], 
              'occupation'    => $developer['occupation'], 
              'phone'         => $developer['phone'], 
              'mobile'        => $developer['mobile'],
              'email'         => $developer['email'],
              'address_id'    => $address_id
          );

          if( !empty($devId) && $i == 0 )
          { 
            $table_name = 'tbl_developer_detail';
            
            try {
              //Update Developer
              DB::table($table_name)
                ->where('id', $devId)
                ->update($developer_data);
 
            } catch (Exception $e) {
              DB::rollback();
              $error = $e;
              return;
            }

            $i++;
            $dev_id[] = $devId;
          }
          else
          {
            /*CHECK DEVELOPER INFO IF EXIST ALREADY*/
            $dev_info = DB::table('tbl_developer_detail')
                           ->select('id')
                           ->where('company_name', $company_name)
                           ->where('fname', $developer['first'])
                           ->where('mname', $developer['middle'])
                           ->where('lname', $developer['last'])
                           ->where('suffix', $developer['suffix'])
                           ->where('trn_no', $developer['trn_no'])
                           ->where('dob', $developer['dob'])
                           ->where('occupation', $developer['occupation'])
                           ->where('phone', $developer['phone'])
                           ->where('mobile', $developer['mobile'])
                           ->where('email', $developer['email'])
                           ->where('address_id', $address_id)
                           ->orderBy('id', 'desc')
                           ->first();


            if( empty($dev_info) ){

              try {
                  /*INSERT DEV INFO */
                  DB::table('tbl_developer_detail')->insert($developer_data);
              } catch (Exception $e) {
                DB::rollback();
                $error = $e;
                return;
              }


              /*GET DEV ID */
              $dev_id[] = DB::getPdo()->lastInsertId();
            } 
            else
            {
              $dev_id[] = $dev_info->id;

            }  
          }
	        
        }

        return $dev_id;
    }

    public function add_payment($payment, &$error=false)
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

      	//MAPPER
      	$mapper = array(
		    'price_i','jprice_i','deposit','second_pay','final_pay',
		    'half_title','half_agreement','half_stamp_duty','half_reg_fee','inc_cost','maintenance_expense',
		    'identification_fee'
		    );

    		foreach ($mapper as $key) {

    			if( !array_key_exists($key, $payment) )
    			  $payment[$key] = null;
    		}

  	    $price_w  = null;
        $jprice_w = null;

        if(!empty($payment['price_i']))
          $price_w = convertNumberToWord($payment['price_i']);

        if(!empty($payment['jprice_i']))
          $jprice_w = convertNumberToWord($payment['jprice_i']);


        /*CHECK PAYMENT INFO IF EXIST ALREADY*/
        $payment_info = DB::table('tbl_monetary_detail')
                       ->select('id')
                       ->where('fc_id', '=', $fc_id)
                       ->where('price_i', '=', $payment['price_i'])
                       ->where('price_w', '=', $price_w)
                       ->where('j_price_i', '=', $payment['jprice_i'])
                       ->where('j_price_w', '=', $jprice_w)
                       ->where('deposit', '=', $payment['deposit'])
                       ->where('second_payment', '=', $payment['second_pay'])
                       ->where('final_payment', '=', $payment['final_pay'])
                       ->where('half_title', '=', $payment['half_title'])
                       ->where('half_agreement', '=', $payment['half_agreement'])
                       ->where('half_stamp_duty', '=', $payment['half_stamp_duty'])
                       ->where('half_reg_fee', '=', $payment['half_reg_fee'])
                       ->where('inc_cost', '=', $payment['inc_cost'])
                       ->where('maintenance_expense', '=', $payment['maintenance_expense'])
                       ->where('identification_fee', '=', $payment['identification_fee'])
                       ->orderBy('id', 'desc')
                       ->first();
        
        if( empty($payment_info) ){

          try {
            /*INSERT CONTRACT PAYMENT DETAIL */
            DB::table('tbl_monetary_detail')->insert(
                [
                    'fc_id'            => $fc_id, 
                    'price_i'          => $payment['price_i'],
                    'price_w'          => $price_w,
                    'j_price_i'        => $payment['jprice_i'],
                    'j_price_w'        => $jprice_w,
                    'deposit'          => $payment['deposit'],
                    'second_payment'   => $payment['second_pay'],
                    'final_payment'    => $payment['final_pay'],
                    'half_title'       => $payment['half_title'],
                    'half_agreement'   => $payment['half_agreement'],
                    'half_stamp_duty'  => $payment['half_stamp_duty'],
                    'half_reg_fee'     => $payment['half_reg_fee'],
                    'inc_cost'         => $payment['inc_cost'],
                    'maintenance_expense'   => $payment['maintenance_expense'],
                    'identification_fee'    => $payment['identification_fee'],
                ]
            );  
          } catch (Exception $e) {
            DB::rollback();
            $error = $e;
            return;
          }

          
          /*GET CONTRACT PAYMENT ID */
          $payment_id = DB::getPdo()->lastInsertId();
          //pre($payment_id); die;
        } 
        else
        {
          $payment_id = $payment_info->id;

        }
        
        return $payment_id;
    }

    public function add_purchaser($purchaser,$id ,&$error=false)
    {
    	$address_id   = null;

        //UNSET KEYS WHICH ARE EMPTY
        //scanArray($purchaser);
        $purchaser = arrangeMultiArray($purchaser);
        
        $i=0;
        foreach ($purchaser as $key => $purchaser) {

        	//GET ADDRESS ID
	        if(!empty($purchaser['address'])){

	          $address_obj = $purchaser['address'];
	          nullToString($address_obj);

	          $address_id = get_address($address_obj, $error);

	        }
	          
	        //******************
	        //ADD purchaser INFO
	        //******************

	        $mapper = array(
			    'first','last','middle','suffix','trn_no','dob','occupation','bussiness_place',
			    'phone','mobile','email'
			);
 
			foreach ($mapper as $key) {

				if( !array_key_exists($key, $purchaser) )
				  $purchaser[$key] = null;
			}

			if( !empty($purchaser['dob']) )
				$purchaser['dob'] = date('Y-m-d',strtotime($purchaser['dob']));

	        /*CHECK purchaser INFO IF EXIST ALREADY*/
	        $data = [
              'fname'     => $purchaser['first'], 
              'mname'     => $purchaser['middle'], 
              'lname'     => $purchaser['last'], 
              'suffix'      => $purchaser['suffix'], 
              'trn_no'      => $purchaser['trn_no'], 
              'dob'       => $purchaser['dob'], 
              'occupation'    => $purchaser['occupation'], 
              'bussiness_place'=> $purchaser['bussiness_place'], 
              'phone'     => $purchaser['phone'], 
              'mobile'        => $purchaser['mobile'],
              'email'         => $purchaser['email'],
              'address_id'    => $address_id
          ];

          if( !empty($id) && $i == 0 )
          { 
            $table_name = 'tbl_purchaser_detail';
            
            try {
              //Update Developer
              DB::table($table_name)
                ->where('id', $id)
                ->update($data);
 
            } catch (Exception $e) {
              DB::rollback();
              $error = $e;
              return;
            }

            $i++;
            $dev_id[] = $id;
          }
          else
          {
            /*CHECK purchaser INFO IF EXIST ALREADY*/
            $dev_info = DB::table('tbl_purchaser_detail')
                           ->select('id')
                           ->where('fname', $purchaser['first'])
                           ->where('mname', $purchaser['middle'])
                           ->where('lname', $purchaser['last'])
                           ->where('suffix', $purchaser['suffix'])
                           ->where('trn_no', $purchaser['trn_no'])
                           ->where('dob', $purchaser['dob'])
                           ->where('occupation', $purchaser['occupation'])
                           ->where('phone', $purchaser['phone'])
                           ->where('mobile', $purchaser['mobile'])
                           ->where('email', $purchaser['email'])
                           ->where('address_id', $address_id)
                           ->orderBy('id', 'desc')
                           ->first();
                           

            if( empty($dev_info) ){

              try {
                /*INSERT DEV INFO */
                DB::table('tbl_purchaser_detail')->insert(
                    [
                        'fname'     => $purchaser['first'], 
                        'mname'     => $purchaser['middle'], 
                        'lname'     => $purchaser['last'], 
                        'suffix'      => $purchaser['suffix'], 
                        'trn_no'      => $purchaser['trn_no'], 
                        'dob'       => $purchaser['dob'], 
                        'occupation'    => $purchaser['occupation'], 
                        'bussiness_place'=> $purchaser['bussiness_place'], 
                        'phone'     => $purchaser['phone'], 
                        'mobile'        => $purchaser['mobile'],
                        'email'         => $purchaser['email'],
                        'address_id'    => $address_id
                    ]
                );    
              } catch (Exception $e) {
                DB::rollback();
                $error = $e;
                return;
              }
              
              /*GET DEV ID */
              $dev_id[] = DB::getPdo()->lastInsertId();
            } 
            else
            {
              $dev_id[] = $dev_info->id;

            }

          }
        }

        return $dev_id;
    }


    public function add_attorney($attorney, &$error=false)
    {
    	$address_id  = null;
        $officer_id  = null;

        //UNSET KEYS WHICH ARE EMPTY
        scanArray($attorney);

        //GET ADDRESS ID
        if(!empty($attorney['address'])){

          $address_obj = $attorney['address'];
          nullToString($address_obj);

          $address_id = get_address($address_obj, $error);

        }
          
        //GET attorney OFFICER         
        if(!empty($attorney['pa'])){

            $pa = $attorney['pa'];
            nullToString($pa);

            $officer_id = get_officer($pa, $error,'attorney_officer');
        }


        //******************
        //ADD attorney INFO
        //******************

        /*CHECK attorney INFO IF EXIST ALREADY*/
        $cont_info = DB::table('tbl_attorney_detail')
                       ->select('id')
                       ->where('company_name', '=', $attorney['firm_name'])
                       ->where('officer_id', '=', $officer_id)
                       ->where('address_id', '=', $address_id)
                       ->orderBy('id', 'desc')
                       ->first();


        if( empty($cont_info) ){


          try {
            /*INSERT DEV INFO */
            DB::table('tbl_attorney_detail')->insert(
                [
                    'company_name'  => $attorney['firm_name'], 
                    'officer_id'  => $officer_id,
                    'address_id'=> $address_id,
                ]
            );    
          } catch (Exception $e) {
            DB::rollback();
            $error = $e;
            return;
          }
          
          /*GET DEV ID */
          $cont_id = DB::getPdo()->lastInsertId();
        } 
        else
        {
          $cont_id = $cont_info->id;

        }

        return $cont_id;
    }


    public function add_property($property, $ids, &$error=false)
    { 
        $address_id     = null;
        $vendor_id   	  = $ids['vendor'];
        $buyer_id  		  = $ids['buyer'];
        $payment_id     = $ids['payment'];
        $attorney_id    = $ids['attorney'];

        //GET ADDRESS ID
        if(!empty($property['address'])){

          $address_obj = $property['address'];
          nullToString($address_obj);

          $address_id = get_address($address_obj, $error);

        }

        //Folio Key
        $folio_key = '';
        if(!empty($property['folio_no'])){
          $folio_key = explode(',', $property['folio_no']);
          $folio_key = $folio_key[0];
        }

        $folio_key = $property['volume_no'].'_'.$property['folio_no'];
    
        //******************
        //ADD property INFO
        //******************

        //Get Key ID
        $key = DB::table('tbl_key_id')
             ->select('id')
             ->where('volume_no', '=', $property['volume_no'])
             ->where('folio_no', '=', $property['folio_no'])
             ->where('lot_no', '=', $property['lot_no'])
             ->orderBy('id', 'desc')
             ->first();

        if(empty($key))
        {
          DB::table('tbl_key_id')->insert(
              [
                  'volume_no' => $property['volume_no'], 
                  'folio_no'  => $property['folio_no'],
                  'lot_no'    => $property['lot_no'],
              ]
          );
          /*GET DEV ID */
          $key_id = DB::getPdo()->lastInsertId();
        }
        else
        {
          $key_id = $key->id;

        }

        try {
          //Insert Property
          $table_name    = 'tbl_property_detail';
          $property_data = [
              'id'                => $key_id, 
              'lot_no'            => $property['lot_no'], 
              'volume_no'         => $property['volume_no'], 
              'folio_no'          => $property['folio_no'], 
              'plan_no'           => $property['plan_no'], 
              'address_id'        => $address_id, 
              'payment_id'        => $payment_id, 
              'attorney_id'       => $attorney_id
              
          ];

          //Insert Update Property Data
          Property::insertOnDuplicateKey($property_data,$table_name);          
        } catch (Exception $e) {
          DB::rollback();
          $error = $e;
          return;
        }

        //INSERT VENDOR ASSOCIATION
        foreach ($vendor_id as $key => $value) {
            $vendorUpdate = array();
            $table_name   = 'tbl_property_vendor_assoc';
            $vendorUpdate['property_id']  = $key_id;
            $vendorUpdate['developer_id'] = $value;

            try {
              //Insert Ignore Vendor
              Property::insertIgnore($vendorUpdate,$table_name);
              
            } catch (Exception $e) {
              DB::rollback();
              $error = $e;
              return;
            }
        }

        //INSERT BUYER ASSOCIATION
        foreach ($buyer_id as $key => $value) {
            $buyerUpdate = array();
            $table_name   = 'tbl_property_buyer_assoc';
            $buyerUpdate['property_id']  = $key_id;
            $buyerUpdate['purchaser_id'] = $value;

            try {
              //Insert Ignore Vendor
              Property::insertIgnore($buyerUpdate,$table_name);
              
            } catch (Exception $e) {
              DB::rollback();
              $error = $e;
              return;
            }
        }

        //return $property_id;
    }

    public function get_development($id='')
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
                        ->leftJoin('tbl_address as dta', 'dt.address_id', '=', 'dta.id')
                        ->leftJoin('tbl_developer_detail as d', 'dt.developer_id', '=', 'd.id')
                        ->leftJoin('tbl_address as da', 'd.address_id', '=', 'da.id')
                        ->leftJoin('tbl_person_info as so', 'dt.surveyor_id', '=', 'so.id')
                        ->leftJoin('tbl_person_info as do1', 'd.officer_id_1', '=', 'do1.id')
                        ->leftJoin('tbl_person_info as do2', 'd.officer_id_2', '=', 'do2.id')
                        ->leftJoin('tbl_contractor_detail as c', 'dt.contractor_id', '=', 'c.id')
                        ->leftJoin('tbl_address as ca', 'c.address_id', '=', 'ca.id')
                        ->leftJoin('tbl_person_info as co', 'c.officer_id', '=', 'co.id')
                        ->leftJoin('tbl_dev_contract_payment as cp', 'dt.payment_id', '=', 'cp.id')
                        ->leftJoin('tbl_foriegn_currency as fc', 'cp.fc_id', '=', 'fc.id')
                        ->where('dt.id', '=', $id)
                        ->get(); 
        /*dd(DB::getQueryLog());*/

        $mapper = array(
          'dt'  => 'property',
          'd'   => 'vendor',
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

    public function get_property($values='')
    {
      /*DB::enableQueryLog();*/
      /*dd(DB::getQueryLog());*/

      $folio  = $values['folio'];
      $lot    = $values['lot'];

      if(empty($folio) || empty($lot))
        return 0;
      else
      {
        $folio  = explode(',', $folio);
        $folio  = $folio[0];  //1st part is key

        //id
        $arr = explode('_', $folio);
        $volume_no  = $arr[0];
        $folio_no   = $arr[1];
        $lot_no     = $lot;

        //pre($folio);
        /*CHECK DEVELOPER INFO IF EXIST ALREADY*/
        $property_info = DB::table('tbl_property_detail as p')
                        ->select('p.id as p-id','p.plan_no as p-plan_no', 
                          //Property Address
                          'pa.line1 as p-address-line1','pa.line2 as p-address-line2','pa.city as p-address-city','pa.state as p-address-state', 'pa.postal as p-address-postal',
                          'pa.country as p-address-country',    
                          //Development Surveyor
                          //'so.title as dt-surveyor-title','so.first_name as dt-surveyor-first','so.last_name as dt-surveyor-last',
                          //Development Contractor
                          'c.company_name as c-company_name',
                          //Contractor Address
                          'ca.line1 as c-address-line1','ca.line2 as c-address-line2','ca.city as c-address-city','ca.state as c-address-state', 'ca.country as c-address-country', 
                          //Contractor Officer
                          'co.title as c-co-title','co.first_name as c-co-first','co.last_name as c-co-last','co.suffix as c-co-suffix',
                          'co.capacity as c-co-capacity','co.landline as c-co-landline',
                          
                          //Vendor                       
                          'v.company_name as v-company_name',/*'v.fname as v-first','v.mname as v-middle','v.lname as v-last','v.suffix as v-suffix','v.trn_no as v-trn_no','v.dob as v-dob','v.occupation as v-occupation','v.phone as v-phone','v.mobile as v-mobile','v.email as v-email',
                          //Vendor Address
                          'va.line1 as v-address-line1','va.line2 as v-address-line2','va.city as v-address-city','va.state as v-address-state', 'va.postal as v-address-postal','va.country as v-address-country',*/

                          // //Buyer                       
                          // //'b.company_name as b-company_name',
                          /*'b.fname as b-first','b.mname as b-middle','b.lname as b-last','b.suffix as b-suffix','b.trn_no as b-trn_no','b.dob as b-dob','b.occupation as b-occupation','b.bussiness_place as b-bussiness_place','b.phone as b-phone','b.mobile as b-mobile','b.email as b-email',
                          //Buyer Address
                          'ba.line1 as b-address-line1','ba.line2 as b-address-line2','ba.city as b-address-city','ba.state as b-address-state', 'ba.postal as b-address-postal','ba.country as b-address-country',*/

                          //Attorney 
                          'a.company_name as a-firm_name',
                          //Attorney Officer
                          'ao.title as a-pa-title','ao.first_name as a-pa-first','ao.last_name as a-pa-last',
                          //Attorney Address
                          'aa.line1 as a-address-line1','aa.line2 as a-address-line2','aa.city as a-address-city','aa.state as a-address-state', 'aa.postal as a-address-postal','aa.country as a-address-country',

                          //Payment
                          'm.price_i as m-price_i','m.price_w as m-price_w','m.j_price_i as m-jprice_i', 
                          'm.j_price_w as m-jprice_w','m.deposit as m-deposit', 
                          'm.second_payment as m-second_pay','m.final_payment as m-final_pay',
                          'm.half_title as m-half_title','m.half_agreement as m-half_agreement',
                          'm.half_stamp_duty as m-half_stamp_duty', 'm.half_reg_fee as m-half_reg_fee',
                          'm.inc_cost as m-inc_cost','m.maintenance_expense as m-maintenance_expense',
                          'm.identification_fee as m-identification_fee',
                          //Payment Foriegn Currency
                          'fc.name as m-fc-name','fc.symbol as m-fc-symbol','fc.exchange_rate as m-fc-rate'
                        )
                        ->leftJoin('tbl_address as pa', 'p.address_id', '=', 'pa.id')
                        ->leftJoin('tbl_property_vendor_assoc as pva', 'pva.property_id', '=', 'p.id')
                        ->leftJoin('tbl_developer_detail as v', 'pva.developer_id', '=', 'v.id')
                        ->leftJoin('tbl_address as va', 'v.address_id', '=', 'va.id')
                        ->leftJoin('tbl_property_buyer_assoc as pba', 'pba.property_id', '=', 'p.id')
                        ->leftJoin('tbl_purchaser_detail as b', 'pba.purchaser_id', '=', 'b.id')
                        ->leftJoin('tbl_address as ba', 'b.address_id', '=', 'ba.id')
                        ->leftJoin('tbl_attorney_detail as a', 'p.attorney_id', '=', 'a.id')
                        ->leftJoin('tbl_person_info as ao', 'a.officer_id', '=', 'ao.id')
                        ->leftJoin('tbl_address as aa', 'a.address_id', '=', 'aa.id')
                        ->leftJoin('tbl_monetary_detail as m', 'p.payment_id', '=', 'm.id')
                        ->leftJoin('tbl_foriegn_currency as fc', 'm.fc_id', '=', 'fc.id')

                        ->leftJoin('tbl_developement_detail as dt', function($join){
                          $join->on('p.volume_no', '=', 'dt.volume_no');
                          $join->on('p.folio_no','=','dt.folio_no');
                        })

                        ->leftJoin('tbl_contractor_detail as c', 'dt.contractor_id', '=', 'c.id')
                        ->leftJoin('tbl_address as ca', 'c.address_id', '=', 'ca.id')
                        ->leftJoin('tbl_person_info as co', 'c.officer_id', '=', 'co.id')

                        ->where('p.volume_no', '=', $volume_no)
                        ->where('p.folio_no', '=', $folio_no)
                        ->where('p.lot_no', '=', $lot_no)
                        ->get(); 
        /*dd(DB::getQueryLog());*/

        try{
          $property_info = (array) $property_info[0];
        }
        catch(\Exception $e)
        {
          //pre($e->getMessage());
          $property_info = '';  
          return $property_info;
        }

        $property_info = $this->custom_mapper($property_info);        

        return $property_info;
      }
    }

    public function get_all($values='')
    {
      /*DB::enableQueryLog();*/
      /*dd(DB::getQueryLog());*/

      $volume  = $values['volume'];
      $folio  = $values['folio'];
      $lot    = $values['lot'];

      if(empty($volume) || empty($folio) || empty($lot))
        return 0;
      else
      {
        /*$folio  = explode(',', $folio);
        $folio  = $folio[0]; */ //1st part is key

        //id
        //$id = $folio.'_'.$lot;

        //pre($folio);
        /*CHECK DEVELOPER INFO IF EXIST ALREADY*/
        $property_info = DB::table('tbl_property_detail as p')
                        ->select('p.id as p-id','p.plan_no as p-plan_no','p.lot_no as p-lot_no','p.volume_no as p-volume_no',
                         'p.folio_no as p-folio_no', 
                          //Property Address
                          'pa.line1 as p-address-line1','pa.line2 as p-address-line2','pa.city as p-address-city',
                          'pa.state as p-address-state', 'pa.postal as p-address-postal',
                          'pa.country as p-address-country',    
                          //Development Detail
                          'dt.name as p-dev_name','dt.total_lots_s as p-total_lots','dt.total_lots_i as p-total_lots_i',
                          'dt.residential_lots_s as p-residential_lots','dt.residential_lots_i as p-residential_lots_i',
                          'dt.common_lots_s as p-common_lots','dt.common_lots_i as p-common_lots_i',
                          'dt.lot_ids as p-lot_ids', 'dt.rsrv_road_no as p-rsrv_road_no',
                          //Development Contractor
                          'c.company_name as c-company_name',
                          //Contractor Address
                          'ca.line1 as c-address-line1','ca.line2 as c-address-line2','ca.city as c-address-city','ca.state as c-address-state', 'ca.country as c-address-country', 
                          //Contractor Officer
                          'co.title as c-co-title','co.first_name as c-co-first','co.last_name as c-co-last','co.suffix as c-co-suffix',
                          'co.capacity as c-co-capacity','co.landline as c-co-landline',
                          
                          //Vendor                       
                          'v.company_name as v-company_name','v.fname as v-first','v.mname as v-middle',
                          'v.lname as v-last','v.suffix as v-suffix','v.trn_no as v-trn_no',
                          'v.dob as v-dob','v.occupation as v-occupation','v.phone as v-phone',
                          'v.mobile as v-mobile','v.email as v-email','v.logo as v-logo',

                          //Vendor Address
                          'va.line1 as v-address-line1','va.line2 as v-address-line2','va.city as v-address-city','va.state as v-address-state', 'va.postal as v-address-postal','va.country as v-address-country',

                          //Developer Authorised 1
                          'da1.title as da1-title', 'da1.first_name as da1-first_name', 'da1.last_name as da1-last_name', 
                          'da1.suffix as da1-suffix', 'da1.capacity as da1-capacity', 'da1.landline as da1-landline',
                          //Developer Authorised 2
                          'da2.title as da2-title', 'da2.first_name as da2-first_name', 'da2.last_name as da2-last_name', 
                          'da2.suffix as da2-suffix', 'da2.capacity as da2-capacity', 'da2.landline as da2-landline',

                          //Buyer                       
                          //'b.company_name as b-company_name',
                          'b.fname as b-first','b.mname as b-middle','b.lname as b-last','b.suffix as b-suffix','b.trn_no as b-trn_no','b.dob as b-dob','b.occupation as b-occupation','b.bussiness_place as b-bussiness_place','b.phone as b-phone','b.mobile as b-mobile','b.email as b-email',
                          //Buyer Address
                          'ba.line1 as b-address-line1','ba.line2 as b-address-line2','ba.city as b-address-city','ba.state as b-address-state', 'ba.postal as b-address-postal','ba.country as b-address-country',

                          //Attorney 
                          'a.company_name as a-firm_name',
                          //Attorney Officer
                          'ao.title as a-pa-title','ao.first_name as a-pa-first','ao.last_name as a-pa-last',
                          //Attorney Address
                          'aa.line1 as a-address-line1','aa.line2 as a-address-line2','aa.city as a-address-city','aa.state as a-address-state', 'aa.postal as a-address-postal','aa.country as a-address-country',

                          //Monetary
                          'm.price_i as m-price_i','m.price_w as m-price_w','m.j_price_i as m-jprice_i', 
                          'm.j_price_w as m-jprice_w','m.deposit as m-deposit', 
                          'm.second_payment as m-second_pay','m.final_payment as m-final_pay',
                          'm.half_title as m-half_title','m.half_agreement as m-half_agreement',
                          'm.half_stamp_duty as m-half_stamp_duty', 'm.half_reg_fee as m-half_reg_fee',
                          'm.inc_cost as m-inc_cost','m.maintenance_expense as m-maintenance_expense',
                          'm.identification_fee as m-identification_fee',
                          //Payment Foriegn Currency
                          'fc.name as m-fc-name','fc.symbol as m-fc-symbol','fc.exchange_rate as m-fc-rate',

                          //Dev Contract Payment
                          'dcp.price_i as dcp-price_i','dcp.price_w as dcp-price_w','dcp.j_price_i as dcp-jprice_i', 
                          'dcp.j_price_w as dcp-jprice_w','dcp.deposit as dcp-deposit','dcp.deposit_w as dcp-deposit_w' , 
                          'dcp.second_payment as dcp-second_payment', 'dcp.third_payment as dcp-third_payment',
                          'dcp.fourth_payment as dcp-fourth_payment', 'dcp.final_payment as dcp-final_payment',
                          //Payment Foriegn Currency
                          'dfc.name as dcp-fc-name','dfc.symbol as dcp-fc-symbol','dfc.exchange_rate as dcp-fc-rate'
                        )
                        ->leftJoin('tbl_address as pa', 'p.address_id', '=', 'pa.id')
                        ->leftJoin('tbl_property_vendor_assoc as pva', 'pva.property_id', '=', 'p.id')
                        ->leftJoin('tbl_developer_detail as v', 'pva.developer_id', '=', 'v.id')
                        ->leftJoin('tbl_person_info as da1', 'v.officer_id_1', '=', 'da1.id')
                        ->leftJoin('tbl_person_info as da2', 'v.officer_id_2', '=', 'da2.id')
                        ->leftJoin('tbl_address as va', 'v.address_id', '=', 'va.id')
                        ->leftJoin('tbl_property_buyer_assoc as pba', 'pba.property_id', '=', 'p.id')
                        ->leftJoin('tbl_purchaser_detail as b', 'pba.purchaser_id', '=', 'b.id')
                        ->leftJoin('tbl_address as ba', 'b.address_id', '=', 'ba.id')
                        ->leftJoin('tbl_attorney_detail as a', 'p.attorney_id', '=', 'a.id')
                        ->leftJoin('tbl_person_info as ao', 'a.officer_id', '=', 'ao.id')
                        ->leftJoin('tbl_address as aa', 'a.address_id', '=', 'aa.id')

                        ->leftJoin('tbl_monetary_detail as m', 'p.payment_id', '=', 'm.id')
                        ->leftJoin('tbl_foriegn_currency as fc', 'm.fc_id', '=', 'fc.id')

                        ->leftJoin('tbl_developement_detail as dt', function($join){
                          $join->on('p.volume_no', '=', 'dt.volume_no');
                          $join->on('p.folio_no','=','dt.folio_no');
                        })

                        ->leftJoin('tbl_contractor_detail as c', 'dt.contractor_id', '=', 'c.id')
                        ->leftJoin('tbl_address as ca', 'c.address_id', '=', 'ca.id')
                        ->leftJoin('tbl_person_info as co', 'c.officer_id', '=', 'co.id')

                        ->leftJoin('tbl_dev_contract_payment as dcp', 'dt.payment_id', '=', 'dcp.id')
                        ->leftJoin('tbl_foriegn_currency as dfc', 'dcp.fc_id', '=', 'dfc.id')

                        ->where('p.volume_no', '=', $volume)
                        ->where('p.folio_no', '=', $folio)
                        ->where('p.lot_no', '=', $lot)
                        ->get(); 
        /*dd(DB::getQueryLog());*/               

        try{
          $property_info = (array) $property_info[0];
        }
        catch(\Exception $e)
        {
          //pre($e->getMessage());
          $property_info = '';  
          return $property_info;
        }             
        
        $property_info = $this->custom_mapper_t($property_info);      

        return $property_info;
      }
    }

    public function getAllVendors($id, &$count=0)
    {
      $vendorData = DB::table('tbl_property_vendor_assoc as pva')
          ->select(
            /*'v.company_name as v-company_name',*/'v.fname as v-first','v.mname as v-middle',
            'v.lname as v-last','v.suffix as v-suffix','v.trn_no as v-trn_no',
            'v.dob as v-dob','v.occupation as v-occupation','v.phone as v-phone',
            'v.mobile as v-mobile','v.email as v-email','v.logo as v-logo',

            //Vendor Address
            'va.line1 as v-address-line1','va.line2 as v-address-line2','va.city as v-address-city','va.state as v-address-state', 'va.postal as v-address-postal','va.country as v-address-country')
          ->leftJoin('tbl_developer_detail as v', 'v.id', '=', 'pva.developer_id')
          ->leftJoin('tbl_address as va', 'va.id', '=', 'v.address_id')
          ->where('property_id','=',$id)
          ->get();

      foreach ($vendorData as $key => $value) {
        $data[] = $this->custom_mapper($value);    
      }    
      //pre($data); die;
      $count = count($data);

      foreach ($data as $key => &$value) {
        foreach ($value as $k => $v) {
          //$new_data[$k]['index'] = $key;
          $new_data[$k][] = $v;
        }
      }

      return $new_data;
    }

    public function getAllBuyers($id, &$count=0)
    {
      $buyerData = DB::table('tbl_property_buyer_assoc as pba')
          ->select(
            'b.fname as b-first','b.mname as b-middle','b.lname as b-last','b.suffix as b-suffix','b.trn_no as b-trn_no','b.dob as b-dob','b.occupation as b-occupation','b.bussiness_place as b-bussiness_place','b.phone as b-phone','b.mobile as b-mobile','b.email as b-email',
            //Buyer Address
            'ba.line1 as b-address-line1','ba.line2 as b-address-line2','ba.city as b-address-city','ba.state as b-address-state', 'ba.postal as b-address-postal','ba.country as b-address-country')
          ->leftJoin('tbl_purchaser_detail as b', 'b.id', '=', 'pba.purchaser_id')
          ->leftJoin('tbl_address as ba', 'ba.id', '=', 'b.address_id')
          ->where('property_id','=',$id)
          ->get();

      foreach ($buyerData as $key => $value) {
        $data[] = $this->custom_mapper($value);    
      }    
      $count = count($data);

      foreach ($data as $key => &$value) {
        foreach ($value as $k => $v) {
          //$new_data[$k]['index'] = $key;
          $new_data[$k][] = $v;
        }
      }

      return $new_data;
    }

    public function custom_mapper($data){

      $input = '';
      $data = (array) $data;
      $mapper = array(
          'p'   => 'property',
          'v'   => 'vendor',
          'b'   => 'buyer',
          'm'   => 'monetary',
          'a'   => 'attorney',
          'cp'  => 'payment',
          'c'   => 'contractor',
        );     

        foreach ($data as $key => $value) 
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

            $data[$key]    = array(
              'key'   => $input,
              'value' => $value
            );          
            
        }     

      return $data; 

    }


    /*DATA FOR TEMPLATES
    ========================================*/
    public function getVendors($id, &$count=0)
    {
      $vendorData = DB::table('tbl_property_vendor_assoc as pva')
          ->select(
            /*'v.company_name as v-company_name',*/'v.fname as v-first','v.mname as v-middle',
            'v.lname as v-last','v.suffix as v-suffix','v.trn_no as v-trn_no',
            'v.dob as v-dob','v.occupation as v-occupation','v.phone as v-phone',
            'v.mobile as v-mobile','v.email as v-email','v.logo as v-logo',

            //Vendor Address
            'va.line1 as v-address-line1','va.line2 as v-address-line2','va.city as v-address-city','va.state as v-address-state', 'va.postal as v-address-postal','va.country as v-address-country')
          ->leftJoin('tbl_developer_detail as v', 'v.id', '=', 'pva.developer_id')
          ->leftJoin('tbl_address as va', 'va.id', '=', 'v.address_id')
          ->where('property_id','=',$id)
          ->get();

      foreach ($vendorData as $key => $value) {
        $data[] = $this->custom_mapper_t($value);    
      }    
      //pre($data); die;
      $count = count($data);

      foreach ($data as $key => &$value) {
        foreach ($value as $k => $v) {
          $v['index'] = $key; 
          $new_data[$k."-".$key] = $v; 
        }
      }

      return $new_data;
    }

    public function getBuyers($id, &$count=0)
    {
      $buyerData = DB::table('tbl_property_buyer_assoc as pba')
          ->select(
            'b.fname as b-first','b.mname as b-middle','b.lname as b-last','b.suffix as b-suffix','b.trn_no as b-trn_no','b.dob as b-dob','b.occupation as b-occupation','b.bussiness_place as b-bussiness_place','b.phone as b-phone','b.mobile as b-mobile','b.email as b-email',
            //Buyer Address
            'ba.line1 as b-address-line1','ba.line2 as b-address-line2','ba.city as b-address-city','ba.state as b-address-state', 'ba.postal as b-address-postal','ba.country as b-address-country')
          ->leftJoin('tbl_purchaser_detail as b', 'b.id', '=', 'pba.purchaser_id')
          ->leftJoin('tbl_address as ba', 'ba.id', '=', 'b.address_id')
          ->where('property_id','=',$id)
          ->get();

      foreach ($buyerData as $key => $value) {
        $data[] = $this->custom_mapper_t($value);    
      }    
      $count = count($data);

      foreach ($data as $key => &$value) {
        foreach ($value as $k => $v) {
          $v['index'] = $key; 
          $new_data[$k."-".$key] = $v; 
        }
      }

      return $new_data;
    }

    public function custom_mapper_t($data){

      $input = '';
      $data = (array) $data;
      $mapper = array(
          'p'   => 'property',
          'v'   => 'vendor',
          'b'   => 'buyer',
          'm'   => 'monetary',
          'a'   => 'attorney',
          'c'   => 'contractor',
          'dcp' => 'payment',
        ); 

        foreach ($data as $key => $value) 
        {
            $pieces = explode('-', $key);
            $i = $pieces[0];
            $pieces = array_reverse($pieces);
            
            if(count($pieces) == 3){
              $input = $pieces[1]."_".$pieces[0];
            }
            else if(count($pieces) == 2){
              $input = $pieces[0];
            }

            $data[$key]    = array(
              'prefix'=> $i, 
              'key'   => $input,
              'value' => $value
            );          
            
        }

      return $data; 

    }

}
