<?php


//***********************
//***HELPER FUNCTION*****
//***********************

function arrangeMultiArray($array){

  foreach ($array as $key => $value) {
    $i=0;
    foreach ($value as $sub_key => $sub_value) {

      if(is_array($sub_value)){

        $sub_array = arrangeMultiArray($array[$key]);

        for ($i=0; $i < count($sub_array); $i++) { 
          $array[$i][$key] = $sub_array[$i];
        }

        unset($array[$key]);
        break;
      }
      else{
        unset($array[$key]);
        $array[$i][$key] = $sub_value;
      }

      $i++;
    }
  }

  return $array;
}

function nullToString(&$array)
{
  foreach ($array as $key => &$value) {
    if($array[$key] == null){
      $value = "";
    }
  }
}

function scanArray($array)
{
    foreach ($array as $key => $value) {

        if( is_array($value) ){
          $values = array_values($value);

          foreach ($values as $k => $v) {
            if(empty($v))
              unset($values[$k]);
          }
          if(empty($values))
            unset($array[$key]);
        }
        /*else
        {
          if(empty($value))
            unset($array[$key]);
        }*/

    }

}

function convertNumberToWord($num = false)
{ 
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $words = trim(implode(' ', $words) , " ");
    //Remove Duplicate White Space
    $words = preg_replace('!\s+!', ' ', $words);
    //Upper Case
    $words = ucwords($words);

    return $words;
}

function get_address($address, &$error=false)
{

  $mapper = array(
    'line1',
    'line2',
    'city',
    'postal',
    'state',
    'country',
  );

  foreach ($mapper as $key) {

    if( !array_key_exists($key, $address) )
      $address[$key] = '';
  }

  /*CHECK ADDRESS IF EXIST ALREADY*/
  $result = DB::table('tbl_address')
                 ->select('id')
                 ->where('line1', '=', $address['line1'])
                 ->where('line2', '=', $address['line2'])
                 ->where('city', '=', $address['city'])
                 ->where('state', '=', $address['state'])
                 ->where('postal', '=', $address['postal'])
                 ->where('country', '=', $address['country'])
                 ->orderBy('id', 'desc')
                 ->first();


  if( empty($result) ){


    try {
      /*INSERT ADDRESS*/
      DB::table('tbl_address')->insert(
          [
              'line1'     => $address['line1'], 
              'line2'     => $address['line2'], 
              'city'      => $address['city'],
              'postal'    => $address['postal'],
              'state'     => $address['state'],
              'country'   => $address['country']
          ]
      );
    } catch (Exception $e) {
        DB::rollBack();
        $error = $e;
    }
    
    /*GET ADDRESS ID */
    $address_id = DB::getPdo()->lastInsertId();
  } 
  else
  {
    $address_id = $result->id;

  }

  return $address_id;
}

function get_officer($officer, &$error=false, $source='', $postfix='')
{

  $mapper = array(
    'title',
    'first_name',
    'last_name',
    'suffix',
    'capacity',
    'landline',
  );

  foreach ($mapper as $key) {

    if( !array_key_exists($key, $officer) )
      $officer[$key] = '';
  }

  try{
    /*CHECK DEVELOPER OFFICER IF EXIST ALREADY*/
    $result = DB::table('tbl_person_info')
                   ->select('id')
                   ->where('title', '=', $officer['title'.$postfix]) 
                   ->where('first_name', '=', $officer['first'.$postfix])
                   ->where('last_name', '=', $officer['last'.$postfix])
                   ->where('suffix', '=', $officer['suffix'.$postfix])
                   ->where('capacity', '=', $officer['capacity'.$postfix])
                   ->where('landline', '=', $officer['landline'.$postfix])
                   ->where('source', '=', $source)
                   ->orderBy('id', 'desc')
                   ->first();
    
  }
  catch(\Exception $e){
    $error = $e;
  }


  if( empty($result) ){
    try {
      /*INSERT DEV OFFICER */
      DB::table('tbl_person_info')->insert(
          [
              'title'     => $officer['title'.$postfix], 
              'first_name'=> $officer['first'.$postfix], 
              'last_name' => $officer['last'.$postfix],
              'suffix'    => $officer['suffix'.$postfix],
              'capacity'  => $officer['capacity'.$postfix],
              'landline'  => $officer['landline'.$postfix],
              'source'      => $source
          ]
      );
    } catch (Exception $e) {
        DB::rollBack();
        $error = $e;
        //return back()->withErrors($e->getMessage())->withInput();
    }
    
    /*GET DEV OFFICER ID */
    $officer_id = DB::getPdo()->lastInsertId();
  } 
  else
  {
    $officer_id = $result->id;
  }
  
  return $officer_id;

}

