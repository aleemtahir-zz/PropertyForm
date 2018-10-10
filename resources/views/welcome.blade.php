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
        <div class="c-forms-form-main c-span-24 c-sml-span-12">
            <div class="row">
                <div class="col-sm-4">
                    <!-- List -->
                    <div class="single category">
                        <h3 class="side-title">List of Pages</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{url('DeveloperDataFormA')}}" title="">Developer Data A <!-- <span class="pull-right">13</span> --></a></li>
                            <li><a href="{{url('DeveloperDataFormB')}}" title="">Developer Data B</a></li>
                            <li><a href="{{url('property')}}" title="">Property Data</a></li>
                            <li><a href="{{url('payment')}}" title="">Account Statement</a></li>
                            <li><a href="{{url('property/show')}}" title="">Downloads</a></li>
                            <li><a href="{{url('upload')}}" title="">Upload Data</a></li>
                        </ul>
                   </div>
            </div> 
            </div>
        </div>

    </div>

</div>  

@stop