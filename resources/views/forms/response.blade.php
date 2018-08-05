@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">

	{!! Form::open(array('id' => 'form', 'route' => 'merge', 'method' => 'post')); !!}
		<div class="c-forms-form" tabindex="0">
			<div class="c-forms-confirmation" style="display: block;">
				<div class="c-forms-heading">
					<div class="c-forms-form-title">
						<h2>HMF Property Form</h2>
					</div>
				</div>
				<div class="c-forms-confirmation-message c-html"><span>Thank you for filling out the form. Your response has been recorded.</span></div>
				<div class="c-forms-confirmation-message">
					@if(session()->has('message'))
					    <div class="alert alert-danger">
					        {{ session()->get('message') }}
					    </div>
					@endif
					
					{{-- <div style="margin: 10px 0 0 3px; position: absolute; left: 28;" class="c-label  ">
                      <label for="c-25-1627">Volume / Folio</label>
                    </div>
                    <div style="margin-top: 22px; width: 65px;" class="c-field c-col-1 c-sml-col-1 c-span-2 c-sml-span-2">
                      <div class="c-editor">
                        <input style="height: 25px;" name="property[volume_no]" type="text" id="c-25-1627"  value="{!! old('property.volume_no')!!}" placeholder="1234" maxlength="4" pattern="\d{4}"">
                      </div>

                    </div>
                    <span style="font-weight: bold; position: absolute; margin-top: 30px">/</span>

                    <div style="margin-top: 22px; padding-left: 4px; width: 65px;" class="c-field c-text-singleline c-col-17 c-sml-col-1 c-span-3 c-sml-span-2">
                      <div class="c-editor">
                        <input style="height: 25px;" name="property[folio_no]" value="{!!old('property.folio_no')!!}" type="text" id="c-2-768" placeholder="1234" maxlength="4" pattern="\d{4}">
                      </div>

                    </div>

                    <div style="margin-top: 13px; width: 120px;" class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-5 c-sml-span-6">
                    <button type="button" class="c-button" onclick="onClickFolio()">Fetch Record
                          <i id="gear-folio" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>
                    </button>
                    </div>

                    <div  style="width: 200px;" id="c-message-folio" class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-8 c-sml-span-6">

                    </div>

                    <div style="width: 120px;" class="c-text c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-12">
                        <div class="c-label  "><label for="c-0-770">Lot No</label></div>
                        <div class="c-editor"><input style="height: 25px;" name="property[lot_no]" value="{!!old('property.lot_no')!!}" type="text" id="c-0-770" placeholder=""></div>
                        <div class="c-validation"></div>
                    </div>
                    
                    <div style="margin-top: 13px; width: 120px;" class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-5 c-sml-span-6">
                    <button type="button" class="c-button" onclick="onClickLot()">Fetch Record
                          <i id="gear-lot" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>
                    </button>
                    </div>

                    <div  id="c-message-lot" class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-8 c-sml-span-6">

                    </div>  --}}

                    <div style=" width: 265px;" class="c-field c-text-singleline c-col-17 c-sml-col-1 c-span-8 c-sml-span-2">
                    	<div  style="padding-left: 8px;"><span>Record ID</span></div>
	                    <div class="c-editor">
	                    	<input name="autocomplete" type="text" id="autocomplete" placeholder="Volume/Folio/Lot">
	                    <div class="c-helptext">SEARCH RECORD ID.</div>
	                    </div>
	                </div>

                    <div style="  width: 265px;" class="c-field c-text-singleline c-col-17 c-sml-col-1 c-span-8 c-sml-span-2">
                    	<div  style="padding-left: 8px;"><span>File Name</span></div>
	                    <div class="c-editor">
	                    	<input name="filename" type="text" id="filename" placeholder="File Name">
	                    <div class="c-helptext">Write Filename in which you want to save it.</div>
	                    </div>
	                </div>

	                <br>
					<div class="c-choice-radiobuttons c-field c-col-13 c-sml-col-1 c-span-12 c-sml-span-12">
                        <legend class="c-label  ">Merge Data into Documents</legend>
                        {{-- <div class="c-helptext">Choose documents</div> --}}
                        <br>
                        @foreach ($templates as $name)
                        <div class="row">
							<div class="col-md-6">
								<div class="c-forms-document-links">
								<a class="c-forms-document-link" href="#">
								<span class="ms-word-file-icon-32x32"></span>
								<span>{!! Form::label('service' . $name, $name) !!} </span>
								</a>
							</div>
					        	
							</div>
							<div class="col-md-6">
								{!! Form::button('Merge', 
								['type' => 'submit','class' => 'c-button', 'name' => 'mergeBtn', 'value' => $name]); !!}

							</div>
					        <br>                        	
                        </div>
					    @endforeach

                        <div class="c-validation"></div>
                        
                    </div>
                    
					<div class="c-button-section" style="padding-left: 0 !important">
	                    {{-- <div class="c-action">
	                    	{!! Form::button('Merge All <i id="gear-sub" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>', array('class' => 'c-button','name' => 'mergeAll', 'type' => 'submit')); !!}
	                    </div> --}}
	                </div>
				</div>
			</div>
			
			<div class="c-footer-terms" >
				<!-- <ul class="terms">
					<li><a href="https://www.cognitoforms.com/reportabuse?form=https%3A%2F%2Fwww.cognitoforms.com%2FMarcusWilliams1%2FHMFPropertySalesDataForm" target="_blank">Report Abuse</a></li>
					<li><a href="https://www.cognitoforms.com/terms" target="_blank">Terms of Service</a></li>
				</ul> -->
			</div>
		</div>

	{!! Form::close(); !!}

</div>	

@stop