function saveDoc($templates='', $file, $data='')
{ 

  $date['day']    = date('l');
  $date['month']  = date('F');
  $date['year']   = date('Y');

  // Include classes 
  // Load the TinyButStrong template engine 
  require_once base_path('vendor/mbence/opentbs-bundle/MBence/OpenTBSBundle/lib/tbs_class.php'); 
  // Load the OpenTBS plugin 
  require_once base_path('vendor/mbence/opentbs-bundle/MBence/OpenTBSBundle/lib/tbs_plugin_opentbs.php'); 


  foreach ($templates as $template) {

    // Initialize the TBS instance 
    $TBS = new \clsTinyButStrong; // new instance of TBS 
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin
    // load your template
    $TBS->LoadTemplate('templates/'.$template.'.docx');
    
    if(isset($data['v'][0]['logo']) && !empty($data['v'][0]['logo'])){
      $prms = array('unique' => true);
      $TBS->Plugin(OPENTBS_CHANGE_PICTURE, 'dev_logo',$data['v'][0]['logo'] , $prms);        
    }

    //pre($data); die;
    if(!empty($data)){
      
        //pre($data); die;
        try{
            // replace variables
            $TBS->MergeField('date', $date);
            $TBS->MergeBlock('v', 'array',$data['v']);
            $TBS->MergeField('p', $data['p']);
            $TBS->MergeBlock('b,b1,b2,b3,b4,b5,b6,b7','array', $data['b']);
            $TBS->MergeField('dcp', $data['dcp']);
            $TBS->MergeField('c', $data['c']);
            $TBS->MergeField('da1', $data['da1']);
            $TBS->MergeField('da2', $data['da2']);
            $TBS->MergeField('a', $data['a']);
            $TBS->MergeField('m', $data['m']);
            $TBS->MergeField('ds', $data['ds']);
        }
        catch(\Exception $e)
        {
          pre($e->getMessage());
          //$property_info = '';  
          //return $property_info;
        }
    
        // Download the file
        $TBS->Show(OPENTBS_DOWNLOAD, $file.'.docx');    
    }
  }
  


}

function pre($data)
{
  echo "<pre>"; print_r($data); echo "</pre>";
}

function get_foriegn_currency($currency)
{
  $mapper = array(
    'name',
    'symbol',
    'rate',
  );

  foreach ($mapper as $key) {

    if( !array_key_exists($key, $currency) )
      $currency[$key] = '';
  }

  /*CHECK CURRENCY IF EXIST ALREADY*/
  $result = DB::table('tbl_foriegn_currency')
                 ->select('id')
                 ->where('name', $currency['name']) 
                 ->where('symbol', $currency['symbol'])
                 ->where('exchange_rate', $currency['rate'])
                 ->orderBy('id', 'desc')
                 ->first();


  if( empty($result) ){

    /*INSERT CURRENCY */
    DB::table('tbl_foriegn_currency')->insert(
          [
              'name'     => $currency['name'], 
              'symbol'=> $currency['symbol'], 
              'exchange_rate' => $currency['rate'],
          ]
      );
      /*GET CURRENCY ID */
      $currency_id = DB::getPdo()->lastInsertId();
  } 
  else
  {
    $currency_id = $result->id;
  }
  
  return $currency_id;

}

function upload_logo( $filename='')
{
  $target_dir = __DIR__.'/../uploads/';
  $target_file = $target_dir . basename($_FILES[$filename]["name"]);
  $uploadOk = 1;
  $msg = array();
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  /*if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES[$filename]["tmp_name"]);
      if($check !== false) {
          $msg = "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          $msg = "File is not an image.";
          $uploadOk = 0;
      }
  }*/

  // Check file size
  if ($_FILES[$filename]["size"] > 500000) {
      $msg[] = "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "xml") {
      $msg[] = "Sorry, only JPG, JPEG & PNG files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk != 0) 
  {
      /*pre($target_file);
      pre($_FILES[$filename]["tmp_name"]); die;*/
      if (move_uploaded_file($_FILES[$filename]["tmp_name"], $target_file)) {
          $msg = "The file ". basename( $_FILES[$filename]["name"]). " has been uploaded.";
      } 
  }

  $result['status']   = $uploadOk;
  $result['message']  = $msg;
  $result['path']     = $target_file;

  return $result;
}


/*CSV TO PHP ARRAYS
================================================*/
function csvToArray($filename = '')
{

  try{
    $file = fopen($filename, 'r');
  }
  catch(\Exception $e)
  {
    pre($e->getMessage());
  }

  $header = fgetcsv($file);
  //array_shift($header);

  $i=0;
  $data = array();
  $new_data = array();
  while ($row = fgetcsv($file))
  {
    //$key = array_shift($row);

    $data[$i++] = array_combine($header, $row);
  }

  foreach ($data as $index => $array) {
    foreach ($array as $key => $value) {
      
      $indices = explode('.', $key);
      $values  = explode(',', $value);

      if(count($values) > 1)
        $value = $values;             

      $ind_count = count($indices);

      if($ind_count == 1)
        $new_data[$index][$indices[0]] = $value;  
      if($ind_count == 2)
        $new_data[$index][$indices[0]][$indices[1]] = $value;  
      if($ind_count == 3)
        $new_data[$index][$indices[0]][$indices[1]][$indices[2]] = $value;

    }
  }

  fclose($file);

  return $new_data;
}