@extends('layouts.default')
@section('content')
<div id="c-forms-container" class="cognito c-safari c-lrg">

<form id="form" method="post" action="{{url('property')}}">
  {{ csrf_field() }}
  <div class="c-forms-form" tabindex="0">
    <div class="c-editor" style="display:none;">
      <input type="text" class="c-forms-form-style">
    </div>
    <div class="c-forms-form-body">
        <div class="c-forms-heading">
            <div class="c-forms-logo" style="display:none;"></div>
            <div class="c-forms-form-title">
                <h2>HMF Property Transfer Data Collection Form</h2>
            </div>
        </div>
        <div class="c-forms-form-main c-span-24 c-sml-span-12">
            <div class="c-progress-section">
                <div class="c-forms-progress c-progress-steps">
                    <ol class="">
                        <li class="c-page-selected" data-page="1"><span>Page 1</span></li>
                        <li class="" data-page="2"><span>Page 2</span></li>
                        <li class="" data-page="3"><span>Page 3</span></li>
                        <li class="" data-page="4"><span>Page 4</span></li>
                        <li class="" data-page="5"><span>Page 5</span></li>
                    </ol>
                </div>
            </div>
            <div class="c-forms-pages" style="">
                <div class="c-page-page1" style="">
                    <div class="c-forms-template">
                        <div class="c-page toggle-on" style="display: block;">
                            <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                <div class="c-title">
                                    <h3>Property Details</h3>
                                </div>
                                <div class="">
                                    <div class="c-text-singleline c-field c-col-12 c-sml-col-1 c-span-7 c-sml-span-12">
                                        <div class="c-label  "><label for="c-2-768">Volume/Folio No</label></div>
                                        <div class="c-editor"><input name="property[folio_no]" type="text" id="c-2-768" placeholder=""></div>
                                        <div class="c-validation"></div>
                                    </div>

                                    <div style="margin-top: 13px;" class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-5 c-sml-span-6">
                                    <button type="button" class="c-button" onclick="onClickFolio()">Fetch Record
                                          <i id="gear-folio" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>
                                    </button>
                                    </div>

                                    <div  id="c-message-folio" class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-8 c-sml-span-6">

                                    </div>

                                    <div class="c-text c-field c-col-1 c-sml-col-1 c-span-7 c-sml-span-12">
                                        <div class="c-label  "><label for="c-0-770">Lot No</label></div>
                                        <div class="c-editor"><input name="property[lot_no]" type="text" id="c-0-770" placeholder=""></div>
                                        <div class="c-validation"></div>
                                    </div>
                                    
                                    <div style="margin-top: 13px;" class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-5 c-sml-span-6">
                                    <button type="button" class="c-button" onclick="onClickLot()">Fetch Record
                                          <i id="gear-lot" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>
                                    </button>
                                    </div>

                                    <div  id="c-message-lot" class="c-text-singleline c-field c-col-21 c-sml-col-5 c-span-8 c-sml-span-6">

                                    </div>


                                    {{-- <div class="c-text-singleline c-field c-col-6 c-sml-col-6 c-span-6 c-sml-span-7">
                                        <div class="c-label  "><label for="c-1-769">Volume No</label></div>
                                        <div class="c-editor"><input name="property[volume_no]" type="text" id="c-1-769" placeholder=""></div>
                                        <div class="c-validation"></div>
                                    </div> --}}
                                    
                                    <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-12">
                                        <div class="c-label  "><label for="c-3-767">Plan No</label></div>
                                        <div class="c-editor"><input name="property[plan_no]" type="text" id="c-3-767" placeholder=""></div>
                                        <div class="c-validation"></div>
                                    </div>


                                    <div class="c-address c-address-international c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                        <div class="c-label "><label>Property Address</label></div>
                                        <div>
                                            <div class="c-offscreen"><label for="c-4-528">Address Line 1</label></div>
                                            <div class="c-editor" style="float: left;"><input name="property[address][line1]" type="text" id="c-4-528" placeholder="Address Line 1"></div>
                                            <div class="c-offscreen"><label for="c-5-528">Address Line 2</label></div>
                                            <div class="c-editor" style="float: left;"><input name="property[address][line2]" type="text" id="c-5-528" placeholder="Address Line 2"></div>
                                            <div class="c-offscreen"><label for="c-6-528">City</label></div>
                                            <div class="c-editor c-partial-line" style="float: left;"><input name="property[address][city]" type="text" id="c-6-528" placeholder="City"></div>
                                            <div class="c-offscreen"><label for="c-7-528">State / Province / Region</label></div>
                                            <div class="c-editor c-partial-line" style="float: left;"><input name="property[address][state]" type="text" id="c-7-528" placeholder="State / Province / Region"></div>
                                            <div class="c-offscreen"><label for="c-8-528">Postal / Zip Code</label></div>
                                            <div class="c-editor c-partial-line" style="float: left;"><input name="property[address][postal]" type="text" id="c-8-528" placeholder="Postal / Zip Code"></div>
                                            <div class="c-offscreen"><label for="c-9-528">Country</label></div>
                                            <div class="c-editor c-partial-line" style="float: left;">
                                                <div class="c-dropdown">
                                                    <select name="property[address][country]" id="c-9-528" class="c-placeholder-text-styled">
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
                                                        <option value="Jamaica">Jamaica</option>
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
                                <div class="c-action"><button type="button" class="c-page-nav c-page-next-page c-button">Next</button></div>
                            </div>
                            <div class="c-page-numbering">1 / 5</div>
                        </div>
                    </div>
                </div>
                <div class="c-page-page2" style="display: none;">
                    <div class="c-forms-template">
                      <div class="c-page toggle-off">
                          <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                              <div class="c-title">
                                  <h3>DEVELOPER / VENDOR</h3>
                              </div>
                              <div class="">
                                  <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                      <div class="c-label  "><label for="c-11-1027">Company Name</label></div>
                                      <div class="c-editor"><input name="vendor[company_name]" type="text" id="c-11-1027" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                      <div class="c-title c-repeating-section-title">
                                          <h4>Individual Vendor Details</h4>
                                      </div>
                                      <div class="c-repeating-section-group">
                                          <div class="c-repeating-section-container">
                                              <div class="c-repeating-section-item-title">
                                                  <div class="c-action-col"><a class="c-remove-item" title="Remove Vendor"><i class="icon-remove-sign"></i></a></div>
                                                  <h5>Vendor <span>1</span></h5>
                                              </div>
                                              <div class="c-repeating-section-item">
                                                  <div class="c-name c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                                      <div class="c-label "><label>Name</label></div>
                                                      <div>
                                                          <div class="c-offscreen"><label for="c-12-1026">First</label></div>
                                                          <div class="c-editor c-span-1" style="width: 28.5714%; float: left;"><input name="vendor[first][]" na type="text" id="c-12-1026" placeholder="First"></div>
                                                          <div class="c-offscreen"><label for="c-13-1026">Middle</label></div>
                                                          <div class="c-editor c-span-1" style="width: 28.5714%; float: left;"><input name="vendor[middle][]" type="text" id="c-13-1026" placeholder="Middle"></div>
                                                          <div class="c-offscreen"><label for="c-14-1026">Last</label></div>
                                                          <div class="c-editor c-span-1" style="width: 28.5714%; float: left;"><input name="vendor[last][]" type="text" id="c-14-1026" placeholder="Last"></div>
                                                          <div class="c-offscreen"><label for="c-15-1026">Suffix</label></div>
                                                          <div class="c-editor c-span-1" style="width: 14.2857%; float: left;"><input name="vendor[suffix][]" type="text" id="c-15-1026" placeholder="Suffix"></div>
                                                      </div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-7">
                                                      <div class="c-label  "><label for="c-17-1025">TRN No.</label></div>
                                                      <div class="c-editor"><input name="vendor[trn_no][]" type="text" id="c-17-1025" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-date-date c-field c-col-7 c-sml-col-7 c-span-6 c-sml-span-5">
                                                      <div class="c-label  "><label for="c-18-1024">Date of Birth</label></div>
                                                      <div class="c-editor">
                                                        <div class="input-group date c-editor-date c-datepicker" >
                                                          <input class="datepicker" name="vendor[dob][]" type="text" id="c-6-252"placeholder="" >
                                                        </div>
                                                        <div class="c-editor-date-icon input-group-addon"><i class="icon-calendar"></i></div>
                                                      </div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-text-singleline c-field c-col-11 c-sml-col-1 c-span-12 c-sml-span-12">
                                                      <div class="c-label  "><label for="c-19-1023">Occupation</label></div>
                                                      <div class="c-editor"><input name="vendor[occupation][]" type="text" id="c-19-1023" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-phone c-phone-international c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-6">
                                                      <div class="c-label  "><label for="c-20-1022">Office Phone</label></div>
                                                      <div class="c-editor"><input name="vendor[phone][]" type="text" id="c-20-1022" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-phone c-phone-international c-field c-col-7 c-sml-col-7 c-span-6 c-sml-span-6">
                                                      <div class="c-label  "><label for="c-21-1021">Mobile Phone</label></div>
                                                      <div class="c-editor"><input name="vendor[mobile][]" type="text" id="c-21-1021" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-phone c-phone-international c-field c-col-13 c-sml-col-1 c-span-12 c-sml-span-12">
                                                      <div class="c-label  "><label for="c-22-1020">Email</label></div>
                                                      <div class="c-editor"><input name="vendor[email][]" type="text" id="c-22-1020" placeholder=""></div>
                                                      <div class="c-validation"></div>
                                                  </div>
                                                  <div class="c-address c-address-international c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                                      <div class="c-label "><label>Address</label></div>
                                                      <div>
                                                          <div class="c-offscreen"><label for="c-23-781">Address Line 1</label></div>
                                                          <div class="c-editor" style="float: left;"><input name="vendor[address][line1][]" type="text" id="c-23-781" placeholder="Address Line 1"></div>
                                                          <div class="c-offscreen"><label for="c-24-781">Address Line 2</label></div>
                                                          <div class="c-editor" style="float: left;"><input name="vendor[address][line2][]" type="text" id="c-24-781" placeholder="Address Line 2"></div>
                                                          <div class="c-offscreen"><label for="c-25-781">City</label></div>
                                                          <div class="c-editor c-partial-line" style="float: left;"><input name="vendor[address][city][]" type="text" id="c-25-781" placeholder="City"></div>
                                                          <div class="c-offscreen"><label for="c-26-781">State / Province / Region</label></div>
                                                          <div class="c-editor c-partial-line" style="float: left;"><input name="vendor[address][state][]" type="text" id="c-26-781" placeholder="State / Province / Region"></div>
                                                          <div class="c-offscreen"><label for="c-27-781">Postal / Zip Code</label></div>
                                                          <div class="c-editor c-partial-line" style="float: left;"><input name="vendor[address][postal][]" type="text" id="c-27-781" placeholder="Postal / Zip Code"></div>
                                                          <div class="c-offscreen"><label for="c-28-781">Country</label></div>
                                                          <div class="c-editor c-partial-line" style="float: left;">
                                                              <div class="c-dropdown">
                                                                  <select name="vendor[address][country][]" id="c-28-781" class="c-placeholder-text-styled">
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
                                                                      <option value="Jamaica">Jamaica</option>
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
                                          </div>
                                      </div>
                                      <div class="c-validation" style="display: block;"></div>
                                      <div class="c-repeating-section-add"><a class="c-add-item" title="Add" tabindex="0">Add Vendor</a></div>
                                  </div>
                              </div>
                              <div class="c-validation"></div>
                          </div>
                          <div class="c-button-section">
                              <div class="c-action"><button type="button" class="c-page-nav c-page-previous-page c-button">Back</button><button type="button" class="c-page-nav c-page-next-page c-button">Next</button></div>
                          </div>
                          <div class="c-page-numbering">2 / 5</div>
                      </div>
                  </div>
                </div>
                <div class="c-page-page3" style="display:none;">
                    <div class="c-forms-template">
                      <div class="c-page toggle-off">
                          <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                              <div class="c-title">
                                  <h3>Monetary Details</h3>
                              </div>
                              <div class="">
                                  <div class="c-choice-dropdown c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                      <div class="c-label  "><label for="c-30-1052">Foreign Currency</label></div>
                                      <div class="c-editor">
                                          <div class="c-dropdown ">
                                              <select name="monetary[fc][name]" id="c-30-1052">
                                                  <option></option>
                                                  <option selected="selected" value="United States Dollar">United States Dollar</option>
                                                  <option value="Canadian Dollar">Canadian Dollar</option>
                                                  <option value="Pound Sterling">Pound Sterling</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-text-singleline c-field c-col-13 c-sml-col-1 c-span-4 c-sml-span-4">
                                      <div class="c-label  "><label for="c-31-1051">Symbol</label></div>
                                      <div class="c-editor"><input name="monetary[fc][symbol]" type="text" id="c-31-1051" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-text-singleline c-field c-col-17 c-sml-col-5 c-span-8 c-sml-span-8">
                                      <div class="c-label  "><label for="c-32-1050">Exchange Rate</label></div>
                                      <div class="c-editor"><input name="monetary[fc][rate]" type="text" id="c-32-1050" placeholder="$119.45"></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-12">
                                      <div class="c-label  "><label for="c-33-1049">Sale Price in numerals</label></div>
                                      <div class="c-editor"><input name="monetary[price_i]" type="text" id="c-33-1049" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-text-singleline c-field c-col-7 c-sml-col-1 c-span-18 c-sml-span-12">
                                      <div class="c-label  "><label for="c-34-1048">Sale Price in words</label></div>
                                      <div class="c-editor"><input name="monetary[price_w]" type="text" id="c-34-1048" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-6 c-sml-span-12">
                                      <div class="c-label  "><label for="c-35-1047">Sale Price JAMAICAN  in numerals</label></div>
                                      <div class="c-editor"><input name="monetary[jprice_i]" type="text" id="c-35-1047" placeholder="j$"></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-text-singleline c-field c-col-7 c-sml-col-1 c-span-18 c-sml-span-12">
                                      <div class="c-label  "><label for="c-36-1046">Sale Price jamaican in words</label></div>
                                      <div class="c-editor"><input name="monetary[jprice_w]" type="text" id="c-36-1046" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-37-1045">Deposit</label></div>
                                      <div class="c-editor"><input name="monetary[deposit]" type="text" id="c-37-1045" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-9 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-38-1044">Second Payment</label></div>
                                      <div class="c-editor"><input name="monetary[second_pay]" type="text" id="c-38-1044" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-17 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-39-1043">Final Payment</label></div>
                                      <div class="c-editor"><input name="monetary[final_pay]" type="text" id="c-39-1043" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-40-1042">Half Title Cost</label></div>
                                      <div class="c-editor"><input name="monetary[half_title]" type="text" id="c-40-1042" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-9 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-41-1041">Half Agreement Cost</label></div>
                                      <div class="c-editor"><input name="monetary[half_agreement]" type="text" id="c-41-1041" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-17 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-42-1040">Half Stamp Duty</label></div>
                                      <div class="c-editor"><input name="monetary[half_stamp_duty]" type="text" id="c-42-1040" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-43-1039">Half Registration Fee</label></div>
                                      <div class="c-editor"><input name="monetary[half_reg_fee]" type="text" id="c-43-1039" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-9 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-44-1038">Incorporation Costs</label></div>
                                      <div class="c-editor"><input max="monetary[inc_cost]" type="text" id="c-44-1038" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-17 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-45-1037">Maintenance Expenses</label></div>
                                      <div class="c-editor"><input name="monetary[maintenance_expense]" type="text" id="c-45-1037" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-currency c-field c-col-1 c-sml-col-1 c-span-8 c-sml-span-12">
                                      <div class="c-label  "><label for="c-46-1036">Identification Fee</label></div>
                                      <div class="c-editor"><input name="monetary[identification_fee]" type="text" id="c-46-1036" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                              </div>
                              <div class="c-validation"></div>
                          </div>
                          <div class="c-button-section">
                              <div class="c-action"><button type="button" class="c-page-nav c-page-previous-page c-button">Back</button><button type="button" class="c-page-nav c-page-next-page c-button">Next</button></div>
                          </div>
                          <div class="c-page-numbering">3 / 5</div>
                      </div>
                  </div>
                </div>
                <div class="c-page-page4" style="display:none;">
                    <div class="c-forms-template">
                      <div class="c-page toggle-off">
                          <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                              <div class="c-title c-repeating-section-title">
                                  <h3>Purchasers Details</h3>
                              </div>
                              <div class="c-repeating-section-group">
                                  <div class="c-repeating-section-container">
                                      <div class="c-repeating-section-item-title">
                                          <div class="c-action-col"><a class="c-remove-item" title="Remove Item"><i class="icon-remove-sign"></i></a></div>
                                          <h4>Item <span>1</span></h4>
                                      </div>
                                      <div class="c-repeating-section-item">
                                          <div class="c-name c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                              <div class="c-label "><label>Name</label></div>
                                              <div>
                                                  <div class="c-offscreen"><label for="c-47-1307">First</label></div>
                                                  <div class="c-editor c-span-1" style="width: 28.5714%; float: left;"><input name="buyer[first][]" type="text" id="c-47-1307" placeholder="First"></div>
                                                  <div class="c-offscreen"><label for="c-48-1307">Middle</label></div>
                                                  <div class="c-editor c-span-1" style="width: 28.5714%; float: left;"><input name="buyer[middle][]" type="text" id="c-48-1307" placeholder="Middle"></div>
                                                  <div class="c-offscreen"><label for="c-49-1307">Last</label></div>
                                                  <div class="c-editor c-span-1" style="width: 28.5714%; float: left;"><input name="buyer[last][]" type="text" id="c-49-1307" placeholder="Last"></div>
                                                  <div class="c-offscreen"><label for="c-50-1307">Suffix</label></div>
                                                  <div class="c-editor c-span-1" style="width: 14.2857%; float: left;"><input name="buyer[suffix][]" type="text" id="c-50-1307" placeholder="Suffix"></div>
                                              </div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-4 c-sml-span-5">
                                              <div class="c-label  "><label for="c-52-1306">TRN</label></div>
                                              <div class="c-editor"><input name="buyer[trn_no][]" type="text" id="c-52-1306" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-date-date c-field c-col-5 c-sml-col-5 c-span-5 c-sml-span-7">
                                              <div class="c-label  "><label for="c-53-1305">Date of Birth</label></div>
                                              <div class="c-editor">
                                                <div class="input-group date c-editor-date c-datepicker" >
                                                  <input name="buyer[dob][]" class="datepicker" type="text" id="c-6-252"placeholder="" >
                                                </div>
                                                <div class="c-editor-date-icon input-group-addon"><i class="icon-calendar"></i></div>
                                              </div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-text-singleline c-field c-col-10 c-sml-col-1 c-span-5 c-sml-span-12">
                                              <div class="c-label  "><label for="c-54-1304">Occupation</label></div>
                                              <div class="c-editor"><input name="buyer[occupation][]" type="text" id="c-54-1304" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-text-singleline c-field c-col-15 c-sml-col-1 c-span-10 c-sml-span-12">
                                              <div class="c-label  "><label for="c-55-1303">Place of Business</label></div>
                                              <div class="c-editor"><input name="buyer[bussiness_place][]" type="text" id="c-55-1303" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-phone c-phone-international c-field c-col-1 c-sml-col-1 c-span-7 c-sml-span-12">
                                              <div class="c-label  "><label for="c-56-1302">Office Phone</label></div>
                                              <div class="c-editor"><input name="buyer[phone][]" type="text" id="c-56-1302" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-phone c-phone-international c-field c-col-8 c-sml-col-1 c-span-6 c-sml-span-12">
                                              <div class="c-label  "><label for="c-57-1301">Mobile Phone</label></div>
                                              <div class="c-editor"><input name="buyer[mobile][]" type="text" id="c-57-1301" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-email c-field c-col-14 c-sml-col-1 c-span-11 c-sml-span-12">
                                              <div class="c-label  "><label for="c-58-1300">Email</label></div>
                                              <div class="c-editor"><input name="buyer[email][]" type="text" id="c-58-1300" placeholder=""></div>
                                              <div class="c-validation"></div>
                                          </div>
                                          <div class="c-address c-address-international c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                              <div class="c-label "><label>Home Address</label></div>
                                              <div>
                                                  <div class="c-offscreen"><label for="c-59-1061">Address Line 1</label></div>
                                                  <div class="c-editor" style="float: left;"><input name="buyer[address][line1][]" type="text" id="c-59-1061" placeholder="Address Line 1"></div>
                                                  <div class="c-offscreen"><label for="c-60-1061">Address Line 2</label></div>
                                                  <div class="c-editor" style="float: left;"><input name="buyer[address][line2][]" type="text" id="c-60-1061" placeholder="Address Line 2"></div>
                                                  <div class="c-offscreen"><label for="c-61-1061">City</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;"><input name="buyer[address][city][]" type="text" id="c-61-1061" placeholder="City"></div>
                                                  <div class="c-offscreen"><label for="c-62-1061">State / Province / Region</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;"><input name="buyer[address][state][]" type="text" id="c-62-1061" placeholder="State / Province / Region"></div>
                                                  <div class="c-offscreen"><label for="c-63-1061">Postal / Zip Code</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;"><input name="buyer[address][postal][]" type="text" id="c-63-1061" placeholder="Postal / Zip Code"></div>
                                                  <div class="c-offscreen"><label for="c-64-1061">Country</label></div>
                                                  <div class="c-editor c-partial-line" style="float: left;">
                                                      <div class="c-dropdown">
                                                          <select name="buyer[address][country][]" id="c-64-1061" class="c-placeholder-text-styled">
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
                                                              <option value="Jamaica">Jamaica</option>
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
                                  </div>
                              </div>
                              <div class="c-validation" style="display: block;"></div>
                              <div class="c-repeating-section-add"><a class="c-add-item" title="Add" tabindex="0">Add Item</a></div>
                          </div>
                          <div class="c-button-section">
                              <div class="c-action"><button type="button" class="c-page-nav c-page-previous-page c-button">Back</button><button type="button" class="c-page-nav c-page-next-page c-button">Next</button></div>
                          </div>
                          <div class="c-page-numbering">4 / 5</div>
                      </div>
                  </div>
                </div>
                <div class="c-page-page5" style="display:none;">
                  <div class="c-forms-template">
                      <div class="c-page toggle-off" >
                          <div class="c-section c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                              <div class="c-title">
                                  <h3>Purchaser ATTORNEY Details</h3>
                              </div>
                              <div class="">
                                  <div class="c-text-singleline c-field c-col-1 c-sml-col-1 c-span-12 c-sml-span-12">
                                      <div class="c-label  "><label for="c-66-1556">Attorney Firm Name</label></div>
                                      <div class="c-editor"><input name="attorney[firm_name]" type="text" id="c-66-1556" placeholder=""></div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-name c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                      <div class="c-label "><label>Name of Principal Attorney Assigned </label></div>
                                      <div>
                                          <div class="c-offscreen"><label for="c-67-1555">Title</label></div>
                                          <div class="c-editor c-span-1" style="width: 20%; float: left;"><input name="attorney[pa][title]" type="text" id="c-67-1555" placeholder="Title"></div>
                                          <div class="c-offscreen"><label for="c-68-1555">First</label></div>
                                          <div class="c-editor c-span-1" style="width: 40%; float: left;"><input name="attorney[pa][first]" type="text" id="c-68-1555" placeholder="First"></div>
                                          <div class="c-offscreen"><label for="c-69-1555">Last</label></div>
                                          <div class="c-editor c-span-1" style="width: 40%; float: left;"><input name="attorney[pa][last]" type="text" id="c-69-1555" placeholder="Last"></div>
                                      </div>
                                      <div class="c-validation"></div>
                                  </div>
                                  <div class="c-address c-address-international c-field c-col-1 c-sml-col-1 c-span-24 c-sml-span-12">
                                      <div class="c-label "><label>Address</label></div>
                                      <div>
                                          <div class="c-offscreen"><label for="c-71-1316">Address Line 1</label></div>
                                          <div class="c-editor" style="float: left;"><input name="attorney[address][line1]" type="text" id="c-71-1316" placeholder="Address Line 1"></div>
                                          <div class="c-offscreen"><label for="c-72-1316">Address Line 2</label></div>
                                          <div class="c-editor" style="float: left;"><input name="attorney[address][line2]" type="text" id="c-72-1316" placeholder="Address Line 2"></div>
                                          <div class="c-offscreen"><label for="c-73-1316">City</label></div>
                                          <div class="c-editor c-partial-line" style="float: left;"><input name="attorney[address][city]" type="text" id="c-73-1316" placeholder="City"></div>
                                          <div class="c-offscreen"><label for="c-74-1316">State / Province / Region</label></div>
                                          <div class="c-editor c-partial-line" style="float: left;"><input name="attorney[address][state]" type="text" id="c-74-1316" placeholder="State / Province / Region"></div>
                                          <div class="c-offscreen"><label for="c-75-1316">Postal / Zip Code</label></div>
                                          <div class="c-editor c-partial-line" style="float: left;"><input name="attorney[address][postal]" type="text" id="c-75-1316" placeholder="Postal / Zip Code"></div>
                                          <div class="c-offscreen"><label for="c-76-1316">Country</label></div>
                                          <div class="c-editor c-partial-line" style="float: left;">
                                              <div class="c-dropdown">
                                                  <select name="attorney[address][country]" id="c-76-1316" class="c-placeholder-text-styled">
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
                                                      <option value="Jamaica">Jamaica</option>
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
                      </div>
                  </div>
                  <div id="c-recaptcha-div"></div>
                  <div class="c-forms-error">
                      <div class="c-validation"></div>
                  </div>
                  <div class="c-button-section">
                      <div class="c-action"><button type="button" class="c-page-nav c-page-previous-page c-button">Back</button><button class="c-button" id="c-submit-button">Submit
                      <i id="gear-sub" style="display: none;" class="fa fa-gear fa-spin" style="font-size:15px"></i>
                      </button></div>
                  </div>
                  <div class="c-page-numbering">5 / 5</div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <input type="hidden" name="NoBots" id="c-nobots" value="Cpy9xdA3AeD6VuOZlzI7hF0cp+PxKQSFxbZWuPsDiNw=|8d3d2b1992a1961cb6d21eeaaf4a761b">
</form>
</div>
@stop
