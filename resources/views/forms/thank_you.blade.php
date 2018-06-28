@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">
	<form method="post">
		<div class="c-forms-form" tabindex="0">
			<div class="c-forms-confirmation" style="display: block;">
				<div class="c-forms-heading">
					<div class="c-forms-form-title">
						<h2>Developement Data Form</h2>
					</div>
				</div>
				<div class="c-forms-confirmation-message c-html"><span>Thank you for filling out the form. Your response has been recorded.</span></div>
				<div class="c-forms-confirmation-message">
				<div class="c-button-section at-btn">
                    <div class="c-action">
                    	<a href='{!! url('property/show'); !!}' target="_blank">Go To Property Form</a>
                    </div>
                </div>	
			
			<div class="c-footer-terms" >

			</div>
		</div>
	</form>

</div>	
@stop