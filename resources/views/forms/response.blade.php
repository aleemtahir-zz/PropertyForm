@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">

	{!! Form::open(array('id' => 'form', 'route' => 'merge', 'method' => 'post')); !!}
		<div class="c-forms-form" tabindex="0">
			<div class="c-forms-confirmation" style="display: block;">
				<div class="c-forms-heading">
					<div class="c-forms-form-title">
						<a href="{{url('')}}"><span class="float-right"><i class="fa fa-home"></i>Home</span></a>
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
					<br>
					<div id="response-input" class="row">
						<div class="col-md-12">
							<div id="msg"><span >*Select the valid Id to merge data in the following documents.</span></div>
						</div>
						<div class="col-md-12">
		                    <div style=" width: 265px;" class="c-field c-text-singleline c-col-17 c-sml-col-1 c-span-8 c-sml-span-2">
		                    	<div  style="padding-left: 8px; "><strong>Record #</strong></div>
			                    <div class="c-editor">
			                    	<input class="font-m" name="autocomplete" type="text" id="autocomplete" autocomplete="off" placeholder="">
			                    {{-- <div class="c-helptext">SEARCH RECORD ID.</div> --}}
			                    </div>
			                </div>

		                    <div style="  width: 265px;" class="c-field c-text-singleline c-col-17 c-sml-col-1 c-span-8 c-sml-span-2">
		                    	<div  style="padding-left: 8px;"><strong>File Name</strong></div>
			                    <div class="c-editor">
			                    	<input class="font-m" name="filename" type="text" id="filename" placeholder="File Name">
			                    {{-- <div class="c-helptext">Write Filename in which you want to save it.</div> --}}
			                    </div>
			                </div>
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
								['id' => 'mergeBtn','type' => 'submit','class' => 'c-button', 'name' => 'mergeBtn', 'value' => $name, 'disabled' => 'disabled']); !!}

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
