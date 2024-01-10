@php use App\Models\User; @endphp
<x-admin-layout>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner">

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>{{ __('Настройки') }}</h3>
            </div>


            <!-- Row -->
            <div class="row">
                    <!-- Dashboard Box -->
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="col-xl-12">
                        <div class="dashboard-box margin-top-0">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-material-outline-account-circle"></i> {{ __('Мой аккаунт') }}</h3>
                            </div>

                            <div class="content with-padding padding-bottom-0">

                                <div class="row">

                                    <div class="col-auto">
                                        <div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
                                            <img class="profile-pic" src="images/user-avatar-placeholder.png" alt=""/>
                                            <div class="upload-button"></div>
                                            <input class="file-upload" type="file" accept="image/*"/>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="submit-field">
                                                    <h5>Имя</h5>
                                                    <input name="first_name" type="text" class="with-border"
                                                           value="{{ Auth::user()->first_name }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="submit-field">
                                                    <h5>Фамилия</h5>
                                                    <input name="last_name" type="text" class="with-border"
                                                           value="{{ Auth::user()->last_name }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <!-- Account Type -->
                                                <div class="submit-field">
                                                    <div class="account-type">
                                                        <div>
                                                            <input type="radio"
                                                                   name="account-type-radio"
                                                                   id="{{ User::ROLE_EXECUTOR }}-radio"
                                                                   class="account-type-radio"
                                                                   value="{{ User::ROLE_EXECUTOR }}"
                                                                   @if(Auth::user()->role === User::ROLE_EXECUTOR) checked @endif
                                                            />
                                                            <label for="{{ User::ROLE_EXECUTOR }}-radio" class="ripple-effect-dark"><i
                                                                    class="icon-material-outline-account-circle"></i>
                                                                Исполнитель</label>
                                                        </div>

                                                        <div>
                                                            <input type="radio"
                                                                   name="account-type-radio"
                                                                   id="{{ User::ROLE_CUSTOMER }}-radio"
                                                                   class="account-type-radio"
                                                                   value="{{ User::ROLE_CUSTOMER }}"
                                                                   @if(Auth::user()->role === User::ROLE_CUSTOMER) checked @endif
                                                            />
                                                            <label for="{{ User::ROLE_CUSTOMER }}-radio" class="ripple-effect-dark"><i
                                                                    class="icon-material-outline-business-center"></i>
                                                                Заказчик</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="submit-field">
                                                    <h5>Email</h5>
                                                    <x-text-input id="email" name="email" type="email"
                                                                  class="with-border"
                                                                  :value="old('email', Auth::user()->email)" required
                                                                  autocomplete="username"/>
                                                    <x-input-error class="mt-2" :messages="$errors->get('email')"/>

                                                    @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                                                        <div>
                                                            <p class="text-sm mt-2 text-gray-800">
                                                                {{ __('Your email address is unverified.') }}

                                                                <button form="send-verification"
                                                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                    {{ __('Click here to re-send the verification email.') }}
                                                                </button>
                                                            </p>

                                                            @if (session('status') === 'verification-link-sent')
                                                                <p class="mt-2 font-medium text-sm text-green-600">
                                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button type="submit" class="button ripple-effect big margin-bottom-30">Сохранить изменения</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <form action="">
                    <div class="col-xl-12">
                        <div class="dashboard-box">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-material-outline-face"></i> My Profile</h3>
                            </div>

                            <div class="content">
                                <ul class="fields-ul">
                                    <li>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="submit-field">
                                                    <div class="bidding-widget">
                                                        <!-- Headline -->
                                                        <span class="bidding-detail">Set your <strong>minimal hourly rate</strong></span>

                                                        <!-- Slider -->
                                                        <div class="bidding-value margin-bottom-10">$<span
                                                                id="biddingVal"></span></div>
                                                        <input class="bidding-slider" type="text" value=""
                                                               data-slider-handle="custom" data-slider-currency="$"
                                                               data-slider-min="5" data-slider-max="150"
                                                               data-slider-value="35" data-slider-step="1"
                                                               data-slider-tooltip="hide"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="submit-field">
                                                    <h5>Skills <i class="help-icon" data-tippy-placement="right"
                                                                  title="Add up to 10 skills"></i></h5>

                                                    <!-- Skills List -->
                                                    <div class="keywords-container">
                                                        <div class="keyword-input-container">
                                                            <input type="text" class="keyword-input with-border"
                                                                   placeholder="e.g. Angular, Laravel"/>
                                                            <button class="keyword-input-button ripple-effect"><i
                                                                    class="icon-material-outline-add"></i></button>
                                                        </div>
                                                        <div class="keywords-list">
                                                            <span class="keyword"><span
                                                                    class="keyword-remove"></span><span
                                                                    class="keyword-text">Angular</span></span>
                                                            <span class="keyword"><span
                                                                    class="keyword-remove"></span><span
                                                                    class="keyword-text">Vue JS</span></span>
                                                            <span class="keyword"><span
                                                                    class="keyword-remove"></span><span
                                                                    class="keyword-text">iOS</span></span>
                                                            <span class="keyword"><span
                                                                    class="keyword-remove"></span><span
                                                                    class="keyword-text">Android</span></span>
                                                            <span class="keyword"><span
                                                                    class="keyword-remove"></span><span
                                                                    class="keyword-text">Laravel</span></span>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="submit-field">
                                                    <h5>Attachments</h5>

                                                    <!-- Attachments -->
                                                    <div class="attachments-container margin-top-0 margin-bottom-0">
                                                        <div class="attachment-box ripple-effect">
                                                            <span>Cover Letter</span>
                                                            <i>PDF</i>
                                                            <button class="remove-attachment" data-tippy-placement="top"
                                                                    title="Remove"></button>
                                                        </div>
                                                        <div class="attachment-box ripple-effect">
                                                            <span>Contract</span>
                                                            <i>DOCX</i>
                                                            <button class="remove-attachment" data-tippy-placement="top"
                                                                    title="Remove"></button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                    <!-- Upload Button -->
                                                    <div class="uploadButton margin-top-0">
                                                        <input class="uploadButton-input" type="file"
                                                               accept="image/*, application/pdf" id="upload" multiple/>
                                                        <label class="uploadButton-button ripple-effect" for="upload">Upload
                                                            Files</label>
                                                        <span
                                                            class="uploadButton-file-name">Maximum file size: 10 MB</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="submit-field">
                                                    <h5>Tagline</h5>
                                                    <input type="text" class="with-border"
                                                           value="iOS Expert + Node Dev">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="submit-field">
                                                    <h5>Nationality</h5>
                                                    <select class="selectpicker with-border" data-size="7"
                                                            title="Select Job Type" data-live-search="true">
                                                        <option value="AR">Argentina</option>
                                                        <option value="AM">Armenia</option>
                                                        <option value="AW">Aruba</option>
                                                        <option value="AU">Australia</option>
                                                        <option value="AT">Austria</option>
                                                        <option value="AZ">Azerbaijan</option>
                                                        <option value="BS">Bahamas</option>
                                                        <option value="BH">Bahrain</option>
                                                        <option value="BD">Bangladesh</option>
                                                        <option value="BB">Barbados</option>
                                                        <option value="BY">Belarus</option>
                                                        <option value="BE">Belgium</option>
                                                        <option value="BZ">Belize</option>
                                                        <option value="BJ">Benin</option>
                                                        <option value="BM">Bermuda</option>
                                                        <option value="BT">Bhutan</option>
                                                        <option value="BG">Bulgaria</option>
                                                        <option value="BF">Burkina Faso</option>
                                                        <option value="BI">Burundi</option>
                                                        <option value="KH">Cambodia</option>
                                                        <option value="CM">Cameroon</option>
                                                        <option value="CA">Canada</option>
                                                        <option value="CV">Cape Verde</option>
                                                        <option value="KY">Cayman Islands</option>
                                                        <option value="CO">Colombia</option>
                                                        <option value="KM">Comoros</option>
                                                        <option value="CG">Congo</option>
                                                        <option value="CK">Cook Islands</option>
                                                        <option value="CR">Costa Rica</option>
                                                        <option value="CI">Côte d'Ivoire</option>
                                                        <option value="HR">Croatia</option>
                                                        <option value="CU">Cuba</option>
                                                        <option value="CW">Curaçao</option>
                                                        <option value="CY">Cyprus</option>
                                                        <option value="CZ">Czech Republic</option>
                                                        <option value="DK">Denmark</option>
                                                        <option value="DJ">Djibouti</option>
                                                        <option value="DM">Dominica</option>
                                                        <option value="DO">Dominican Republic</option>
                                                        <option value="EC">Ecuador</option>
                                                        <option value="EG">Egypt</option>
                                                        <option value="GP">Guadeloupe</option>
                                                        <option value="GU">Guam</option>
                                                        <option value="GT">Guatemala</option>
                                                        <option value="GG">Guernsey</option>
                                                        <option value="GN">Guinea</option>
                                                        <option value="GW">Guinea-Bissau</option>
                                                        <option value="GY">Guyana</option>
                                                        <option value="HT">Haiti</option>
                                                        <option value="HN">Honduras</option>
                                                        <option value="HK">Hong Kong</option>
                                                        <option value="HU">Hungary</option>
                                                        <option value="IS">Iceland</option>
                                                        <option value="IN">India</option>
                                                        <option value="ID">Indonesia</option>
                                                        <option value="NO">Norway</option>
                                                        <option value="OM">Oman</option>
                                                        <option value="PK">Pakistan</option>
                                                        <option value="PW">Palau</option>
                                                        <option value="PA">Panama</option>
                                                        <option value="PG">Papua New Guinea</option>
                                                        <option value="PY">Paraguay</option>
                                                        <option value="PE">Peru</option>
                                                        <option value="PH">Philippines</option>
                                                        <option value="PN">Pitcairn</option>
                                                        <option value="PL">Poland</option>
                                                        <option value="PT">Portugal</option>
                                                        <option value="PR">Puerto Rico</option>
                                                        <option value="QA">Qatar</option>
                                                        <option value="RE">Réunion</option>
                                                        <option value="RO">Romania</option>
                                                        <option value="RU">Russian Federation</option>
                                                        <option value="RW">Rwanda</option>
                                                        <option value="SZ">Swaziland</option>
                                                        <option value="SE">Sweden</option>
                                                        <option value="CH">Switzerland</option>
                                                        <option value="TR">Turkey</option>
                                                        <option value="TM">Turkmenistan</option>
                                                        <option value="TV">Tuvalu</option>
                                                        <option value="UG">Uganda</option>
                                                        <option value="UA">Ukraine</option>
                                                        <option value="GB">United Kingdom</option>
                                                        <option value="US" selected>United States</option>
                                                        <option value="UY">Uruguay</option>
                                                        <option value="UZ">Uzbekistan</option>
                                                        <option value="YE">Yemen</option>
                                                        <option value="ZM">Zambia</option>
                                                        <option value="ZW">Zimbabwe</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="submit-field">
                                                    <h5>Introduce Yourself</h5>
                                                    <textarea cols="30" rows="5" class="with-border">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                                <div class="col-xl-12">
                                    <button type="submit" class="button ripple-effect big margin-bottom-30 margin-top-30">Сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <!-- Dashboard Box -->


                    <!-- Dashboard Box -->
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="col-xl-12">
                        <div id="test1" class="dashboard-box">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-material-outline-lock"></i> Безопасность</h3>
                            </div>

                            <div class="content with-padding">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Текущий пароль</h5>
                                            <x-text-input id="update_password_current_password" name="current_password" type="password" class="with-border" autocomplete="current-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Новый пароль</h5>
                                            <x-text-input id="update_password_password" name="password" type="password" class="with-border" autocomplete="new-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Подтверждение нового пароля</h5>
                                            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="with-border" autocomplete="new-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button type="submit" class="button ripple-effect big margin-bottom-30 margin-top-30">Сохранить изменения</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            <!-- Row / End -->


            <!-- Footer -->
            <div class="dashboard-footer-spacer"></div>
            <div class="small-footer margin-top-15">
                <div class="small-footer-copyrights">
                    © 2018 <strong>Hireo</strong>. All Rights Reserved.
                </div>
                <ul class="footer-social-links">
                    <li>
                        <a href="#" title="Facebook" data-tippy-placement="top">
                            <i class="icon-brand-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Twitter" data-tippy-placement="top">
                            <i class="icon-brand-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Google Plus" data-tippy-placement="top">
                            <i class="icon-brand-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="LinkedIn" data-tippy-placement="top">
                            <i class="icon-brand-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Footer / End -->

        </div>
    </div>
</x-admin-layout>