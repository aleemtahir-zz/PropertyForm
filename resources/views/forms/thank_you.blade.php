@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">
	{!! Form::open(array('id' => 'form', 'route' => 'sendemail', 'method' => 'post')); !!}
		<div class="c-forms-form" tabindex="0">
			<div class="c-forms-confirmation" style="display: block;">
				<div class="c-forms-heading">
					<div class="c-forms-form-title">
						<h2>HMF Developer Data Form</h2>
					</div>
				</div>
				@if(isset($template) && $template == 'FormA')
					<div class="c-forms-confirmation-message c-html"><span>Thank you for completing the Developer Data Form.</span></div>
					<div class="c-forms-confirmation-message">
						<div class="c-button-section">
							<div class="c-field c-col-1 c-sml-col-1 c-span-4 c-sml-span-2">
	                          <div class="c-editor">
	                          	<h4 style="float: left; font-size: 13px; margin: 8px 15px 0 0;">Send to HMF</h4>
	                          	{!! Form::text('email', '', ['style' => 'width:180px', 'placeholder' => 'Email Address']); !!}
	                          </div>
	                        </div>
		                    <div class="c-action">
		                    	{!! Form::button('Send', array('class' => 'c-button', 'type' => 'submit')); !!}
		                    	<div class="c-helptext">Send Volume/Folio No. to your Email id.</div>
		                    </div>
		                </div>
		            </div>
		        @endif
		        @if(isset($template) && $template == 'FormB')
					<div class="c-forms-confirmation-message c-html"><span>Thank you for completing the Developer Data Form.</span></div>
					<div class="c-forms-confirmation-message">
						<div class="c-button-section at-btn">
		                    <div class="c-action">
		                    	<p style="float: left; font-size: 13px; margin: 0 8px 0 0;">Please proceed to the</p>
		                    	<a href='{!! url('property'); !!}' target="_blank">Property Transfer Form</a>
		                    </div>
		                </div>	
		            </div>
		        @endif
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