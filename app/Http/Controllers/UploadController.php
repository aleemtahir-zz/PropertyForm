<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.upload_property');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //pre($_FILES);
        //Upload Developer Logo
        /*$file = upload_logo('sheet');
        //pre($file);
        $file_path = "";
        if($file['status'] == 1)
        {
            $file_path = $file['path'];
            Session::flash('message', 'Upload Complete!'); 
            Session::flash('alert-class', 'alert-success'); 
            return view('forms.upload_property');
        }*/

        /*
         * jQuery File Upload Plugin PHP Example
         * https://github.com/blueimp/jQuery-File-Upload
         *
         * Copyright 2010, Sebastian Tschan
         * https://blueimp.net
         *
         * Licensed under the MIT license:
         * https://opensource.org/licenses/MIT
         */

        error_reporting(E_ALL | E_STRICT);
        $upload_handler = new \UploadHandler();
die;

        //Upload Sheet Content
        $excelReader = \PHPExcel_IOFactory::createReaderForFile($file_path);
        $excelObj = $excelReader->load($file_path);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();

        foreach ($worksheet->getRowIterator() AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            $cells = [];
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
        }
        pre($rows);

        //return view('forms.upload_property');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        error_reporting(E_ALL | E_STRICT);
        $upload_handler = new \UploadHandler();
    }

}
