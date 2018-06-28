@extends('layouts.default')
@section('content')
<div id="c-forms-container" class="cognito c-safari c-lrg">

<form method="post" action="{{url('property')}}">
  {{ csrf_field() }}
  <div class="c-forms-form" tabindex="0">
    <div class="c-editor" style="display:none;">
      <input type="text" class="c-forms-form-style">
    </div>
    <div class="c-forms-form-body">
        <div class="c-forms-heading">
            <div class="c-forms-logo" style="display:none;"></div>
            <div class="c-forms-form-title">
                <h2>HMF Account Statement Form</h2>
            </div>
        </div>
        <div class="c-forms-template">
            <div class="c-forms-form-main c-span-24 c-sml-span-12">
                <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-4 c-sml-span-6">
                    <div class="c-label  "><label for="c-0-28">Lot No</label></div>
                    <div class="c-editor"><input name="lot_no" type="text" id="c-0-28" placeholder=""></div>
                    <div class="c-validation"></div>
                </div>
                <div class="c-text-singleline c-field c-col-5 c-sml-col-5 c-span-4 c-sml-span-6">
                    <div class="c-label  "><label for="c-1-27">Volume / Folio No</label></div>
                    <div class="c-editor"><input name="folio_no" type="text" id="c-1-27" placeholder=""></div>
                    <div class="c-validation"></div>
                </div>
                <div class="c-section c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                    <div class="c-title">
                        <h3>DEBITS</h3>
                    </div>
                    <div class="">
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                            <div class="c-label  "><label for="c-2-26">Sale Price</label></div>
                            <div class="c-editor"><input name="sale_price" type="text" id="c-2-26" placeholder=""></div>
                            <div class="c-validation"></div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-3-25">Contract Price</label></div>
                            <div class="c-editor"><input type="text" id="c-3-25" placeholder=""></div>
                            <div class="c-validation">Contract Price is required.</div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-4-24">Upgrades</label></div>
                            <div class="c-editor"><input type="text" id="c-4-24" placeholder=""></div>
                            <div class="c-validation">Upgrades is required.</div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-5-23">½ Stamp Duty</label></div>
                            <div class="c-editor"><input type="text" id="c-5-23" placeholder=""></div>
                            <div class="c-validation">½ Stamp Duty is required.</div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-6-22">½ Registration Fee</label></div>
                            <div class="c-editor"><input type="text" id="c-6-22" placeholder=""></div>
                            <div class="c-validation">½ Registration Fee is required.</div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-7-21">½ Land Agreement Cost</label></div>
                            <div class="c-editor"><input type="text" id="c-7-21" placeholder=""></div>
                            <div class="c-validation">½ Land Agreement Cost is required.</div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-8-20">½ Building Agreement Cost</label></div>
                            <div class="c-editor"><input type="text" id="c-8-20" placeholder=""></div>
                            <div class="c-validation">½ Building Agreement Cost is required.</div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-9-19">½ Maintenance Costs</label></div>
                            <div class="c-editor"><input type="text" id="c-9-19" placeholder=""></div>
                            <div class="c-validation">½ Maintenance Costs is required.</div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-10-18">½ Title Costs</label></div>
                            <div class="c-editor"><input type="text" id="c-10-18" placeholder=""></div>
                            <div class="c-validation">½ Title Costs is required.</div>
                        </div>
                        <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                            <div class="c-label  "><label for="c-11-17">Miscellaneous Expenses</label></div>
                            <div class="c-editor"><input type="text" id="c-11-17" placeholder=""></div>
                            <div class="c-validation">Miscellaneous Expenses is required.</div>
                        </div>
                        <div class="c-section c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                            <div class="c-title c-repeating-section-title">
                                <h4>Other Expenses</h4>
                            </div>
                            <div class="c-repeating-section-group">
                                <div class="c-repeating-section-container">
                                    <div class="c-repeating-section-item-title">
                                        <div class="c-action-col"><a class="c-remove-item" title="Remove Expense"><i class="icon-remove-sign"></i></a></div>
                                        <h5>Expense <span>1</span></h5>
                                    </div>
                                    <div class="c-repeating-section-item">
                                        <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-6">
                                            <div class="c-label  "><label for="c-12-16">Expense Name</label></div>
                                            <div class="c-editor"><input type="text" id="c-12-16" placeholder=""></div>
                                            <div class="c-validation"></div>
                                        </div>
                                        <div class="c-currency c-field c-col-7 c-sml-col-7 c-span-6 c-sml-span-6">
                                            <div class="c-label  "><label for="c-13-15">Amount</label></div>
                                            <div class="c-editor"><input type="text" id="c-13-15" placeholder=""></div>
                                            <div class="c-validation"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-validation" style="display: block;"></div>
                            <div class="c-repeating-section-add"><a class="c-add-item" title="Add" tabindex="0">Add Expense</a></div>
                        </div>
                    </div>
                    <div class="c-validation"></div>
                </div>
                <div class="c-section c-col-13 c-sml-col-1 c-span-12 c-sml-span-12">
                    <div class="c-title">
                        <h3>CREDITS</h3>
                    </div>
                    <div class="">
                        <div class="c-section c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                            <div class="c-title c-repeating-section-title">
                                <h4>Payment Received</h4>
                            </div>
                            <div class="c-repeating-section-group">
                                <div class="c-repeating-section-container">
                                    <div class="c-repeating-section-item-title">
                                        <div class="c-action-col"><a class="c-remove-item" title="Remove Payment"><i class="icon-remove-sign"></i></a></div>
                                        <h5>Payment <span>1</span></h5>
                                    </div>
                                    <div class="c-repeating-section-item">
                                        <div class="c-text-multiplelines c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                            <div class="c-label  "><label for="c-14-10">Description </label></div>
                                            <div class="c-editor"><textarea id="c-14-10" placeholder="" type="text" height=""></textarea></div>
                                            <div class="c-validation"></div>
                                        </div>
                                        <div class="c-choice-dropdown c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-6">
                                            <div class="c-label  "><label for="c-15-9">Foreign Currency</label></div>
                                            <div class="c-editor"><input type="text" id="c-15-9" placeholder="" class="c-autocomplete" autocomplete="off" height=""></div>
                                            <div class="c-validation"></div>
                                        </div>
                                        <div class="c-currency c-field c-col-7 c-sml-col-7 c-span-6 c-sml-span-6">
                                            <div class="c-label  "><label for="c-16-8">Amount Foreign Currency</label></div>
                                            <div class="c-editor"><input type="text" id="c-16-8" placeholder=""></div>
                                            <div class="c-validation"></div>
                                        </div>
                                        <div class="c-date-date c-field c-col-1 c-sml-col-1 c-span-4 c-sml-span-4">
                                            <div class="c-label  "><label for="c-17-7">Date Received</label></div>
                                            <div class="c-editor">
                                                <div class="c-editor-date"><input type="text" id="c-17-7" placeholder="" class="c-datepicker"></div>
                                                <div class="c-editor-date-icon"><i class="icon-calendar"></i></div>
                                            </div>
                                            <div class="c-validation"></div>
                                        </div>
                                        <div class="c-currency c-field c-col-5 c-sml-col-5 c-span-8 c-sml-span-8">
                                            <div class="c-label  "><label for="c-18-6">Amount J$</label></div>
                                            <div class="c-editor"><input type="text" id="c-18-6" placeholder=""></div>
                                            <div class="c-validation"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-validation" style="display: block;"></div>
                            <div class="c-repeating-section-add"><a class="c-add-item" title="Add" tabindex="0">Add Payment</a></div>
                        </div>
                    </div>
                    <div class="c-validation"></div>
                </div>
            </div>
        </div>
        <div id="c-recaptcha-div"></div>
        <div class="c-forms-error">
            <div class="c-validation"></div>
        </div>
        <div class="c-button-section">
            <div class="c-action"><button class="c-button" id="c-submit-button">Submit</button></div>
        </div>
</div>
  </div>
  <input type="hidden" name="NoBots" id="c-nobots" value="Cpy9xdA3AeD6VuOZlzI7hF0cp+PxKQSFxbZWuPsDiNw=|8d3d2b1992a1961cb6d21eeaaf4a761b">
</form>
</div>
@stop
