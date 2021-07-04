@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">

    <div class="c-forms-form" tabindex="0">
        <div class="c-forms-form-body" ">
            <div class="c-forms-heading">
                <div class="c-forms-form-title">
                    <h2 style="font-size: 2.5em">Welcome to HMF Forms</h2>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="c-forms-form-main c-span-24 c-sml-span-12">
            <div class="row category">
                <div class="col-sm-4 single ">
                    <a href="{{url('DeveloperDataFormA')}}" title="">
                        <img width="120" height="100" src="{{asset('img/hmf_development.png')}}">
                        <span>Developer Data A</span> <!-- <span class="pull-right">13</span> -->
                    </a>
                </div> 
                <div class="col-sm-4 single">
                    <a href="{{url('DeveloperDataFormB')}}" title="">
                        <img width="120" height="100" src="{{asset('img/hmf_development.png')}}">
                        <span>Developer Data B</span>
                    </a>
                </div>
                <div class="col-sm-4 single">
                    <a href="{{url('property')}}" title="">
                        <img width="120" height="100" src="{{asset('img/hmf_property_data.png')}}">
                        <span>Property Data</span>
                    </a>
                </div>
            </div>
            <br>
            <div class="row category">
                <div class="col-sm-4 single">
                    <a href="{{url('payment')}}" title="">
                        <img width="120" height="100" src="{{asset('img/hmf_account_statement.png')}}">
                        <span>Account Statement</span>
                    </a>
                </div> 
                <div class="col-sm-4 single">
                    <a href="{{url('property/show')}}" title="">
                        <img width="120" height="100" src="{{asset('img/hmf_merge.png')}}">
                        <span>Downloads</span> 
                    </a>
                </div>
                <div class="col-sm-4 single">
                    <a href="{{url('upload')}}" title="">
                        <img width="120" height="100" src="{{asset('img/hmf_upload.png')}}">
                        <span>Upload Data</span> 
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>  

@stop