@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">
	{!! Form::open(array('id' => 'form', 'route' => 'sendemail', 'method' => 'post')); !!}
		<div class="c-forms-form" tabindex="0">
			<div class="c-forms-confirmation" style="display: block;">
				<div class="c-forms-heading">
					<div class="c-forms-form-title">
						<h2>Property Form</h2>
					</div>
				</div>
				<div class="c-forms-confirmation-message c-html"><span>Thank you for filling out the form. Your response has been recorded.</span></div>
				<div class="c-forms-confirmation-message">
					<div class="c-button-section">
						<div class="c-field c-col-1 c-sml-col-1 c-span-2 c-sml-span-2">
                          <div class="c-editor">
                          	{!! Form::label('email', 'E-Mail Address'); !!}
                          	{!! Form::text('email', 'aleemtahir@gmail.com', ['style' => 'width:150px']); !!}
                          </div>
                        </div>
	                    <div class="c-action">
	                    	{!! Form::button('Send', array('class' => 'c-button', 'type' => 'submit')); !!}
	                    </div>
	                </div>
					<div class="c-button-section at-btn">
	                    <div class="c-action">
	                    	<a href='{!! url('property/show'); !!}' target="_blank">Go To Property Form</a>
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