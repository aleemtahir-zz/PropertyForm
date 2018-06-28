<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helper;

class Property extends Model
{
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

        pre($dev_id); 
        //die;
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
        
		pre($payment_id);
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

        pre($dev_id); 
        //die;
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
          
        //PREPARE PROPERTY DATA
        $count = (count($vendor_id) >= count($buyer_id)) ? count($vendor_id) : count($buyer_id);
        
        for ($i=0; $i < $count ; $i++) { 
        	$data[$i]['lot_no'] 		= $property['lot_no']; 
        	$data[$i]['folio_no'] 		= $property['folio_no']; 
        	$data[$i]['plan_no'] 		= $property['plan_no']; 
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
        	/*CHECK property DETAIL IF EXIST ALREADY*/
	        $property_info = DB::table('tbl_property_detail')
	                       ->select('id')
	                       ->where('lot_no',           $property['lot_no'])
	                       ->where('folio_no',         $property['folio_no'])
	                       ->where('plan_no',          $property['plan_no'])
	                       ->where('address_id',       $address_id)
	                       ->where('developer_id',     $property['vendor_id'])
	                       ->where('purchaser_id',     $property['buyer_id'])
	                       ->where('payment_id',       $property['payment_id'])
	                       ->where('attorney_id',      $property['attorney_id'])
	                       ->orderBy('id', 'desc')
	                       ->first();


	        if( empty($property_info) ){

	            /*INSERT property DETAIL */
	            DB::table('tbl_property_detail')->insert(
	                [
	                    'lot_no'            => $property['lot_no'], 
	                    'folio_no'          => $property['folio_no'], 
	                    'plan_no'           => $property['plan_no'], 
	                    'address_id'        => $address_id, 
	                    'developer_id'      => $property['vendor_id'], 
	                    'purchaser_id'      => $property['buyer_id'], 
	                    'payment_id'        => $property['payment_id'], 
	                    'attorney_id'		=> $property['attorney_id'] 
	                    
	                ]
	            );
	            /*GET property ID */
	            $property_id[] = DB::getPdo()->lastInsertId();
	        } 
	        else
	        {
	          $property_id[] = $property_info->id;

	        }	
        }

        pre($property_id);
        return $property_id;
    }


}
