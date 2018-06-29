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

function get_address($address)
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
      /*GET ADDRESS ID */
      $address_id = DB::getPdo()->lastInsertId();
  } 
  else
  {
    $address_id = $result->id;

  }

  return $address_id;
}

function get_officer($officer, $source='', $postfix='')
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


  if( empty($result) ){

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
      /*GET DEV OFFICER ID */
      $officer_id = DB::getPdo()->lastInsertId();
  } 
  else
  {
    $officer_id = $result->id;
  }
  
  return $officer_id;

}

function save_doc($filename='', $vendor='', $buyer='', $property='')
{	
	
	if(empty($filename))
		return false;
	if(empty($vendor))
		return false;


	// Include classes 
    // Load the TinyButStrong template engine 
    require_once base_path('vendor/mbence/opentbs-bundle/MBence/OpenTBSBundle/lib/tbs_class.php'); 
    // Load the OpenTBS plugin 
    require_once base_path('vendor/mbence/opentbs-bundle/MBence/OpenTBSBundle/lib/tbs_plugin_opentbs.php'); 

    // Initialize the TBS instance 
    $TBS = new \clsTinyButStrong; // new instance of TBS 
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

	
	// ----------------- 
	// Load the template 
	// ----------------- 
	$template = 'templates/'.$filename.'.docx'; 

	$TBS->LoadTemplate($template/*, OPENTBS_ALREADY_UTF8*/); // Also merge some [onload] automatic fields (depends of the type of document). 

	// ---------------------- 
	// Debug mode of the demo 
	// ---------------------- 
	if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit. 
	if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit. 
	if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit. 

	// -------------------------------------------- 
	// Merging and other operations on the template 
	// -------------------------------------------- 
	echo "<pre>";print_r($property);echo "</pre>";
	// Merge data in the body of the document 
	$TBS->MergeBlock('a', $vendor); 
	//$TBS->MergeBlock('b', $property); 
	//$TBS->MergeField('block1',$property);
	// Merge data in colmuns 
	
	// ----------------- 
	// Output the result 
	// ----------------- 
	$var = file_get_contents('counter.txt');
	$var++;
	file_put_contents('counter.txt', $var);

	if($var < 10)
		$var = "0".$var;

	// Define the name of the output file 
	$save_as	= 	'new1'.$var;

	if(!empty($data[0][v_last]))
		$vendor = $data[0][v_last];
	else
		$vendor = 'vendor';
	if(!empty($data[0][v_last]))
		$buyer = $data[0][v_last];
	else
		$buyer = 'buyer';

	$output_file_name = $vendor."_".$buyer."_".$var.".docx"; 
	if ($save_as==='') { 
	    // Output the result as a downloadable file (only streaming, no data saved in the server) 
	    $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields. 
	    // Be sure that no more output is done, otherwise the download file is corrupted with extra data. 
	    exit(); 
	} else { 
	    // Output the result as a file on the server. 
	    $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
	    //$TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields. 
	    // The script can continue.

	    /*include_once('vendor/phpoffice/phpword/bootstrap.php');
	    $phpWord = new \PhpOffice\PhpWord\PhpWord();

		//Open template and save it as docx
		$document = $phpWord->loadTemplate($template);
		$document->saveAs('temp.docx');

		//Load temp file
		$phpWord = \PhpOffice\PhpWord\IOFactory::load('temp.docx'); 

		//Save it
		$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
		$xmlWriter->save('result.pdf'); */  
	    exit("File [$output_file_name] has been created."); 
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
  $target_dir = realpath(dirname(getcwd())).'\uploads\\';
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