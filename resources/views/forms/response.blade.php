@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">

	{!! Form::open(array('id' => 'form', 'route' => 'merge', 'method' => 'post')); !!}
		<div class="c-forms-form" tabindex="0">
			<div class="c-forms-confirmation" style="display: block;">
				<div class="c-forms-heading">
					<div class="c-forms-form-title">
						<h2>Property Form</h2>
					</div>
				</div>
				<div class="c-forms-confirmation-message c-html"><span>Thank you for filling out the form. Your response has been recorded.</span></div>
				<div class="c-forms-confirmation-message">
					<!-- <div class="c-forms-document-links">
						<a class="c-forms-document-link" target="_blank" href="">
						<span class="ms-word-file-icon-32x32"></span>
						<span>HMF Property Sales Data Form - 13</span>
						</a>
					</div> -->
					<div class="c-choice-radiobuttons c-field c-col-13 c-sml-col-1 c-span-12 c-sml-span-12">
                        <legend class="c-label  ">Merge Data into Documents</legend>
                        <div class="c-helptext">Choose documents</div>

                        @foreach ($templates as $name)
                        <div class="row">
							<div class="col-md-6">
								{!! Form::checkbox('services[]', $name); !!}  
					        	{!! Form::label('service' . $name, $name) !!} 
							</div>
							<div class="col-md-6">
								{!! Form::button('Merge <i id="gear-sub" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>', 
								['type' => 'submit','class' => 'c-button', 'name' => 'mergeBtn', 'value' => $name]); !!}

							</div>
					        <br>                        	
                        </div>
					    @endforeach

                        <div class="c-validation"></div>
                        
                    </div>
					<div class="c-button-section">
	                    <div class="c-action">
	                    	{!! Form::button('Merge', array('class' => 'c-button', 'type' => 'submit')); !!}
	                    </div>
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