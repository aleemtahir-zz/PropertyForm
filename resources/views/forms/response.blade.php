@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">
	<form method="post">
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
                        <div class="c-editor"> <!-- c-columns-0 -->
                            <div class="c-choice-option">
                            	<label>
                            		<input name="doc[]" type="radio" id="c-43-520" value="membership">
                            		<span>Doc1</span>
                            	</label>
                            </div>
                            <div class="c-choice-option">
                            	<label>
                            		<input name="doc[]" type="radio" id="c-43-521" value="template2">
                            		<span>Doc2</span>
                            	</label>
                            </div>
                            <div class="c-choice-option">
                            	<label>
                            		<input name="doc[]" type="radio" id="c-43-522" value="template3">
                            		<span>Doc3</span>
                            	</label>
                            </div>
                            <div class="c-choice-option">
                            	<label>
                            		<input name="doc[]" type="radio" id="c-43-523" value="template4">
                            		<span>Doc4</span>
                            	</label>
                            </div>
                        </div>
                        <div class="c-validation"></div>
                        
                    </div>
					<div class="c-button-section">
	                    <div class="c-action">
	                    	<button type="submit" class="c-button">Merge</button>
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
	</form>

</div>	

@stop