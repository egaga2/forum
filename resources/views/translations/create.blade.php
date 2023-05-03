@extends('layouts.app')

@section('content')

@section('content_header', 'create translation')
<div class="contact-area">
    <div class="container">
        <!-- box -->
        <div class="row">

            <!-- col -->
            <div class="col-md-12">

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
            @endif
            <!-- general form elements -->
                <div class="box normal-table-list">
                    <ol class="breadcrumb breadcrumb-alt push">
                        <li class="breadcrumb-item">
                            <a href="{{action('TranslationController@index')}}"><i class="notika-icon notika-edit"></i>
                                Language</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Language</li>
                    </ol>
                    <div class="row">
                        <div class="col-lg-3"><p class="text-muted">Translation Information</p></div>
                        <!-- form -->
                        <div class="col-lg-9">
                            <form method="POST" enctype="multipart/form-data" action="{{url('/admin/translations')}}">
                            @csrf @method('POST')
                            <!-- box-body -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Language <span class="text-danger">*</span></label>
                                        <input type="text" name="language" class="form-control"
                                               placeholder="ex: English"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Language code <span class="text-danger">*</span></label>
                                        <select id="code" class="form-control selectpicker" name="code"
                                                data-live-search="true">
                                            <option value="" label="Select a Language ... " selected="selected">Select a
                                                Language ...
                                            </option>
                                            <option value="af">Afrikaans</option>
                                            <option value="sq">Albanian - shqip</option>
                                            <option value="am">Amharic - አማርኛ</option>
                                            <option value="ar">Arabic - العربية</option>
                                            <option value="an">Aragonese - aragonés</option>
                                            <option value="hy">Armenian - հայերեն</option>
                                            <option value="ast">Asturian - asturianu</option>
                                            <option value="az">Azerbaijani - azərbaycan dili</option>
                                            <option value="eu">Basque - euskara</option>
                                            <option value="be">Belarusian - беларуская</option>
                                            <option value="bn">Bengali - বাংলা</option>
                                            <option value="bs">Bosnian - bosanski</option>
                                            <option value="br">Breton - brezhoneg</option>
                                            <option value="bg">Bulgarian - български</option>
                                            <option value="ca">Catalan - català</option>
                                            <option value="ckb">Central Kurdish - کوردی (دەستنوسی عەرەبی)</option>
                                            <option value="zh">Chinese - 中文</option>
                                            <option value="zh-HK">Chinese (Hong Kong) - 中文（香港）</option>
                                            <option value="zh-CN">Chinese (Simplified) - 中文（简体）</option>
                                            <option value="zh-TW">Chinese (Traditional) - 中文（繁體）</option>
                                            <option value="co">Corsican</option>
                                            <option value="hr">Croatian - hrvatski</option>
                                            <option value="cs">Czech - čeština</option>
                                            <option value="da">Danish - dansk</option>
                                            <option value="nl">Dutch - Nederlands</option>
                                            <option value="en">English</option>
                                            <option value="en-AU">English (Australia)</option>
                                            <option value="en-CA">English (Canada)</option>
                                            <option value="en-IN">English (India)</option>
                                            <option value="en-NZ">English (New Zealand)</option>
                                            <option value="en-ZA">English (South Africa)</option>
                                            <option value="en-GB">English (United Kingdom)</option>
                                            <option value="en-US">English (United States)</option>
                                            <option value="eo">Esperanto - esperanto</option>
                                            <option value="et">Estonian - eesti</option>
                                            <option value="fo">Faroese - føroyskt</option>
                                            <option value="fil">Filipino</option>
                                            <option value="fi">Finnish - suomi</option>
                                            <option value="fr">French - français</option>
                                            <option value="fr-CA">French (Canada) - français (Canada)</option>
                                            <option value="fr-FR">French (France) - français (France)</option>
                                            <option value="fr-CH">French (Switzerland) - français (Suisse)</option>
                                            <option value="gl">Galician - galego</option>
                                            <option value="ka">Georgian - ქართული</option>
                                            <option value="de">German - Deutsch</option>
                                            <option value="de-AT">German (Austria) - Deutsch (Österreich)</option>
                                            <option value="de-DE">German (Germany) - Deutsch (Deutschland)</option>
                                            <option value="de-LI">German (Liechtenstein) - Deutsch (Liechtenstein)
                                            </option>
                                            <option value="de-CH">German (Switzerland) - Deutsch (Schweiz)</option>
                                            <option value="el">Greek - Ελληνικά</option>
                                            <option value="gn">Guarani</option>
                                            <option value="gu">Gujarati - ગુજરાતી</option>
                                            <option value="ha">Hausa</option>
                                            <option value="haw">Hawaiian - ʻŌlelo Hawaiʻi</option>
                                            <option value="he">Hebrew - עברית</option>
                                            <option value="hi">Hindi - हिन्दी</option>
                                            <option value="hu">Hungarian - magyar</option>
                                            <option value="is">Icelandic - íslenska</option>
                                            <option value="id">Indonesian - Indonesia</option>
                                            <option value="ia">Interlingua</option>
                                            <option value="ga">Irish - Gaeilge</option>
                                            <option value="it">Italian - italiano</option>
                                            <option value="it-IT">Italian (Italy) - italiano (Italia)</option>
                                            <option value="it-CH">Italian (Switzerland) - italiano (Svizzera)</option>
                                            <option value="ja">Japanese - 日本語</option>
                                            <option value="kn">Kannada - ಕನ್ನಡ</option>
                                            <option value="kk">Kazakh - қазақ тілі</option>
                                            <option value="km">Khmer - ខ្មែរ</option>
                                            <option value="ko">Korean - 한국어</option>
                                            <option value="ku">Kurdish - Kurdî</option>
                                            <option value="ky">Kyrgyz - кыргызча</option>
                                            <option value="lo">Lao - ລາວ</option>
                                            <option value="la">Latin</option>
                                            <option value="lv">Latvian - latviešu</option>
                                            <option value="ln">Lingala - lingála</option>
                                            <option value="lt">Lithuanian - lietuvių</option>
                                            <option value="mk">Macedonian - македонски</option>
                                            <option value="ms">Malay - Bahasa Melayu</option>
                                            <option value="ml">Malayalam - മലയാളം</option>
                                            <option value="mt">Maltese - Malti</option>
                                            <option value="mr">Marathi - मराठी</option>
                                            <option value="mn">Mongolian - монгол</option>
                                            <option value="ne">Nepali - नेपाली</option>
                                            <option value="no">Norwegian - norsk</option>
                                            <option value="nb">Norwegian Bokmål - norsk bokmål</option>
                                            <option value="nn">Norwegian Nynorsk - nynorsk</option>
                                            <option value="oc">Occitan</option>
                                            <option value="or">Oriya - ଓଡ଼ିଆ</option>
                                            <option value="om">Oromo - Oromoo</option>
                                            <option value="ps">Pashto - پښتو</option>
                                            <option value="fa">Persian - فارسی</option>
                                            <option value="pl">Polish - polski</option>
                                            <option value="pt">Portuguese - português</option>
                                            <option value="pt-BR">Portuguese (Brazil) - português (Brasil)</option>
                                            <option value="pt-PT">Portuguese (Portugal) - português (Portugal)</option>
                                            <option value="pa">Punjabi - ਪੰਜਾਬੀ</option>
                                            <option value="qu">Quechua</option>
                                            <option value="ro">Romanian - română</option>
                                            <option value="mo">Romanian (Moldova) - română (Moldova)</option>
                                            <option value="rm">Romansh - rumantsch</option>
                                            <option value="ru">Russian - русский</option>
                                            <option value="gd">Scottish Gaelic</option>
                                            <option value="sr">Serbian - српски</option>
                                            <option value="sh">Serbo-Croatian - Srpskohrvatski</option>
                                            <option value="sn">Shona - chiShona</option>
                                            <option value="sd">Sindhi</option>
                                            <option value="si">Sinhala - සිංහල</option>
                                            <option value="sk">Slovak - slovenčina</option>
                                            <option value="sl">Slovenian - slovenščina</option>
                                            <option value="so">Somali - Soomaali</option>
                                            <option value="st">Southern Sotho</option>
                                            <option value="es">Spanish - español</option>
                                            <option value="es-AR">Spanish (Argentina) - español (Argentina)</option>
                                            <option value="es-419">Spanish (Latin America) - español (Latinoamérica)
                                            </option>
                                            <option value="es-MX">Spanish (Mexico) - español (México)</option>
                                            <option value="es-ES">Spanish (Spain) - español (España)</option>
                                            <option value="es-US">Spanish (United States) - español (Estados Unidos)
                                            </option>
                                            <option value="su">Sundanese</option>
                                            <option value="sw">Swahili - Kiswahili</option>
                                            <option value="sv">Swedish - svenska</option>
                                            <option value="tg">Tajik - тоҷикӣ</option>
                                            <option value="ta">Tamil - தமிழ்</option>
                                            <option value="tt">Tatar</option>
                                            <option value="te">Telugu - తెలుగు</option>
                                            <option value="th">Thai - ไทย</option>
                                            <option value="ti">Tigrinya - ትግርኛ</option>
                                            <option value="to">Tongan - lea fakatonga</option>
                                            <option value="tr">Turkish - Türkçe</option>
                                            <option value="tk">Turkmen</option>
                                            <option value="tw">Twi</option>
                                            <option value="uk">Ukrainian - українська</option>
                                            <option value="ur">Urdu - اردو</option>
                                            <option value="ug">Uyghur</option>
                                            <option value="uz">Uzbek - o‘zbek</option>
                                            <option value="vi">Vietnamese - Tiếng Việt</option>
                                            <option value="wa">Walloon - wa</option>
                                            <option value="cy">Welsh - Cymraeg</option>
                                            <option value="fy">Western Frisian</option>
                                            <option value="xh">Xhosa</option>
                                            <option value="yi">Yiddish</option>
                                            <option value="yo">Yoruba - Èdè Yorùbá</option>
                                            <option value="zu">Zulu - isiZulu</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Country <span class="text-danger">*</span></label>
                                        <select name="locale_code" class="form-control selectpicker" id="country"
                                                data-live-search="true">
                                            <option value="" label="Select a country ... " selected="selected">Select a
                                                country ...
                                            </option>
                                            <optgroup id="country-optgroup-Africa" label="Africa">
                                                <option value="DZ" label="Algeria">Algeria</option>
                                                <option value="AO" label="Angola">Angola</option>
                                                <option value="BJ" label="Benin">Benin</option>
                                                <option value="BW" label="Botswana">Botswana</option>
                                                <option value="BF" label="Burkina Faso">Burkina Faso</option>
                                                <option value="BI" label="Burundi">Burundi</option>
                                                <option value="CM" label="Cameroon">Cameroon</option>
                                                <option value="CV" label="Cape Verde">Cape Verde</option>
                                                <option value="CF" label="Central African Republic">Central African
                                                    Republic
                                                </option>
                                                <option value="TD" label="Chad">Chad</option>
                                                <option value="KM" label="Comoros">Comoros</option>
                                                <option value="CG" label="Congo - Brazzaville">Congo - Brazzaville
                                                </option>
                                                <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                                                <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                                                <option value="DJ" label="Djibouti">Djibouti</option>
                                                <option value="EG" label="Egypt">Egypt</option>
                                                <option value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="ER" label="Eritrea">Eritrea</option>
                                                <option value="ET" label="Ethiopia">Ethiopia</option>
                                                <option value="GA" label="Gabon">Gabon</option>
                                                <option value="GM" label="Gambia">Gambia</option>
                                                <option value="GH" label="Ghana">Ghana</option>
                                                <option value="GN" label="Guinea">Guinea</option>
                                                <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                                                <option value="KE" label="Kenya">Kenya</option>
                                                <option value="LS" label="Lesotho">Lesotho</option>
                                                <option value="LR" label="Liberia">Liberia</option>
                                                <option value="LY" label="Libya">Libya</option>
                                                <option value="MG" label="Madagascar">Madagascar</option>
                                                <option value="MW" label="Malawi">Malawi</option>
                                                <option value="ML" label="Mali">Mali</option>
                                                <option value="MR" label="Mauritania">Mauritania</option>
                                                <option value="MU" label="Mauritius">Mauritius</option>
                                                <option value="YT" label="Mayotte">Mayotte</option>
                                                <option value="MA" label="Morocco">Morocco</option>
                                                <option value="MZ" label="Mozambique">Mozambique</option>
                                                <option value="NA" label="Namibia">Namibia</option>
                                                <option value="NE" label="Niger">Niger</option>
                                                <option value="NG" label="Nigeria">Nigeria</option>
                                                <option value="RW" label="Rwanda">Rwanda</option>
                                                <option value="RE" label="Réunion">Réunion</option>
                                                <option value="SH" label="Saint Helena">Saint Helena</option>
                                                <option value="SN" label="Senegal">Senegal</option>
                                                <option value="SC" label="Seychelles">Seychelles</option>
                                                <option value="SL" label="Sierra Leone">Sierra Leone</option>
                                                <option value="SO" label="Somalia">Somalia</option>
                                                <option value="ZA" label="South Africa">South Africa</option>
                                                <option value="SD" label="Sudan">Sudan</option>
                                                <option value="SZ" label="Swaziland">Swaziland</option>
                                                <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe
                                                </option>
                                                <option value="TZ" label="Tanzania">Tanzania</option>
                                                <option value="TG" label="Togo">Togo</option>
                                                <option value="TN" label="Tunisia">Tunisia</option>
                                                <option value="UG" label="Uganda">Uganda</option>
                                                <option value="EH" label="Western Sahara">Western Sahara</option>
                                                <option value="ZM" label="Zambia">Zambia</option>
                                                <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                                            </optgroup>
                                            <optgroup id="country-optgroup-Americas" label="Americas">
                                                <option value="AI" label="Anguilla">Anguilla</option>
                                                <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda
                                                </option>
                                                <option value="AR" label="Argentina">Argentina</option>
                                                <option value="AW" label="Aruba">Aruba</option>
                                                <option value="BS" label="Bahamas">Bahamas</option>
                                                <option value="BB" label="Barbados">Barbados</option>
                                                <option value="BZ" label="Belize">Belize</option>
                                                <option value="BM" label="Bermuda">Bermuda</option>
                                                <option value="BO" label="Bolivia">Bolivia</option>
                                                <option value="BR" label="Brazil">Brazil</option>
                                                <option value="VG" label="British Virgin Islands">British Virgin
                                                    Islands
                                                </option>
                                                <option value="CA" label="Canada">Canada</option>
                                                <option value="KY" label="Cayman Islands">Cayman Islands</option>
                                                <option value="CL" label="Chile">Chile</option>
                                                <option value="CO" label="Colombia">Colombia</option>
                                                <option value="CR" label="Costa Rica">Costa Rica</option>
                                                <option value="CU" label="Cuba">Cuba</option>
                                                <option value="DM" label="Dominica">Dominica</option>
                                                <option value="DO" label="Dominican Republic">Dominican Republic
                                                </option>
                                                <option value="EC" label="Ecuador">Ecuador</option>
                                                <option value="SV" label="El Salvador">El Salvador</option>
                                                <option value="FK" label="Falkland Islands">Falkland Islands</option>
                                                <option value="GF" label="French Guiana">French Guiana</option>
                                                <option value="GL" label="Greenland">Greenland</option>
                                                <option value="GD" label="Grenada">Grenada</option>
                                                <option value="GP" label="Guadeloupe">Guadeloupe</option>
                                                <option value="GT" label="Guatemala">Guatemala</option>
                                                <option value="GY" label="Guyana">Guyana</option>
                                                <option value="HT" label="Haiti">Haiti</option>
                                                <option value="HN" label="Honduras">Honduras</option>
                                                <option value="JM" label="Jamaica">Jamaica</option>
                                                <option value="MQ" label="Martinique">Martinique</option>
                                                <option value="MX" label="Mexico">Mexico</option>
                                                <option value="MS" label="Montserrat">Montserrat</option>
                                                <option value="AN" label="Netherlands Antilles">Netherlands Antilles
                                                </option>
                                                <option value="NI" label="Nicaragua">Nicaragua</option>
                                                <option value="PA" label="Panama">Panama</option>
                                                <option value="PY" label="Paraguay">Paraguay</option>
                                                <option value="PE" label="Peru">Peru</option>
                                                <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                                <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                                <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis
                                                </option>
                                                <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                                <option value="MF" label="Saint Martin">Saint Martin</option>
                                                <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and
                                                    Miquelon
                                                </option>
                                                <option value="VC" label="Saint Vincent and the Grenadines">Saint
                                                    Vincent and the Grenadines
                                                </option>
                                                <option value="SR" label="Suriname">Suriname</option>
                                                <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago
                                                </option>
                                                <option value="TC" label="Turks and Caicos Islands">Turks and Caicos
                                                    Islands
                                                </option>
                                                <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands
                                                </option>
                                                <option value="US" label="United States">United States</option>
                                                <option value="UY" label="Uruguay">Uruguay</option>
                                                <option value="VE" label="Venezuela">Venezuela</option>
                                            </optgroup>
                                            <optgroup id="country-optgroup-Asia" label="Asia">
                                                <option value="AF" label="Afghanistan">Afghanistan</option>
                                                <option value="AM" label="Armenia">Armenia</option>
                                                <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                                <option value="BH" label="Bahrain">Bahrain</option>
                                                <option value="BD" label="Bangladesh">Bangladesh</option>
                                                <option value="BT" label="Bhutan">Bhutan</option>
                                                <option value="BN" label="Brunei">Brunei</option>
                                                <option value="KH" label="Cambodia">Cambodia</option>
                                                <option value="CN" label="China">China</option>
                                                <option value="CY" label="Cyprus">Cyprus</option>
                                                <option value="GE" label="Georgia">Georgia</option>
                                                <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China
                                                </option>
                                                <option value="IN" label="India">India</option>
                                                <option value="ID" label="Indonesia">Indonesia</option>
                                                <option value="IR" label="Iran">Iran</option>
                                                <option value="IQ" label="Iraq">Iraq</option>
                                                <option value="IL" label="Israel">Israel</option>
                                                <option value="JP" label="Japan">Japan</option>
                                                <option value="JO" label="Jordan">Jordan</option>
                                                <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                                <option value="KW" label="Kuwait">Kuwait</option>
                                                <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="LA" label="Laos">Laos</option>
                                                <option value="LB" label="Lebanon">Lebanon</option>
                                                <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                                <option value="MY" label="Malaysia">Malaysia</option>
                                                <option value="MV" label="Maldives">Maldives</option>
                                                <option value="MN" label="Mongolia">Mongolia</option>
                                                <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                                <option value="NP" label="Nepal">Nepal</option>
                                                <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                                <option value="KP" label="North Korea">North Korea</option>
                                                <option value="OM" label="Oman">Oman</option>
                                                <option value="PK" label="Pakistan">Pakistan</option>
                                                <option value="PS" label="Palestinian Territories">Palestinian
                                                    Territories
                                                </option>
                                                <option value="YD" label="People's Democratic Republic of Yemen">
                                                    People's Democratic Republic of Yemen
                                                </option>
                                                <option value="PH" label="Philippines">Philippines</option>
                                                <option value="QA" label="Qatar">Qatar</option>
                                                <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                                <option value="SG" label="Singapore">Singapore</option>
                                                <option value="KR" label="South Korea">South Korea</option>
                                                <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                                <option value="SY" label="Syria">Syria</option>
                                                <option value="TW" label="Taiwan">Taiwan</option>
                                                <option value="TJ" label="Tajikistan">Tajikistan</option>
                                                <option value="TH" label="Thailand">Thailand</option>
                                                <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                                <option value="TR" label="Turkey">Turkey</option>
                                                <option value="TM" label="Turkmenistan">Turkmenistan</option>
                                                <option value="AE" label="United Arab Emirates">United Arab Emirates
                                                </option>
                                                <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                                <option value="VN" label="Vietnam">Vietnam</option>
                                                <option value="YE" label="Yemen">Yemen</option>
                                            </optgroup>
                                            <optgroup id="country-optgroup-Europe" label="Europe">
                                                <option value="AL" label="Albania">Albania</option>
                                                <option value="AD" label="Andorra">Andorra</option>
                                                <option value="AT" label="Austria">Austria</option>
                                                <option value="BY" label="Belarus">Belarus</option>
                                                <option value="BE" label="Belgium">Belgium</option>
                                                <option value="BA" label="Bosnia and Herzegovina">Bosnia and
                                                    Herzegovina
                                                </option>
                                                <option value="BG" label="Bulgaria">Bulgaria</option>
                                                <option value="HR" label="Croatia">Croatia</option>
                                                <option value="CY" label="Cyprus">Cyprus</option>
                                                <option value="CZ" label="Czech Republic">Czech Republic</option>
                                                <option value="DK" label="Denmark">Denmark</option>
                                                <option value="DD" label="East Germany">East Germany</option>
                                                <option value="EE" label="Estonia">Estonia</option>
                                                <option value="FO" label="Faroe Islands">Faroe Islands</option>
                                                <option value="FI" label="Finland">Finland</option>
                                                <option value="FR" label="France">France</option>
                                                <option value="DE" label="Germany">Germany</option>
                                                <option value="GI" label="Gibraltar">Gibraltar</option>
                                                <option value="GR" label="Greece">Greece</option>
                                                <option value="GG" label="Guernsey">Guernsey</option>
                                                <option value="HU" label="Hungary">Hungary</option>
                                                <option value="IS" label="Iceland">Iceland</option>
                                                <option value="IE" label="Ireland">Ireland</option>
                                                <option value="IM" label="Isle of Man">Isle of Man</option>
                                                <option value="IT" label="Italy">Italy</option>
                                                <option value="JE" label="Jersey">Jersey</option>
                                                <option value="LV" label="Latvia">Latvia</option>
                                                <option value="LI" label="Liechtenstein">Liechtenstein</option>
                                                <option value="LT" label="Lithuania">Lithuania</option>
                                                <option value="LU" label="Luxembourg">Luxembourg</option>
                                                <option value="MK" label="Macedonia">Macedonia</option>
                                                <option value="MT" label="Malta">Malta</option>
                                                <option value="FX" label="Metropolitan France">Metropolitan France
                                                </option>
                                                <option value="MD" label="Moldova">Moldova</option>
                                                <option value="MC" label="Monaco">Monaco</option>
                                                <option value="ME" label="Montenegro">Montenegro</option>
                                                <option value="NL" label="Netherlands">Netherlands</option>
                                                <option value="NO" label="Norway">Norway</option>
                                                <option value="PL" label="Poland">Poland</option>
                                                <option value="PT" label="Portugal">Portugal</option>
                                                <option value="RO" label="Romania">Romania</option>
                                                <option value="RU" label="Russia">Russia</option>
                                                <option value="SM" label="San Marino">San Marino</option>
                                                <option value="RS" label="Serbia">Serbia</option>
                                                <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro
                                                </option>
                                                <option value="SK" label="Slovakia">Slovakia</option>
                                                <option value="SI" label="Slovenia">Slovenia</option>
                                                <option value="ES" label="Spain">Spain</option>
                                                <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan
                                                    Mayen
                                                </option>
                                                <option value="SE" label="Sweden">Sweden</option>
                                                <option value="CH" label="Switzerland">Switzerland</option>
                                                <option value="UA" label="Ukraine">Ukraine</option>
                                                <option value="SU" label="Union of Soviet Socialist Republics">Union of
                                                    Soviet Socialist Republics
                                                </option>
                                                <option value="GB" label="United Kingdom">United Kingdom</option>
                                                <option value="VA" label="Vatican City">Vatican City</option>
                                                <option value="AX" label="Åland Islands">Åland Islands</option>
                                            </optgroup>
                                            <optgroup id="country-optgroup-Oceania" label="Oceania">
                                                <option value="AS" label="American Samoa">American Samoa</option>
                                                <option value="AQ" label="Antarctica">Antarctica</option>
                                                <option value="AU" label="Australia">Australia</option>
                                                <option value="BV" label="Bouvet Island">Bouvet Island</option>
                                                <option value="IO" label="British Indian Ocean Territory">British Indian
                                                    Ocean Territory
                                                </option>
                                                <option value="CX" label="Christmas Island">Christmas Island</option>
                                                <option value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling]
                                                    Islands
                                                </option>
                                                <option value="CK" label="Cook Islands">Cook Islands</option>
                                                <option value="FJ" label="Fiji">Fiji</option>
                                                <option value="PF" label="French Polynesia">French Polynesia</option>
                                                <option value="TF" label="French Southern Territories">French Southern
                                                    Territories
                                                </option>
                                                <option value="GU" label="Guam">Guam</option>
                                                <option value="HM" label="Heard Island and McDonald Islands">Heard
                                                    Island and McDonald Islands
                                                </option>
                                                <option value="KI" label="Kiribati">Kiribati</option>
                                                <option value="MH" label="Marshall Islands">Marshall Islands</option>
                                                <option value="FM" label="Micronesia">Micronesia</option>
                                                <option value="NR" label="Nauru">Nauru</option>
                                                <option value="NC" label="New Caledonia">New Caledonia</option>
                                                <option value="NZ" label="New Zealand">New Zealand</option>
                                                <option value="NU" label="Niue">Niue</option>
                                                <option value="NF" label="Norfolk Island">Norfolk Island</option>
                                                <option value="MP" label="Northern Mariana Islands">Northern Mariana
                                                    Islands
                                                </option>
                                                <option value="PW" label="Palau">Palau</option>
                                                <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                                                <option value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                                                <option value="WS" label="Samoa">Samoa</option>
                                                <option value="SB" label="Solomon Islands">Solomon Islands</option>
                                                <option value="GS" label="South Georgia and the South Sandwich Islands">
                                                    South Georgia and the South Sandwich Islands
                                                </option>
                                                <option value="TK" label="Tokelau">Tokelau</option>
                                                <option value="TO" label="Tonga">Tonga</option>
                                                <option value="TV" label="Tuvalu">Tuvalu</option>
                                                <option value="UM" label="U.S. Minor Outlying Islands">U.S. Minor
                                                    Outlying Islands
                                                </option>
                                                <option value="VU" label="Vanuatu">Vanuatu</option>
                                                <option value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                                            </optgroup>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn_blue">Create Language</button>
                                </div>

                            </form>
                            <!-- /.form -->

                        </div>
                    </div>
                </div>
                <!-- /.general form elements -->
            </div>
            <!-- /.col -->

        </div>
    </div>
</div>
<!-- /.box -->

@endsection
