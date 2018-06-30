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

    public function add_developer($developer)
    {
    	  $address_id   = null;

        $company_name = $developer['company_name'];
        unset($developer['company_name']);

        //UNSET KEYS WHICH ARE EMPTY
        //scanArray($developer);
        $developer = arrangeMultiArray($developer);

        foreach ($developer as $key => $developer) {

        	//GET ADDRESS ID
	        if(!empty($developer['address'])){

	          $address_obj = $developer['address'];
	          nullToString($address_obj);

	          $address_id = get_address($address_obj);

	        }
	          
	        //******************
	        //ADD DEVELOPER INFO
	        //******************

	        $mapper = array(
			    'name','last','middle','suffix','trn_no','dob','occupation',
			    'phone','mobile','email','logo'
			);

			foreach ($mapper as $key) {

				if( !array_key_exists($key, $developer) )
				  $developer[$key] = null;
			}

			if( !empty($developer['dob']) ){
				$developer['dob'] = date('Y-m-d',strtotime($developer['dob']));
			}

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
	                       ->where('logo', $developer['logo'])
	                       ->orderBy('id', 'desc')
	                       ->first();


	        if( empty($dev_info) ){

	          /*INSERT DEV INFO */
	          DB::table('tbl_developer_detail')->insert(
	                [
	                    'company_name'  => $company_name, 
	                    'fname'  		=> $developer['first'], 
	                    'mname'  		=> $developer['middle'], 
	                    'lname'  		=> $developer['last'], 
	                    'suffix'  		=> $developer['suffix'], 
	                    'trn_no'  		=> $developer['trn_no'], 
	                    'dob'  			=> $developer['dob'], 
	                    'occupation'  	=> $developer['occupation'], 
	                    'phone'  		=> $developer['phone'], 
	                    'mobile'        => $developer['mobile'],
	                    'email'         => $developer['email'],
	                    'address_id'    => $address_id,
	                    'logo'          => $developer['logo']
	                ]
	            );
	            /*GET DEV ID */
	            $dev_id[] = DB::getPdo()->lastInsertId();
	        } 
	        else
	        {
	          $dev_id[] = $dev_info->id;

	        }
        }

        return $dev_id;
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

      	//MAPPER
      	$mapper = array(
		    'price_i','jprice_i','deposit','second_pay','third_pay','fourth_pay','final_pay',
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
                    'fc_id'         	=> $fc_id, 
                    'price_i'       	=> $payment['price_i'],
                    'price_w'       	=> $price_w,
                    'j_price_i'     	=> $payment['jprice_i'],
                    'j_price_w'      	=> $jprice_w,
                    'deposit'       	=> $payment['deposit'],
                    'second_payment'	=> $payment['second_pay'],
                    'third_payment' 	=> $payment['third_pay'],
                    'fourth_payment'	=> $payment['fourth_pay'],
                    'final_payment' 	=> $payment['final_pay'],
                    'half_title' 		=> $payment['half_title'],
                    'half_agreement' 	=> $payment['half_agreement'],
                    'half_stamp_duty' 	=> $payment['half_stamp_duty'],
                    'half_reg_fee' 		=> $payment['half_reg_fee'],
                    'inc_cost' 			=> $payment['inc_cost'],
                    'maintenance_expense' 	=> $payment['maintenance_expense'],
                    'identification_fee' 	=> $payment['identification_fee'],
                ]
            );
            /*GET CONTRACT PAYMENT ID */
            $payment_id = DB::getPdo()->lastInsertId();
        } 
        else
        {
          $payment_id = $payment_info->id;

        }
        
        return $payment_id;
    }

    public function add_purchaser($purchaser)
    {
    	$address_id   = null;

        //UNSET KEYS WHICH ARE EMPTY
        //scanArray($purchaser);
        $purchaser = arrangeMultiArray($purchaser);
        
        foreach ($purchaser as $key => $purchaser) {

        	//GET ADDRESS ID
	        if(!empty($purchaser['address'])){

	          $address_obj = $purchaser['address'];
	          nullToString($address_obj);

	          $address_id = get_address($address_obj);

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

	          /*INSERT DEV INFO */
	          DB::table('tbl_purchaser_detail')->insert(
	                [
	                    'fname'  		=> $purchaser['first'], 
	                    'mname'  		=> $purchaser['middle'], 
	                    'lname'  		=> $purchaser['last'], 
	                    'suffix'  		=> $purchaser['suffix'], 
	                    'trn_no'  		=> $purchaser['trn_no'], 
	                    'dob'  			=> $purchaser['dob'], 
	                    'occupation'  	=> $purchaser['occupation'], 
	                    'bussiness_place'=> $purchaser['bussiness_place'], 
	                    'phone'  		=> $purchaser['phone'], 
	                    'mobile'        => $purchaser['mobile'],
	                    'email'         => $purchaser['email'],
	                    'address_id'    => $address_id
	                ]
	            );
	            /*GET DEV ID */
	            $dev_id[] = DB::getPdo()->lastInsertId();
	        } 
	        else
	        {
	          $dev_id[] = $dev_info->id;

	        }
        }

        return $dev_id;
    }


    public function add_attorney($attorney)
    {
    	$address_id  = null;
        $officer_id  = null;

        //UNSET KEYS WHICH ARE EMPTY
        scanArray($attorney);

        //GET ADDRESS ID
        if(!empty($attorney['address'])){

          $address_obj = $attorney['address'];
          nullToString($address_obj);

          $address_id = get_address($address_obj);

        }
          
        //GET attorney OFFICER         
        if(!empty($attorney['pa'])){

            $pa = $attorney['pa'];
            nullToString($pa);

            $officer_id = get_officer($pa,'attorney_officer');
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

          /*INSERT DEV INFO */
          DB::table('tbl_attorney_detail')->insert(
                [
                    'company_name'  => $attorney['firm_name'], 
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

        return $cont_id;
    }


    public function add_property($property, $ids)
    { 
        $address_id     = null;
        $vendor_id   	= $ids['vendor'];
        $buyer_id  		= $ids['buyer'];
        $payment_id     = $ids['payment'];
        $attorney_id    = $ids['attorney'];

        //GET ADDRESS ID
        if(!empty($property['address'])){

          $address_obj = $property['address'];
          nullToString($address_obj);

          $address_id = get_address($address_obj);

        }

        //Folio Key
        $folio_key = '';
        if(!empty($property['folio_no'])){
          $folio_key = explode(',', $property['folio_no']);
          $folio_key = $folio_key[0];
        }
          
        //PREPARE PROPERTY DATA
        $count = (count($vendor_id) >= count($buyer_id)) ? count($vendor_id) : count($buyer_id);
        
        for ($i=0; $i < $count ; $i++) { 
          $data[$i]['id']           = $folio_key; 
        	$data[$i]['lot_no'] 		  = $property['lot_no']; 
        	$data[$i]['folio_no'] 		= $property['folio_no']; 
        	$data[$i]['plan_no'] 		  = $property['plan_no']; 
        	$data[$i]['address_id'] 	= $address_id; 
        	$data[$i]['address_id'] 	= $address_id; 
        	$data[$i]['vendor_id'] 		= (isset($vendor_id[$i])) ? $vendor_id[$i] : null; 
        	$data[$i]['buyer_id'] 		= (isset($buyer_id[$i])) ? $buyer_id[$i] : null; 
        	$data[$i]['payment_id'] 	= $payment_id; 
        	$data[$i]['attorney_id'] 	= $attorney_id; 
        }
        
        //******************
        //ADD property INFO
        //******************
        
        foreach ($data as $key => $property) 
        {
        	$table_name    = 'tbl_property_detail';
          $property_data = [
              'id'                => $folio_key, 
              'folio_no'          => $property['folio_no'], 
              'lot_no'            => $property['lot_no'], 
              'plan_no'           => $property['plan_no'], 
              'address_id'        => $address_id, 
              'developer_id'      => $property['vendor_id'], 
              'purchaser_id'      => $property['buyer_id'], 
              'payment_id'        => $property['payment_id'], 
              'attorney_id'       => $property['attorney_id'] 
              
          ];

          //Insert Update Development Data
          Property::insertOnDuplicateKey($property_data,$table_name);

	        // if( empty($property_info) ){

	        //     /*INSERT property DETAIL */
	        //     DB::table('tbl_property_detail')->insert(
	                
	        //     );
	        //     GET property ID 
	        //     $property_id[] = DB::getPdo()->lastInsertId();
	        // } 
	        // else
	        // {
	        //   $property_id[] = $property_info->id;

	        // }	
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

      $folio  = $values['folio'];
      $lot    = $values['lot'];

      if(empty($folio) || empty($lot))
        return 0;
      else
      {
        $folio  = explode(',', $folio);
        $folio  = $folio[0];  //1st part is key

        /*CHECK DEVELOPER INFO IF EXIST ALREADY*/
        $dev_info = DB::table('tbl_property_detail as p')
                        ->select('p.id as p-folio_no','p.plan_no as p-plan_no', 
                          //Property Address
                          'pa.line1 as p-address-line1','pa.line2 as p-address-line2','pa.city as p-address-city','pa.state as p-address-state', 'pa.postal as p-address-postal',
                          'pa.country as p-address-country',    
                          //Development Surveyor
                          //'so.title as dt-surveyor-title','so.first_name as dt-surveyor-first','so.last_name as dt-surveyor-last',
                          //Development Contractor
                          //'c.company_name as c-company_name',
                          //Contractor Address
                          //'ca.line1 as c-address-line1','ca.line2 as c-address-line2','ca.city as c-address-city','ca.state as c-address-state', 'ca.country as c-address-country', 
                          //Contractor Officer
                          //'co.title as c-co-title','co.first_name as c-co-first','co.last_name as c-co-last','co.suffix as c-co-suffix',
                          //'co.capacity as c-co-capacity','co.landline as c-co-landline',
                          
                          //Vendor                       
                          'v.company_name as v-company_name','v.fnmae as v-first','v.mname as v-middle','v.lname as v-last','v.suffix as v-suffix','v.trn_no as v-trn_no','v.dob as v-dob','v.occupation as v-occupation','v.phone as v-phone','v.mobile as v-mobile','v.email as v-email'
                          //Vendor Address
                          'va.line1 as v-address-line1','va.line2 as v-address-line2','va.city as v-address-city','va.state as v-address-state', 'va.postal as v-address-postal','va.country as v-address-country',

                          //Buyer                       
                          'b.company_name as b-company_name','b.fnmae as b-first','b.mname as b-middle','b.lname as b-last','b.suffix as b-suffix','b.trn_no as b-trn_no','b.dob as b-dob','b.occupation as b-occupation','b.bussiness_place as b-bussiness_place','b.phone as b-phone','b.mobile as b-mobile','b.email as b-email'
                          //Buyer Address
                          'ba.line1 as b-address-line1','ba.line2 as b-address-line2','ba.city as b-address-city','ba.state as b-address-state', 'ba.postal as b-address-postal','ba.country as b-address-country',

                          //Attorney 
                          'a.company_name as a-firm_name',
                          //Developer Officer 1
                          'ao.title as a-pa-title','ao.first_name as a-pa-first','ao.last_name as a-pa-last',
                          //Attorney Address
                          'aa.line1 as a-address-line1','aa.line2 as a-address-line2','aa.city as a-address-city','aa.state as a-address-state', 'aa.postal as a-address-postal','aa.country as a-address-country',

                          //Developer Officer 1
                          //'do2.title as d-do2-title2','do2.first_name as d-do2-first2','do2.last_name as d-do2-last2','do2.suffix as d-do2-suffix2',
                          //'do2.capacity as d-do2-capacity2','do2.landline as d-do2-landline2',
                          //Contract Payment
                          //'cp.price_i as cp-price_i','cp.j_price_i as cp-jprice_i','cp.deposit as cp-deposit','cp.second_payment as cp-second_pay','cp.third_payment as cp-third_pay','cp.fourth_payment as cp-fourth_pay','cp.final_payment as cp-final_pay',
                          //Contract Payment Foriegn Currency
                          //'fc.name as cp-fc-name','fc.symbol as cp-fc-symbol','fc.exchange_rate as cp-fc-rate'
                        )
                        ->join('tbl_address as pa', 'p.address_id', '=', 'pa.id')
                        ->join('tbl_developer_detail as v', 'p.developer_id', '=', 'v.id')
                        ->join('tbl_address as va', 'v.address_id', '=', 'va.id')
                        ->join('tbl_tbl_purchaser_detail as b', 'p.purchaser_id', '=', 'b.id')
                        ->join('tbl_address as ba', 'b.address_id', '=', 'ba.id')
                        ->join('tbl_attorney_detail as a', 'p.attorney_id', '=', 'a.id')
                        ->join('tbl_person_info as ao', 'a.officer_id', '=', 'ao.id')
                        ->join('tbl_address as aa', 'a.address_id', '=', 'aa.id')

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

}
