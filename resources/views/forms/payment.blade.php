@extends('layouts.default')
@section('content')
<div id="c-forms-container" class="cognito c-safari c-lrg">

<form method="post" action="{{url('payment')}}">
  {{ csrf_field() }}
    <div class="c-forms-form" tabindex="0">
        <div class="c-editor" style="display:none;">
          <input type="text" class="c-forms-form-style">
        </div>
        <div class="c-forms-form-body">
            <div class="c-forms-heading">
                <div class="c-forms-logo" style="display:none;"></div>
                <div class="c-forms-form-title">
                    <a href="{{url('')}}"><span class="float-right"><i class="fa fa-home"></i>Home</span></a>
                    <h2>HMF Account Statement Form</h2>
                </div>
                <div id="showerror" class = "alert alert-danger" style="display: none">
                    <ul>
                        <li></li>
                    </ul>
                 </div>  
            </div>
            <div class="c-forms-template">
                <div class="c-forms-form-main c-span-24 c-sml-span-12">
                    <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-7 c-sml-span-12">
                        <div class="c-label  "><label for="c-2-768">Record #</label></div>
                        <div class="c-editor float-right" style="width: 150px"> 
                            <input class="font-m" id="autocomplete" name="monetary[record_id]" type="text"  placeholder="CITY-47">
                        </div>
                        <div class="c-validation"></div>
                    </div>
                    <div class="c-text-singleline c-field c-col-9 c-sml-col-1 c-span-7 c-sml-span-12">
                        <button type="button" class="c-button margin-auto" onclick="lookUpProperty()">LOOKUP
                              <i id="gear-folio" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>
                        </button>
                    </div>
                    
                    <div class="c-section c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                        <div class="c-title">
                            <h3>DEBITS</h3>
                        </div>
                        <div class="">
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                <div class="c-label  "><label for="c-2-26">Sale Price</label></div>
                                <div class="c-editor"><input name="monetary[price_i]" type="text" id="c-2-26" placeholder=""></div>
                                <div class="c-validation"></div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-3-25">Contract Price</label></div>
                                <div class="c-editor"><input name="monetary[cprice_i]" type="text" id="c-3-25" placeholder=""></div>
                                <div class="c-validation">Contract Price is required.</div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-4-24">Upgrades</label></div>
                                <div class="c-editor"><input name="monetary[upgrade]" type="text" id="c-4-24" placeholder=""></div>
                                <div class="c-validation">Upgrades is required.</div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-5-23">½ Stamp Duty</label></div>
                                <div class="c-editor"><input name="monetary[half_stamp_duty]" type="text" id="c-5-23" placeholder=""></div>
                                <div class="c-validation">½ Stamp Duty is required.</div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-6-22">½ Registration Fee</label></div>
                                <div class="c-editor"><input name="monetary[half_reg_fee]" type="text" id="c-6-22" placeholder=""></div>
                                <div class="c-validation">½ Registration Fee is required.</div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-7-21">½ Land Agreement Cost</label></div>
                                <div class="c-editor"><input name="monetary[half_land_agreement]" type="text" id="c-7-21" placeholder=""></div>
                                <div class="c-validation">½ Land Agreement Cost is required.</div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-8-20">½ Building Agreement Cost</label></div>
                                <div class="c-editor"><input name="monetary[half_build_agreement]" type="text" id="c-8-20" placeholder=""></div>
                                <div class="c-validation">½ Building Agreement Cost is required.</div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-9-19">½ Maintenance Costs</label></div>
                                <div class="c-editor"><input name="monetary[half_maintain_cost]" type="text" id="c-9-19" placeholder=""></div>
                                <div class="c-validation">½ Maintenance Costs is required.</div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-10-18">½ Title Costs</label></div>
                                <div class="c-editor"><input name="monetary[half_title]" type="text" id="c-10-18" placeholder=""></div>
                                <div class="c-validation">½ Title Costs is required.</div>
                            </div>
                            <div class="c-number-integer c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12  c-required">
                                <div class="c-label  "><label for="c-11-17">Miscellaneous Expenses</label></div>
                                <div class="c-editor"><input name="monetary[misc_expense]" type="text" id="c-11-17" placeholder=""></div>
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
                                                <div class="c-editor"><input type="text" id="c-12-16" name="expense[name][]" placeholder=""></div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-currency c-field c-col-7 c-sml-col-7 c-span-6 c-sml-span-6">
                                                <div class="c-label  "><label for="c-13-15">Amount</label></div>
                                                <div class="c-editor"><input type="text" id="c-13-15" name="expense[price][]" placeholder=""></div>
                                                <div class="c-validation"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-validation" style="display: block;"></div>
                                <div class="c-repeating-section-add"><a class="c-add-item" title="Add" tabindex="0">Add Expense</a></div>
                                <div class="c-currency c-field c-col-9 c-sml-col-5 c-span-6 c-sml-span-6">
                                    <div class="c-label  "><label for="total_expense">Total Expense</label></div>
                                    <div class="c-editor"><input type="text" id="total_expense" name="monetary[total_expense]"></div>
                                    <div class="c-validation"></div>
                                </div>
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
                                                <div class="c-editor"><textarea id="c-14-10" name="payment[description][]" placeholder="" type="text" height=""></textarea></div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-choice-dropdown c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-6">
                                                <div class="c-label  "><label for="c-15-9">Foreign Currency</label></div>
                                                <div class="c-editor">
                                                  <div class="c-dropdown ">
                                                      <select value="{!!old('monetary.fc.name')!!}" name="payment[fc_name][]" id="fc_name">
                                                          <option></option>
                                                          <option selected="selected" value="United States Dollar">United States Dollar</option>
                                                          <option value="Canadian Dollar">Canadian Dollar</option>
                                                          <option value="Pound Sterling">Pound Sterling</option>
                                                      </select>
                                                  </div>
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-currency c-field c-col-7 c-sml-col-7 c-span-6 c-sml-span-6">
                                                <div class="c-label  "><label for="c-16-8">Amount </label></div>
                                                <div class="c-editor"><input type="text" id="c-16-8" name="payment[price][]" placeholder=""></div>
                                                <div class="c-validation"></div>
                                            </div>

                                            <div class="c-date-date c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-6">
                                                <div class="c-label  "><label for="c-17-7">Date Received</label></div>
                                                <div class="c-editor">
                                                    <div class="input-group date c-editor-date c-datepicker" >
                                                      <input class="datepicker" name="payment[date][]" type="text" id="c-6-252"placeholder="" >
                                                    </div>
                                                    <div class="c-editor-date-icon input-group-addon"><i class="icon-calendar"></i></div>
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-currency c-field c-col-5 c-sml-col-5 c-span-6 c-sml-span-6">
                                                <div class="c-label  "><label for="c-18-6">Amount J$</label></div>
                                                <div class="c-editor"><input type="text" id="c-18-6" name="payment[price_j][]" placeholder=""></div>
                                                <div class="c-validation"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-validation" style="display: block;"></div>
                                <div class="c-repeating-section-add"><a class="c-add-item" title="Add" tabindex="0">Add Payment</a></div>
                                <div class="c-currency c-field c-col-9 c-sml-col-5 c-span-6 c-sml-span-6">
                                    <div class="c-label  "><label for="total_payment">Total Payment</label></div>
                                    <div class="c-editor"><input type="text" id="total_payment" name="monetary[total_payment]"></div>
                                    <div class="c-validation"></div>
                                </div>
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
                <div class="c-action"><button class="c-button" id="payment-submit-button" >Submit</button></div>
            </div>
        </div>
    </div>
    @if (isset($showModal) && $showModal)
        <script type="text/javascript">
            setTimeout(function(){ 
                $("#paymentModal").modal('show');
                console.log("there");
            },500);
            console.log("here");
        </script>
    @endif

    <!-- The Modal -->
    <div class="modal" id="paymentModal">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Account Statement</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <span>Your Statement of Account has been updated and</span><br>
                <span>Saved as </span>&nbsp;<strong>
                    @if(isset($filename))
                        {{$filename}}
                    @endif
                </strong>
            </div>
            
            <!-- Modal footer -->
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->
            
          </div>
        </div>
    </div>
</form>
</div>

@stop
