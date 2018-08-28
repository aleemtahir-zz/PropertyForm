@extends('layouts.default')
@section('content')

<div id="c-forms-container" class="cognito c-safari c-lrg">
    <form id="form" method="post" action="{{url($template)}}" enctype="multipart/form-data">

        <div class="c-forms-form" tabindex="0">
            <div class="c-editor" style="display:none;">
                <input type="text" class="c-forms-form-style">
            </div>
            <div class="c-forms-form-body">
                <div class="c-forms-heading">
                    <div class="c-forms-logo" style="display:none;">
                    </div>
                    <div class="c-forms-form-title">
                        <a href="{{url('')}}"><span class="float-right"><i class="fa fa-home"></i>Home</span></a>
                        <h2>HMF Developer Data Form</h2>
                        <div class="c-forms-description">
                            Please complete the form .
                        </div>
                    </div>
                </div>
                <div class="c-forms-form-main c-span-24 c-sml-span-12">
                    <div class="c-progress-section">
                        <div class="c-forms-progress c-progress-steps">
                            <ol class="navigation">
                                <li class="c-page-selected" data-page="1"><span>Page 1</span></li>
                                <li class="" data-page="2"><span>Page 2</span></li>
                                <li class="" data-page="3"><span>Page 3</span></li>
                                <li class="" data-page="4"><span>Page 4</span></li>
                            </ol>
                        </div>
                    </div>
                     @if (count($errors) > 0)
                         <div class = "alert alert-danger">
                            <ul>
                               @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                               @endforeach
                            </ul>
                         </div>
                      @endif
                      <div id="showerror" class = "alert alert-danger" style="display: none">
                          <ul>
                              <li></li>
                          </ul>
                       </div>
                    <div class="c-forms-pages">
                      <div class="c-page-page1" style="display: block;">
                          <div class="c-forms-template">
                              <div class="c-page toggle-off" >
                                  <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                      <div class="c-title">
                                          <h3>DEVELOPMENT DETAILS</h3>
                                      </div>
                                      <div class="">
                                          <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-2 c-sml-span-12">
                                              <div class="c-label "><label for="c-24-1629">ID</label></div>
                                              <div class="c-editor "><input id="dev_id" value="" name="developement[dev_id]" type="text" id="" disabled></div>
                                          </div>
                                          
                                          <div class="c-field  c-span-12 c-sml-span-12">
                                              <div class="c-label "><label for="c-24-1629">Name of Development</label></div>
                                              <div class="c-editor "><input value="{!!old('developement.name')!!}" name="developement[name]" type="text" id="c-24-1629" placeholder="eg  City View Villas" style="font-size: 1.3em;"></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-9 c-sml-span-12 ">
                                              <div class="c-label">
                                                <label for="c-25-1627">Parent Volume / Folio</label>
                                              </div>

                                              <div class="c-repeating-section-group">
                                                <div class="row vf-repeat">
                                                  <div>
                                                    <div class="c-editor width-60 float-left">
                                                      <input id="c-v-1" class="key" value="{!!old('developement.volume_no.0')!!}" name="developement[volume_no][]" type="text" maxlength="4" pattern="\d{4}" placeholder="1234">
                                                    </div>
                                                  </div>
                                                  
                                                  <span class="float-left" style="font-weight: bold; position: relative;">/</span>

                                                  <div>
                                                    <div class="c-editor width-60 float-left">
                                                      <input id="c-f-1" class="key" value="{!!old('developement.folio_no.0')!!}" name="developement[folio_no][]" type="text"  placeholder="1234" maxlength="4" pattern="\d{4}">
                                                    </div>
                                                  </div>
                                                  
                                                  <div class="c-repeating-section-add float-left">
                                                    <a class="at-add-item keyBtn" title="Add" tabindex="0"><i class="icon-plus"></i></a>
                                                  </div>

                                                  <div class="float-left">
                                                    <button type="button" class="c-button keyBtn vf-btn">Search
                                                      <i id="gear1" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>
                                                    </button>
                                                  </div>
                                                </div> 
                                              </div> 
                                          </div>  
                                          
                                          <div class="c-address c-address-us c-field c-col-1 c-sml-col-1 c-span-14 c-sml-span-12">
                                              <div class="c-label "><label>Address</label></div>
                                              <div>
                                                  <div class="c-offscreen"><label for="c-27-1626">Address Line 1</label></div>
                                                  <div class="c-editor" style="float: left;"><input value="{!!old('developement.address.line1')!!}" name="developement[address][line1]" type="text" id="c-27-1626" placeholder="Address Line 1"></div>
                                                  <div class="c-offscreen"><label for="c-28-1626">Address Line 2</label></div>
                                                  <div class="c-editor" style="float: left;"><input value="{!!old('developement.address.line2')!!}" name="developement[address][line2]" type="text" id="c-28-1626" placeholder="Address Line 2"></div>
                                                  <div class="c-offscreen"><label for="c-29-1626">City</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;"><input value="{!!old('developement.address.city')!!}" name="developement[address][city]" type="text" id="c-29-1626" placeholder="City"></div>
                                                  <div class="c-offscreen"><label for="c-30-1626">Paris</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;">
                                                   <!--  <input value="{!!old('developement.address.state')!!}" name="developement[address][state]" class="c-placeholder-text-styled" type="text" id="state" autocomplete="new-password" placeholder="Parish"> -->
                                                      <div class="c-dropdown">
                                                          <select value="{!!old('developement.address.state')!!}" name="developement[address][state]" id="c-30-1626" class="c-placeholder-text-styled ">
                                                              <option value="">Parish</option>
                                                              <option value="Clarendon">Clarendon</option>
                                                              <option value="Hanover">Hanover</option>
                                                              <option value="Kingston">Kingston</option>
                                                              <option value="Manchester">Manchester</option>
                                                              <option value="Portland">Portland</option>
                                                              <option value="Saint Andrew">Saint Andrew</option>
                                                              <option value="Saint Ann">Saint Ann</option>
                                                              <option value="Saint Catherine">Saint Catherine</option>
                                                              <option value="Saint Elizabeth">Saint Elizabeth</option>
                                                              <option value="Saint James">Saint James</option>
                                                              <option value="Saint Mary">Saint Mary</option>
                                                              <option value="Saint Thomas">Saint Thomas</option>
                                                              <option value="Trelawny">Trelawny</option>
                                                              <option value="Westmoreland">Westmoreland</option>
                                                          </select>
                                                      </div> 
                                                  </div>
                                              </div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-8 c-sml-span-6">
                                              <div class="c-label  "><label for="c-26-1627">Plan No.</label></div>
                                              <div class="c-editor"><input value="{!!old('developement.plan_no')!!}" name="developement[plan_no]" type="text" id="c-26-1627" placeholder="Plan number"></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-name c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                              <div class="c-label "><h3>Development Surveyor</h3></div>
                                              <div>
                                                  <div class="c-offscreen"><label for="c-32-1625">Title</label></div>
                                                  <div class="c-editor c-span-1" style="width: 20%; float: left;"><input value="{!!old('developement.surveyor.title')!!}" name="developement[surveyor][title]" type="text" id="c-32-1625" placeholder="Title"></div>
                                                  <div class="c-offscreen"><label for="c-33-1625">First</label></div>
                                                  <div class="c-editor c-span-1" style="width: 40%; float: left;"><input value="{!!old('developement.surveyor.first')!!}" name="developement[surveyor][first]" type="text" id="c-33-1625" placeholder="First"></div>
                                                  <div class="c-offscreen"><label for="c-34-1625">Last</label></div>
                                                  <div class="c-editor c-span-1" style="width: 40%; float: left;"><input value="{!!old('developement.surveyor.last')!!}"name="developement[surveyor][last]" type="text" id="c-34-1625" placeholder="Last"></div>
                                              </div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                              {{-- <div class="c-title">
                                                  <h4>Lots (Subdivisions)</h4>
                                              </div> --}}
                                              <div class="">
                                                  <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-12">
                                                      <div class="c-label  "><label for="title_cost">Title Cost</label></div>
                                                      <div class="c-editor"><input value="{!!old('payment.title_cost')!!} "name="payment[title_cost]" type="text" id="title_cost" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-currency c-field c-col-9 c-sml-col-1 c-span-6 c-sml-span-12">
                                                      <div class="c-label  "><label for="land_agreement_cost">Landing Agreement Cost</label></div>
                                                      <div class="c-editor"><input value="{!!old('payment.land_agreement_cost')!!}" name="payment[land_agreement_cost]" type="text" id="land_agreement_cost" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-currency c-field c-col-9 c-sml-col-1 c-span-6 c-sml-span-12">
                                                      <div class="c-label  "><label for="build_agreement_cost">Building Agreement Cost</label></div>
                                                      <div class="c-editor"><input value="{!!old('payment.build_agreement_cost')!!}" name="payment[build_agreement_cost]" type="text" id="build_agreement_cost" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-currency c-field c-col-17 c-sml-col-1 c-span-6 c-sml-span-12">
                                                      <div class="c-label  "><label for="identification_fee">ID Fee</label></div>
                                                      <div class="c-editor"><input value="{!!old('payment.identification_fee')!!}" name="payment[identification_fee]" type="text" id="identification_fee" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-12">
                                                      <div class="c-label  "><label for="c-36-1624">Total Lots</label></div>
                                                      <div class="c-editor"><input value="{!!old('developement.t_lots_i')!!} "name="developement[t_lots_i]" type="text" id="c-36-1624" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-currency c-field c-col-9 c-sml-col-1 c-span-6 c-sml-span-12">
                                                      <div class="c-label  "><label for="c-38-1622">Residential Lots</label></div>
                                                      <div class="c-editor"><input value="{!!old('developement.r_lots_i')!!}" name="developement[r_lots_i]" type="text" id="c-38-1622" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-currency c-field c-col-17 c-sml-col-1 c-span-6 c-sml-span-12">
                                                      <div class="c-label  "><label for="c-40-1620">Common Area Lots</label></div>
                                                      <div class="c-editor"><input value="{!!old('developement.c_lots_i')!!}" name="developement[c_lots_i]" type="text" id="c-40-1620" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-text-singleline c-field c-col-19 c-sml-col-1 c-span-6 c-sml-span-12">
                                                      <div class="c-label  "><label for="c-43-1617">Reserved Roads</label></div>
                                                      <div class="c-editor"><input value="{!!old('developement.rsrv_road')!!}" name="developement[rsrv_road]" type="text" id="c-43-1617" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-text-multiplelines c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                                      <div class="c-label  "><label for="c-42-1618">Lot ID numbers</label></div>
                                                      <div class="c-editor"><input value="{!!old('developement.lot_ids')!!}" name="developement[lot_ids]" id="c-42-1618" placeholder="1 - 45, 51 - 59, 64, 83 - 86" type="text" height=""></input></div>
                                                      <div class="c-validation"></div>
                                                      <div class="c-helptext">Enter the range of Lot ID numbers</div>
                                                  </div>
                                                  
                                              </div>
                                              <div class="c-validation"></div>
                                          </div>
                                      </div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-button-section">
                                      <div class="c-action"><button type="button" class="c-page-nav c-page-next-page c-button">Next</button></div>
                                  </div>
                                  <div class="c-page-numbering">1 / 4</div>
                              </div>
                          </div>
                      </div>
                      <div class="c-page-page2" style="display: none;">
                            <div class="c-forms-template" >
                                <div class="c-page toggle-off" >
                                    <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                        <div class="c-title">
                                            <h3>Developer Details</h3>
                                        </div>
                                        <div class="">
                                            <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                                <div class="c-label  ">
                                                    <label for="c-0-1607">Name</label>
                                                </div>
                                                <div class="c-editor">
                                                    <input type="text" value="{!!old('developer.company_name')!!}" name="developer[company_name]" id="c-0-1607" placeholder="">
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-name c-field c-col-1 c-sml-col-1 c-span-18 c-sml-span-12">
                                                <div class="c-label ">
                                                    <label>Developer Officer 1</label>
                                                </div>
                                                <div>
                                                    <div class="c-offscreen">
                                                        <label for="c-1-1606">Title</label>
                                                    </div>
                                                    <div class="c-editor c-span-1" style="width: 16.6667%; float: left;">
                                                        <input value="{!!old('developer.do1.title1')!!}" name="developer[do1][title1]" type="text" id="c-1-1606" placeholder="Title">
                                                    </div>
                                                    <div class="c-offscreen">
                                                        <label for="c-2-1606">First</label>
                                                    </div>
                                                    <div class="c-editor c-span-1" style="width: 33.3333%; float: left;">
                                                        <input value="{!!old('developer.do1.first1')!!}" name="developer[do1][first1]" type="text" id="c-2-1606" placeholder="First">
                                                    </div>
                                                    <div class="c-offscreen">
                                                        <label for="c-3-1606">Last</label>
                                                    </div>
                                                    <div class="c-editor c-span-1" style="width: 33.3333%; float: left;">
                                                        <input value="{!!old('developer.do1.last1')!!}" name="developer[do1][last1]" type="text" id="c-3-1606" placeholder="Last">
                                                    </div>
                                                    <div class="c-offscreen">
                                                        <label for="c-4-1606">Suffix</label>
                                                    </div>
                                                    <div class="c-editor c-span-1" style="width: 16.6667%; float: left;">
                                                        <input value="{!!old('developer.do1.suffix1')!!}" name="developer[do1][suffix1]" type="text" id="c-4-1606" placeholder="Suffix">
                                                    </div>
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-text-singleline c-field c-col-19 c-sml-col-1 c-span-6 c-sml-span-12">
                                                <div class="c-label  ">
                                                    <label for="c-6-1605">Capacity 1</label>
                                                </div>
                                                <div class="c-editor">
                                                    <input value="{!!old('developer.do1.capacity1')!!}" name="developer[do1][capacity1]" type="text" id="c-6-1605" placeholder="">
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-name c-field c-col-1 c-sml-col-1 c-span-18 c-sml-span-12">
                                                <div class="c-label ">
                                                    <label>Developer Officer 2</label>
                                                </div>
                                                <div>
                                                    <div class="c-offscreen">
                                                        <label for="c-7-1604">Title</label>
                                                    </div>
                                                    <div class="c-editor c-span-1" style="width: 16.6667%; float: left;">
                                                        <input value="{!!old('developer.do2.title2')!!}" name="developer[do2][title2]" type="text" id="c-7-1604" placeholder="Title">
                                                    </div>
                                                    <div class="c-offscreen">
                                                        <label for="c-8-1604">First</label>
                                                    </div>
                                                    <div class="c-editor c-span-1" style="width: 33.3333%; float: left;">
                                                        <input value="{!!old('developer.do2.first2')!!}" name="developer[do2][first2]" type="text" id="c-8-1604" placeholder="First">
                                                    </div>
                                                    <div class="c-offscreen">
                                                        <label for="c-9-1604">Last</label>
                                                    </div>
                                                    <div class="c-editor c-span-1" style="width: 33.3333%; float: left;">
                                                        <input value="{!!old('developer.do2.last2')!!}" name="developer[do2][last2]" type="text" id="c-9-1604" placeholder="Last">
                                                    </div>
                                                    <div class="c-offscreen">
                                                        <label for="c-10-1604">Suffix</label>
                                                    </div>
                                                    <div class="c-editor c-span-1" style="width: 16.6667%; float: left;">
                                                        <input value="{!!old('developer.do2.suffix2')!!}" name="developer[do2][suffix2]" type="text" id="c-10-1604" placeholder="Suffix">
                                                    </div>
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-text-singleline c-field c-col-19 c-sml-col-1 c-span-6 c-sml-span-12">
                                                <div class="c-label  ">
                                                    <label for="c-12-1603">Capacity 2</label>
                                                </div>
                                                <div class="c-editor">
                                                    <input value="{!!old('developer.do2.capacity2')!!}" name="developer[do2][capacity2]" type="text" id="c-12-1603" placeholder="">
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-phone c-phone-international c-field c-col-1 c-sml-col-1 c-span-5 c-sml-span-6">
                                                <div class="c-label  ">
                                                    <label for="c-13-1602">Landline 1</label>
                                                </div>
                                                <div class="c-editor">
                                                    <input value="{!!old('developer.do1.landline1')!!}" name="developer[do1][landline1]" type="text" id="c-13-1602" placeholder="">
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-phone c-phone-international c-field c-col-6 c-sml-col-6 c-span-5 c-sml-span-6">
                                                <div class="c-label  ">
                                                    <label for="c-14-1601"> Landline 2</label>
                                                </div>
                                                <div class="c-editor">
                                                    <input value="{!!old('developer.do2.landline2')!!}" name="developer[do2][landline2]" type="text" id="c-14-1601" placeholder="">
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-phone c-phone-international c-field c-col-11 c-sml-col-1 c-span-6 c-sml-span-12">
                                                <div class="c-label  ">
                                                    <label for="c-15-1600">Mobile</label>
                                                </div>
                                                <div class="c-editor">
                                                    <input value="{!!old('developer.mobile')!!}" name="developer[mobile]" type="text" id="c-15-1600" placeholder="">
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-email c-field c-col-17 c-sml-col-1 c-span-8 c-sml-span-12">
                                                <div class="c-label  ">
                                                    <label for="c-16-1599">Email</label>
                                                </div>
                                                <div class="c-editor"><input value="{!!old('developer.email')!!}" name="developer[email]" type="text" id="c-16-1599" placeholder="">
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-address c-address-international c-field c-col-1 c-sml-col-1 c-span-16 c-sml-span-12">
                                                <div class="c-label ">
                                                    <label>Registered Office Address</label>
                                                </div>
                                                <div>
                                                    <div class="c-offscreen">
                                                        <label for="c-17-1360">Address Line 1</label>
                                                    </div>
                                                    <div class="c-editor" style="float: left;">
                                                        <input value="{!!old('developer.address.line1')!!}" name="developer[address][line1]" type="text" id="c-17-1360" placeholder="Address Line 1">
                                                    </div>
                                                    <div class="c-offscreen">
                                                        <label for="c-18-1360">Address Line 2</label>
                                                    </div>
                                                    <div class="c-editor" style="float: left;">
                                                        <input value="{!!old('developer.address.line2')!!}" name="developer[address][line2]" type="text" id="c-18-1360" placeholder="Address Line 2">
                                                    </div>
                                                    <div class="c-offscreen">
                                                        <label for="c-19-1360">City</label>
                                                    </div>
                                                    <div class="c-editor c-partial-line" style="float: left;"><input value="{!!old('developer.address.city')!!}" name="developer[address][city]" type="text" id="c-19-1360" placeholder="City"></div>
{{--                                                     <div class="c-offscreen"><label for="c-20-1360">State / Province / Region</label></div>
                                                    <div class="c-editor c-partial-line" style="float: left;"><input value="{!!old('developer.address.state')!!}" name="developer[address][state]" type="text" id="c-20-1360" placeholder="State / Province / Region"></div> --}}
                                                    <div class="c-offscreen"><label for="c-30-1626">Paris</label></div>
                                                    <div class="c-editor c-partial-line" style="float: left;">
                                                        <div class="c-dropdown">
                                                            <select value="{!!old('developer.address.state')!!}" name="developer[address][state]" id="c-20-1360" class="c-placeholder-text-styled ">
                                                              <option value="">Parish</option>
                                                              <option value="Clarendon">Clarendon</option>
                                                              <option value="Hanover">Hanover</option>
                                                              <option value="Kingston">Kingston</option>
                                                              <option value="Manchester">Manchester</option>
                                                              <option value="Portland">Portland</option>
                                                              <option value="Saint Andrew">Saint Andrew</option>
                                                              <option value="Saint Ann">Saint Ann</option>
                                                              <option value="Saint Catherine">Saint Catherine</option>
                                                              <option value="Saint Elizabeth">Saint Elizabeth</option>
                                                              <option value="Saint James">Saint James</option>
                                                              <option value="Saint Mary">Saint Mary</option>
                                                              <option value="Saint Thomas">Saint Thomas</option>
                                                              <option value="Trelawny">Trelawny</option>
                                                              <option value="Westmoreland">Westmoreland</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="c-offscreen"><label for="c-21-1360">Country</label></div>
                                                    <div class="c-editor c-partial-line" style="float: left;">
                                                        <div class="c-dropdown">
                                                            <select value="{!!old('developer.address.country')!!}" name="developer[address][country]" id="c-21-1360" class="c-placeholder-text-styled">
                                                                <option value="">Country</option>
                                                                <option value="Afghanistan">Afghanistan</option>
                                                                <option value="Albania">Albania</option>
                                                                <option value="Algeria">Algeria</option>
                                                                <option value="American Samoa">American Samoa</option>
                                                                <option value="Andorra">Andorra</option>
                                                                <option value="Angola">Angola</option>
                                                                <option value="Anguilla">Anguilla</option>
                                                                <option value="Antarctica">Antarctica</option>
                                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                <option value="Argentina">Argentina</option>
                                                                <option value="Armenia">Armenia</option>
                                                                <option value="Aruba">Aruba</option>
                                                                <option value="Australia">Australia</option>
                                                                <option value="Austria">Austria</option>
                                                                <option value="Azerbaijan">Azerbaijan</option>
                                                                <option value="Bahamas">Bahamas</option>
                                                                <option value="Bahrain">Bahrain</option>
                                                                <option value="Bangladesh">Bangladesh</option>
                                                                <option value="Barbados">Barbados</option>
                                                                <option value="Belarus">Belarus</option>
                                                                <option value="Belgium">Belgium</option>
                                                                <option value="Belize">Belize</option>
                                                                <option value="Benin">Benin</option>
                                                                <option value="Bermuda">Bermuda</option>
                                                                <option value="Bhutan">Bhutan</option>
                                                                <option value="Bolivia">Bolivia</option>
                                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                <option value="Botswana">Botswana</option>
                                                                <option value="Brazil">Brazil</option>
                                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                                <option value="Bulgaria">Bulgaria</option>
                                                                <option value="Burkina Faso">Burkina Faso</option>
                                                                <option value="Burundi">Burundi</option>
                                                                <option value="Cambodia">Cambodia</option>
                                                                <option value="Cameroon">Cameroon</option>
                                                                <option value="Canada">Canada</option>
                                                                <option value="Cape Verde">Cape Verde</option>
                                                                <option value="Cayman Islands">Cayman Islands</option>
                                                                <option value="Central African Republic">Central African Republic</option>
                                                                <option value="Chad">Chad</option>
                                                                <option value="Chile">Chile</option>
                                                                <option value="China">China</option>
                                                                <option value="Christmas Island">Christmas Island</option>
                                                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                                <option value="Colombia">Colombia</option>
                                                                <option value="Comoros">Comoros</option>
                                                                <option value="Congo, Republic of(Brazzaville)">Congo, Republic of(Brazzaville)</option>
                                                                <option value="Cook Islands">Cook Islands</option>
                                                                <option value="Costa Rica">Costa Rica</option>
                                                                <option value="Croatia">Croatia</option>
                                                                <option value="Cuba">Cuba</option>
                                                                <option value="Cyprus">Cyprus</option>
                                                                <option value="Czech Republic">Czech Republic</option>
                                                                <option value="Democratic Republic of the Congo (Kinshasa)">Democratic Republic of the Congo (Kinshasa)</option>
                                                                <option value="Denmark">Denmark</option>
                                                                <option value="Djibouti">Djibouti</option>
                                                                <option value="Dominica">Dominica</option>
                                                                <option value="Dominican Republic">Dominican Republic</option>
                                                                <option value="East Timor (Timor-Leste)">East Timor (Timor-Leste)</option>
                                                                <option value="Ecuador">Ecuador</option>
                                                                <option value="Egypt">Egypt</option>
                                                                <option value="El Salvador">El Salvador</option>
                                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                <option value="Eritrea">Eritrea</option>
                                                                <option value="Estonia">Estonia</option>
                                                                <option value="Ethiopia">Ethiopia</option>
                                                                <option value="Falkland Islands">Falkland Islands</option>
                                                                <option value="Faroe Islands">Faroe Islands</option>
                                                                <option value="Fiji">Fiji</option>
                                                                <option value="Finland">Finland</option>
                                                                <option value="France">France</option>
                                                                <option value="French Guiana">French Guiana</option>
                                                                <option value="French Polynesia">French Polynesia</option>
                                                                <option value="French Southern Territories">French Southern Territories</option>
                                                                <option value="Gabon">Gabon</option>
                                                                <option value="Gambia">Gambia</option>
                                                                <option value="Georgia">Georgia</option>
                                                                <option value="Germany">Germany</option>
                                                                <option value="Ghana">Ghana</option>
                                                                <option value="Gibraltar">Gibraltar</option>
                                                                <option value="Great Britain">Great Britain</option>
                                                                <option value="Greece">Greece</option>
                                                                <option value="Greenland">Greenland</option>
                                                                <option value="Grenada">Grenada</option>
                                                                <option value="Guadeloupe">Guadeloupe</option>
                                                                <option value="Guam">Guam</option>
                                                                <option value="Guatemala">Guatemala</option>
                                                                <option value="Guinea">Guinea</option>
                                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                                <option value="Guyana">Guyana</option>
                                                                <option value="Haiti">Haiti</option>
                                                                <option value="Holy See">Holy See</option>
                                                                <option value="Honduras">Honduras</option>
                                                                <option value="Hong Kong">Hong Kong</option>
                                                                <option value="Hungary">Hungary</option>
                                                                <option value="Iceland">Iceland</option>
                                                                <option value="India">India</option>
                                                                <option value="Indonesia">Indonesia</option>
                                                                <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                                                <option value="Iraq">Iraq</option>
                                                                <option value="Ireland">Ireland</option>
                                                                <option value="Israel">Israel</option>
                                                                <option value="Italy">Italy</option>
                                                                <option value="Ivory Coast">Ivory Coast</option>
                                                                <option selected="selected" value="Jamaica">Jamaica</option>
                                                                <option value="Japan">Japan</option>
                                                                <option value="Jordan">Jordan</option>
                                                                <option value="Kazakhstan">Kazakhstan</option>
                                                                <option value="Kenya">Kenya</option>
                                                                <option value="Kiribati">Kiribati</option>
                                                                <option value="Korea, Democratic People's Rep. (North Korea)">Korea, Democratic People's Rep. (North Korea)</option>
                                                                <option value="Korea, Republic of (South Korea)">Korea, Republic of (South Korea)</option>
                                                                <option value="Kosovo">Kosovo</option>
                                                                <option value="Kuwait">Kuwait</option>
                                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                <option value="Lao, People's Democratic Republic">Lao, People's Democratic Republic</option>
                                                                <option value="Latvia">Latvia</option>
                                                                <option value="Lebanon">Lebanon</option>
                                                                <option value="Lesotho">Lesotho</option>
                                                                <option value="Liberia">Liberia</option>
                                                                <option value="Libya">Libya</option>
                                                                <option value="Liechtenstein">Liechtenstein</option>
                                                                <option value="Lithuania">Lithuania</option>
                                                                <option value="Luxembourg">Luxembourg</option>
                                                                <option value="Macau">Macau</option>
                                                                <option value="Macedonia, Rep. of">Macedonia, Rep. of</option>
                                                                <option value="Madagascar">Madagascar</option>
                                                                <option value="Malawi">Malawi</option>
                                                                <option value="Malaysia">Malaysia</option>
                                                                <option value="Maldives">Maldives</option>
                                                                <option value="Mali">Mali</option>
                                                                <option value="Malta">Malta</option>
                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                <option value="Martinique">Martinique</option>
                                                                <option value="Mauritania">Mauritania</option>
                                                                <option value="Mauritius">Mauritius</option>
                                                                <option value="Mayotte">Mayotte</option>
                                                                <option value="Mexico">Mexico</option>
                                                                <option value="Micronesia, Federal States of">Micronesia, Federal States of</option>
                                                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                                <option value="Monaco">Monaco</option>
                                                                <option value="Mongolia">Mongolia</option>
                                                                <option value="Montenegro">Montenegro</option>
                                                                <option value="Montserrat">Montserrat</option>
                                                                <option value="Morocco">Morocco</option>
                                                                <option value="Mozambique">Mozambique</option>
                                                                <option value="Myanmar, Burma">Myanmar, Burma</option>
                                                                <option value="Namibia">Namibia</option>
                                                                <option value="Nauru">Nauru</option>
                                                                <option value="Nepal">Nepal</option>
                                                                <option value="Netherlands">Netherlands</option>
                                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                <option value="New Caledonia">New Caledonia</option>
                                                                <option value="New Zealand">New Zealand</option>
                                                                <option value="Nicaragua">Nicaragua</option>
                                                                <option value="Niger">Niger</option>
                                                                <option value="Nigeria">Nigeria</option>
                                                                <option value="Niue">Niue</option>
                                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                <option value="Norway">Norway</option>
                                                                <option value="Oman">Oman</option>
                                                                <option value="Pakistan">Pakistan</option>
                                                                <option value="Palau">Palau</option>
                                                                <option value="Palestinian territories">Palestinian territories</option>
                                                                <option value="Panama">Panama</option>
                                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                                <option value="Paraguay">Paraguay</option>
                                                                <option value="Peru">Peru</option>
                                                                <option value="Philippines">Philippines</option>
                                                                <option value="Pitcairn Island">Pitcairn Island</option>
                                                                <option value="Poland">Poland</option>
                                                                <option value="Portugal">Portugal</option>
                                                                <option value="Puerto Rico">Puerto Rico</option>
                                                                <option value="Qatar">Qatar</option>
                                                                <option value="Reunion Island">Reunion Island</option>
                                                                <option value="Romania">Romania</option>
                                                                <option value="Russian Federation">Russian Federation</option>
                                                                <option value="Rwanda">Rwanda</option>
                                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                <option value="Saint Lucia">Saint Lucia</option>
                                                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                                <option value="Samoa">Samoa</option>
                                                                <option value="San Marino">San Marino</option>
                                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                                <option value="Senegal">Senegal</option>
                                                                <option value="Serbia">Serbia</option>
                                                                <option value="Seychelles">Seychelles</option>
                                                                <option value="Sierra Leone">Sierra Leone</option>
                                                                <option value="Singapore">Singapore</option>
                                                                <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
                                                                <option value="Slovenia">Slovenia</option>
                                                                <option value="Solomon Islands">Solomon Islands</option>
                                                                <option value="Somalia">Somalia</option>
                                                                <option value="South Africa">South Africa</option>
                                                                <option value="South Sudan">South Sudan</option>
                                                                <option value="Spain">Spain</option>
                                                                <option value="Sri Lanka">Sri Lanka</option>
                                                                <option value="Sudan">Sudan</option>
                                                                <option value="Suriname">Suriname</option>
                                                                <option value="Swaziland">Swaziland</option>
                                                                <option value="Sweden">Sweden</option>
                                                                <option value="Switzerland">Switzerland</option>
                                                                <option value="Syria, Syrian Arab Republic">Syria, Syrian Arab Republic</option>
                                                                <option value="Taiwan (Republic of China)">Taiwan (Republic of China)</option>
                                                                <option value="Tajikistan">Tajikistan</option>
                                                                <option value="Tanzania; officially the United Republic of Tanzania">Tanzania; officially the United Republic of Tanzania</option>
                                                                <option value="Thailand">Thailand</option>
                                                                <option value="Tibet">Tibet</option>
                                                                <option value="Timor-Leste (East Timor)">Timor-Leste (East Timor)</option>
                                                                <option value="Togo">Togo</option>
                                                                <option value="Tokelau">Tokelau</option>
                                                                <option value="Tonga">Tonga</option>
                                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                <option value="Tunisia">Tunisia</option>
                                                                <option value="Turkey">Turkey</option>
                                                                <option value="Turkmenistan">Turkmenistan</option>
                                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                                <option value="Tuvalu">Tuvalu</option>
                                                                <option value="Uganda">Uganda</option>
                                                                <option value="Ukraine">Ukraine</option>
                                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                                <option value="United Kingdom">United Kingdom</option>
                                                                <option value="United States">United States</option>
                                                                <option value="Uruguay">Uruguay</option>
                                                                <option value="Uzbekistan">Uzbekistan</option>
                                                                <option value="Vanuatu">Vanuatu</option>
                                                                <option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                                                                <option value="Venezuela">Venezuela</option>
                                                                <option value="Vietnam">Vietnam</option>
                                                                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                                                <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                                                <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                                                                <option value="Western Sahara">Western Sahara</option>
                                                                <option value="Yemen">Yemen</option>
                                                                <option value="Zambia">Zambia</option>
                                                                <option value="Zimbabwe">Zimbabwe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                            <div class="c-file c-field c-col-17 c-sml-col-1 c-span-8 c-sml-span-12">
                                                <div class="c-label  "><label for="c-23-1359">Company Logo</label></div>
                                                <div class="c-editor c-fileupload" data-allowed-types="jpg,jpeg,gif,png" data-max-file-count="1" data-max-file-size="100">
                                                    <div class="c-fileupload-dropzone c-background-highlight">
                                                        <div class="c-upload-button" tabindex="0">Upload<input type="file" value="{!!old('developer_logo')!!}" name="developer_logo" id="fileUpload" tabindex="-1" accept=".jpg, .jpeg, .png"></div>
                                                        <span class="c-fileupload-dropzone-message"></span>
                                                    </div>
                                                    <div class="c-validation c-warning"></div>
                                                    <div class="c-fileupload-filelist"></div>
                                                </div>
                                                <div class="c-validation"></div>
                                            </div>
                                        </div>
                                        <div class="c-validation"></div>
                                    </div>
                                    <div class="c-button-section">
                                        <div class="c-action"><button type="button" class="c-page-nav c-page-previous-page c-button">Back</button><button type="button" class="c-page-nav c-page-next-page c-button">Next</button></div>
                                    </div>
                                    <div class="c-page-numbering">2 / 4</div>
                                </div>
                            </div>
                      </div>
                      <div class="c-page-page3" style="display: none;">
                          <div class="c-forms-template" >
                              <div class="c-page toggle-off">
                                  <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                      <div class="c-title">
                                          <h3>Building Contract Details</h3>
                                      </div>
                                      <div class="">
                                          <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                              <div class="c-label  "><label for="c-44-1877">Company Name</label></div>
                                              <div class="c-editor"><input value="{!!old('contractor.company_name')!!}" name="contractor[company_name]" type="text" id="c-44-1877" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-name c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                              <div class="c-label "><label>Authorised Contractor Officer</label></div>
                                              <div>
                                                  <div class="c-offscreen"><label for="c-45-1876">Title</label></div>
                                                  <div class="c-editor c-span-1" style="width: 20%; float: left;"><input value="{!!old('contractor.co.title')!!}" name="contractor[co][title]" type="text" id="c-45-1876" placeholder="Title"></div>
                                                  <div class="c-offscreen"><label for="c-46-1876">First</label></div>
                                                  <div class="c-editor c-span-1" style="width: 40%; float: left;"><input value="{!!old('contractor.co.first')!!}" name="contractor[co][first]" type="text" id="c-46-1876" placeholder="First"></div>
                                                  <div class="c-offscreen"><label for="c-47-1876">Last</label></div>
                                                  <div class="c-editor c-span-1" style="width: 40%; float: left;"><input value="{!!old('contractor.co.last')!!}" name="contractor[co][last]" type="text" id="c-47-1876" placeholder="Last"></div>
                                              </div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-address c-address-international c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                              <div class="c-label "><label>Contractor Business Address</label></div>
                                              <div>
                                                  <div class="c-offscreen"><label for="c-49-1637">Address Line 1</label></div>
                                                  <div class="c-editor" style="float: left;"><input value="{!!old('contractor.address.line1')!!}" name="contractor[address][line1]" type="text" id="c-49-1637" placeholder="Address Line 1"></div>
                                                  <div class="c-offscreen"><label for="c-50-1637">Address Line 2</label></div>
                                                  <div class="c-editor" style="float: left;"><input value="{!!old('contractor.address.line2')!!}" name="contractor[address][line2]" type="text" id="c-50-1637" placeholder="Address Line 2"></div>
                                                  <div class="c-offscreen"><label for="c-51-1637">City</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;"><input value="{!!old('contractor.address.city')!!}" name="contractor[address][city]" type="text" id="c-51-1637" placeholder="City"></div>
{{--                                                   <div class="c-offscreen"><label for="c-52-1637">State / Province / Region</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;"><input value="{!!old('contractor.address.state')!!}" name="contractor[address][state]" type="text" id="c-52-1637" placeholder="State / Province / Region"></div> --}}
                                                  <div class="c-offscreen"><label for="c-30-1626">Paris</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;">
                                                      <div class="c-dropdown">
                                                          <select value="{!!old('contractor.address.state')!!}" name="contractor[address][state]" id="c-52-1637" class="c-placeholder-text-styled ">
                                                              <option value="">Parish</option>
                                                              <option value="Clarendon">Clarendon</option>
                                                              <option value="Hanover">Hanover</option>
                                                              <option value="Kingston">Kingston</option>
                                                              <option value="Manchester">Manchester</option>
                                                              <option value="Portland">Portland</option>
                                                              <option value="Saint Andrew">Saint Andrew</option>
                                                              <option value="Saint Ann">Saint Ann</option>
                                                              <option value="Saint Catherine">Saint Catherine</option>
                                                              <option value="Saint Elizabeth">Saint Elizabeth</option>
                                                              <option value="Saint James">Saint James</option>
                                                              <option value="Saint Mary">Saint Mary</option>
                                                              <option value="Saint Thomas">Saint Thomas</option>
                                                              <option value="Trelawny">Trelawny</option>
                                                              <option value="Westmoreland">Westmoreland</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="c-offscreen"><label for="c-53-1637">Country</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;">
                                                      <div class="c-dropdown">
                                                          <select value="{!!old('contractor.address.country')!!}" name="contractor[address][country]" id="c-53-1637" class="c-placeholder-text-styled">
                                                              <option value="">Country</option>
                                                              <option value="Afghanistan">Afghanistan</option>
                                                              <option value="Albania">Albania</option>
                                                              <option value="Algeria">Algeria</option>
                                                              <option value="American Samoa">American Samoa</option>
                                                              <option value="Andorra">Andorra</option>
                                                              <option value="Angola">Angola</option>
                                                              <option value="Anguilla">Anguilla</option>
                                                              <option value="Antarctica">Antarctica</option>
                                                              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                              <option value="Argentina">Argentina</option>
                                                              <option value="Armenia">Armenia</option>
                                                              <option value="Aruba">Aruba</option>
                                                              <option value="Australia">Australia</option>
                                                              <option value="Austria">Austria</option>
                                                              <option value="Azerbaijan">Azerbaijan</option>
                                                              <option value="Bahamas">Bahamas</option>
                                                              <option value="Bahrain">Bahrain</option>
                                                              <option value="Bangladesh">Bangladesh</option>
                                                              <option value="Barbados">Barbados</option>
                                                              <option value="Belarus">Belarus</option>
                                                              <option value="Belgium">Belgium</option>
                                                              <option value="Belize">Belize</option>
                                                              <option value="Benin">Benin</option>
                                                              <option value="Bermuda">Bermuda</option>
                                                              <option value="Bhutan">Bhutan</option>
                                                              <option value="Bolivia">Bolivia</option>
                                                              <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                              <option value="Botswana">Botswana</option>
                                                              <option value="Brazil">Brazil</option>
                                                              <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                              <option value="Bulgaria">Bulgaria</option>
                                                              <option value="Burkina Faso">Burkina Faso</option>
                                                              <option value="Burundi">Burundi</option>
                                                              <option value="Cambodia">Cambodia</option>
                                                              <option value="Cameroon">Cameroon</option>
                                                              <option value="Canada">Canada</option>
                                                              <option value="Cape Verde">Cape Verde</option>
                                                              <option value="Cayman Islands">Cayman Islands</option>
                                                              <option value="Central African Republic">Central African Republic</option>
                                                              <option value="Chad">Chad</option>
                                                              <option value="Chile">Chile</option>
                                                              <option value="China">China</option>
                                                              <option value="Christmas Island">Christmas Island</option>
                                                              <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                              <option value="Colombia">Colombia</option>
                                                              <option value="Comoros">Comoros</option>
                                                              <option value="Congo, Republic of(Brazzaville)">Congo, Republic of(Brazzaville)</option>
                                                              <option value="Cook Islands">Cook Islands</option>
                                                              <option value="Costa Rica">Costa Rica</option>
                                                              <option value="Croatia">Croatia</option>
                                                              <option value="Cuba">Cuba</option>
                                                              <option value="Cyprus">Cyprus</option>
                                                              <option value="Czech Republic">Czech Republic</option>
                                                              <option value="Democratic Republic of the Congo (Kinshasa)">Democratic Republic of the Congo (Kinshasa)</option>
                                                              <option value="Denmark">Denmark</option>
                                                              <option value="Djibouti">Djibouti</option>
                                                              <option value="Dominica">Dominica</option>
                                                              <option value="Dominican Republic">Dominican Republic</option>
                                                              <option value="East Timor (Timor-Leste)">East Timor (Timor-Leste)</option>
                                                              <option value="Ecuador">Ecuador</option>
                                                              <option value="Egypt">Egypt</option>
                                                              <option value="El Salvador">El Salvador</option>
                                                              <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                              <option value="Eritrea">Eritrea</option>
                                                              <option value="Estonia">Estonia</option>
                                                              <option value="Ethiopia">Ethiopia</option>
                                                              <option value="Falkland Islands">Falkland Islands</option>
                                                              <option value="Faroe Islands">Faroe Islands</option>
                                                              <option value="Fiji">Fiji</option>
                                                              <option value="Finland">Finland</option>
                                                              <option value="France">France</option>
                                                              <option value="French Guiana">French Guiana</option>
                                                              <option value="French Polynesia">French Polynesia</option>
                                                              <option value="French Southern Territories">French Southern Territories</option>
                                                              <option value="Gabon">Gabon</option>
                                                              <option value="Gambia">Gambia</option>
                                                              <option value="Georgia">Georgia</option>
                                                              <option value="Germany">Germany</option>
                                                              <option value="Ghana">Ghana</option>
                                                              <option value="Gibraltar">Gibraltar</option>
                                                              <option value="Great Britain">Great Britain</option>
                                                              <option value="Greece">Greece</option>
                                                              <option value="Greenland">Greenland</option>
                                                              <option value="Grenada">Grenada</option>
                                                              <option value="Guadeloupe">Guadeloupe</option>
                                                              <option value="Guam">Guam</option>
                                                              <option value="Guatemala">Guatemala</option>
                                                              <option value="Guinea">Guinea</option>
                                                              <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                              <option value="Guyana">Guyana</option>
                                                              <option value="Haiti">Haiti</option>
                                                              <option value="Holy See">Holy See</option>
                                                              <option value="Honduras">Honduras</option>
                                                              <option value="Hong Kong">Hong Kong</option>
                                                              <option value="Hungary">Hungary</option>
                                                              <option value="Iceland">Iceland</option>
                                                              <option value="India">India</option>
                                                              <option value="Indonesia">Indonesia</option>
                                                              <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                                              <option value="Iraq">Iraq</option>
                                                              <option value="Ireland">Ireland</option>
                                                              <option value="Israel">Israel</option>
                                                              <option value="Italy">Italy</option>
                                                              <option value="Ivory Coast">Ivory Coast</option>
                                                              <option selected="selected" value="Jamaica">Jamaica</option>
                                                              <option value="Japan">Japan</option>
                                                              <option value="Jordan">Jordan</option>
                                                              <option value="Kazakhstan">Kazakhstan</option>
                                                              <option value="Kenya">Kenya</option>
                                                              <option value="Kiribati">Kiribati</option>
                                                              <option value="Korea, Democratic People's Rep. (North Korea)">Korea, Democratic People's Rep. (North Korea)</option>
                                                              <option value="Korea, Republic of (South Korea)">Korea, Republic of (South Korea)</option>
                                                              <option value="Kosovo">Kosovo</option>
                                                              <option value="Kuwait">Kuwait</option>
                                                              <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                              <option value="Lao, People's Democratic Republic">Lao, People's Democratic Republic</option>
                                                              <option value="Latvia">Latvia</option>
                                                              <option value="Lebanon">Lebanon</option>
                                                              <option value="Lesotho">Lesotho</option>
                                                              <option value="Liberia">Liberia</option>
                                                              <option value="Libya">Libya</option>
                                                              <option value="Liechtenstein">Liechtenstein</option>
                                                              <option value="Lithuania">Lithuania</option>
                                                              <option value="Luxembourg">Luxembourg</option>
                                                              <option value="Macau">Macau</option>
                                                              <option value="Macedonia, Rep. of">Macedonia, Rep. of</option>
                                                              <option value="Madagascar">Madagascar</option>
                                                              <option value="Malawi">Malawi</option>
                                                              <option value="Malaysia">Malaysia</option>
                                                              <option value="Maldives">Maldives</option>
                                                              <option value="Mali">Mali</option>
                                                              <option value="Malta">Malta</option>
                                                              <option value="Marshall Islands">Marshall Islands</option>
                                                              <option value="Martinique">Martinique</option>
                                                              <option value="Mauritania">Mauritania</option>
                                                              <option value="Mauritius">Mauritius</option>
                                                              <option value="Mayotte">Mayotte</option>
                                                              <option value="Mexico">Mexico</option>
                                                              <option value="Micronesia, Federal States of">Micronesia, Federal States of</option>
                                                              <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                              <option value="Monaco">Monaco</option>
                                                              <option value="Mongolia">Mongolia</option>
                                                              <option value="Montenegro">Montenegro</option>
                                                              <option value="Montserrat">Montserrat</option>
                                                              <option value="Morocco">Morocco</option>
                                                              <option value="Mozambique">Mozambique</option>
                                                              <option value="Myanmar, Burma">Myanmar, Burma</option>
                                                              <option value="Namibia">Namibia</option>
                                                              <option value="Nauru">Nauru</option>
                                                              <option value="Nepal">Nepal</option>
                                                              <option value="Netherlands">Netherlands</option>
                                                              <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                              <option value="New Caledonia">New Caledonia</option>
                                                              <option value="New Zealand">New Zealand</option>
                                                              <option value="Nicaragua">Nicaragua</option>
                                                              <option value="Niger">Niger</option>
                                                              <option value="Nigeria">Nigeria</option>
                                                              <option value="Niue">Niue</option>
                                                              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                              <option value="Norway">Norway</option>
                                                              <option value="Oman">Oman</option>
                                                              <option value="Pakistan">Pakistan</option>
                                                              <option value="Palau">Palau</option>
                                                              <option value="Palestinian territories">Palestinian territories</option>
                                                              <option value="Panama">Panama</option>
                                                              <option value="Papua New Guinea">Papua New Guinea</option>
                                                              <option value="Paraguay">Paraguay</option>
                                                              <option value="Peru">Peru</option>
                                                              <option value="Philippines">Philippines</option>
                                                              <option value="Pitcairn Island">Pitcairn Island</option>
                                                              <option value="Poland">Poland</option>
                                                              <option value="Portugal">Portugal</option>
                                                              <option value="Puerto Rico">Puerto Rico</option>
                                                              <option value="Qatar">Qatar</option>
                                                              <option value="Reunion Island">Reunion Island</option>
                                                              <option value="Romania">Romania</option>
                                                              <option value="Russian Federation">Russian Federation</option>
                                                              <option value="Rwanda">Rwanda</option>
                                                              <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                              <option value="Saint Lucia">Saint Lucia</option>
                                                              <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                              <option value="Samoa">Samoa</option>
                                                              <option value="San Marino">San Marino</option>
                                                              <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                              <option value="Saudi Arabia">Saudi Arabia</option>
                                                              <option value="Senegal">Senegal</option>
                                                              <option value="Serbia">Serbia</option>
                                                              <option value="Seychelles">Seychelles</option>
                                                              <option value="Sierra Leone">Sierra Leone</option>
                                                              <option value="Singapore">Singapore</option>
                                                              <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
                                                              <option value="Slovenia">Slovenia</option>
                                                              <option value="Solomon Islands">Solomon Islands</option>
                                                              <option value="Somalia">Somalia</option>
                                                              <option value="South Africa">South Africa</option>
                                                              <option value="South Sudan">South Sudan</option>
                                                              <option value="Spain">Spain</option>
                                                              <option value="Sri Lanka">Sri Lanka</option>
                                                              <option value="Sudan">Sudan</option>
                                                              <option value="Suriname">Suriname</option>
                                                              <option value="Swaziland">Swaziland</option>
                                                              <option value="Sweden">Sweden</option>
                                                              <option value="Switzerland">Switzerland</option>
                                                              <option value="Syria, Syrian Arab Republic">Syria, Syrian Arab Republic</option>
                                                              <option value="Taiwan (Republic of China)">Taiwan (Republic of China)</option>
                                                              <option value="Tajikistan">Tajikistan</option>
                                                              <option value="Tanzania; officially the United Republic of Tanzania">Tanzania; officially the United Republic of Tanzania</option>
                                                              <option value="Thailand">Thailand</option>
                                                              <option value="Tibet">Tibet</option>
                                                              <option value="Timor-Leste (East Timor)">Timor-Leste (East Timor)</option>
                                                              <option value="Togo">Togo</option>
                                                              <option value="Tokelau">Tokelau</option>
                                                              <option value="Tonga">Tonga</option>
                                                              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                              <option value="Tunisia">Tunisia</option>
                                                              <option value="Turkey">Turkey</option>
                                                              <option value="Turkmenistan">Turkmenistan</option>
                                                              <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                              <option value="Tuvalu">Tuvalu</option>
                                                              <option value="Uganda">Uganda</option>
                                                              <option value="Ukraine">Ukraine</option>
                                                              <option value="United Arab Emirates">United Arab Emirates</option>
                                                              <option value="United Kingdom">United Kingdom</option>
                                                              <option value="United States">United States</option>
                                                              <option value="Uruguay">Uruguay</option>
                                                              <option value="Uzbekistan">Uzbekistan</option>
                                                              <option value="Vanuatu">Vanuatu</option>
                                                              <option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                                                              <option value="Venezuela">Venezuela</option>
                                                              <option value="Vietnam">Vietnam</option>
                                                              <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                                              <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                                              <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                                                              <option value="Western Sahara">Western Sahara</option>
                                                              <option value="Yemen">Yemen</option>
                                                              <option value="Zambia">Zambia</option>
                                                              <option value="Zimbabwe">Zimbabwe</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="c-validation"></div>
                                          </div>
                                      </div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-button-section">
                                      <div class="c-action"><button type="button" class="c-page-nav c-page-previous-page c-button">Back</button><button type="button" class="c-page-nav c-page-next-page c-button">Next</button></div>
                                  </div>
                                  <div class="c-page-numbering">3 / 4</div>
                              </div>
                          </div>
                      </div>
                      <div class="c-page-page4" style="display: none;">
                          <div class="c-forms-template" >
                              <div class="c-page toggle-off">
                                  <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                      <div class="c-title">
                                          <h3>Building Contract Payments</h3>
                                      </div>
                                      <div class="">
                                        <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-12">
                                          <div class="c-label  "><label for="c-58-1893">Contract Price </label></div>
                                          <div class="c-editor"><input value="{!!old('payment.price_i')!!}" name="payment[price_i]" type="text" id="c_price" placeholder=""></div>
                                          <div class="c-validation"></div>
                                      </div>
                                       <div class="c-choice-dropdown c-field c-col-13 c-sml-col-1 c-span-6 c-sml-span-12 c-modified">
                                              <div class="c-label  "><label for="c-55-1896">Foreign Currency</label></div>
                                              <div class="c-editor ">
                                                <div class="c-dropdown">
                                                   <select value="{!!old('payment.fc.name')!!}" name="payment[fc][name]" id="fc_name" class="c-placeholder-text-styled">
                                                      <option></option>
                                                      <option selected="selected" value="United States Dollar">United States Dollar</option>
                                                      <option value="Canadian Dollar">Canadian Dollar</option>
                                                      <option value="Pound Sterling">Pound Sterling</option>
                                                   </select>
                                               </div>
                                           </div>

                                           <div class="c-validation"></div>
                                       </div>

                                       <div class="c-text-singleline c-field c-col-13 c-sml-col-1 c-span-6 c-sml-span-6">
                                          <div class="c-label  "><label for="c-56-1895">FX Symbol</label></div>
                                          <div class="c-editor"><input value="{!!old('payment.fc.symbol')!!}" name="payment[fc][symbol]" type="text" id="fc_symbol" placeholder=""></div>
                                          <div class="c-validation"></div>
                                      </div>
                                      <div class="c-text-singleline c-field c-col-19 c-sml-col-7 c-span-6 c-sml-span-6">
                                          <div class="c-label  "><label for="c-57-1894">FX Rate</label></div>
                                          <div class="c-editor"><input value="{!!old('payment.fc.rate')!!}" name="payment[fc][rate]" type="text" id="fc_rate" placeholder=""></div>
                                          <div class="c-validation"></div>
                                      </div>
                                      

                                          <div class="c-text-singleline c-field c-col-7 c-sml-col-1 c-span-12 c-sml-span-12">
                                              <div class="c-label"><label for="c-60-1891">Contract Price Jamaican</label></div>
                                              <div class="c-editor float-right" style="width: 165px"><input value="{!!old('payment.jprice_i')!!}" name="payment[jprice_i]" type="text" id="c_pricej" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>

                                          <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                              <div class="c-label  "><label for="c-62-1889">Contract Deposit Payment</label></div>
                                              <div class="c-editor float-right" style="width: 165px"><input value="{!!old('payment.deposit')!!}" name="payment[deposit]" type="text" id="cp_deposit" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                              <div class="c-label  "><label for="c-63-1888">Contract Second Payment</label></div>
                                              <div class="c-editor float-right" style="width: 165px"><input value="{!!old('payment.second_pay')!!}" name="payment[second_pay]" type="text" id="cp_second" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                              <div class="c-label  "><label for="c-64-1887">Contract Third Payment</label></div>
                                              <div class="c-editor float-right" style="width: 165px"><input value="{!!old('payment.third_pay')!!}" name="payment[third_pay]" type="text" id="cp_third" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                              <div class="c-label  "><label for="c-65-1886">Contract Fourth Payment</label></div>
                                              <div class="c-editor float-right" style="width: 165px"><input value="{!!old('payment.fourth_pay')!!}" name="payment[fourth_pay]" type="text" id="cp_fourth" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                              <div class="c-label  "><label for="c-66-1885">Contract Final Payment</label></div>
                                              <div class="c-editor float-right" style="width: 165px"><input value="{!!old('payment.final_pay')!!}" name="payment[final_pay]" type="text" id="cp_final" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                      </div>
                                      <div class="c-validation"></div>
                                  </div>
                              </div>

                              <div id="c-recaptcha-div"></div>
                              <div class="c-forms-error">
                                  <div class="c-validation"></div>
                              </div>
                              <div class="c-button-section">
                                  <div class="c-action"><button type="button" class="c-page-nav c-page-previous-page c-button">Back</button>
                                    <button class="c-button" type="submit" ">Submit
                                      <i id="gear-sub" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>
                                    </button>
                                  </div>
                              </div>
                              <div class="c-page-numbering" >4 / 4</div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </form>   
</div>
<script type="text/javascript">
  
</script>
@stop