@php
    use App\Models\Category;
    use App\Models\Country;
    use App\Models\User;
@endphp
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
                <div class="col-xl-12">
                    <form method="post" action="{{ route('profile.accountUpdate') }}">
                        @csrf
                        @method('patch')

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
                                                        <x-input-error :messages="$errors->get('first_name')"
                                                                       class="mt-2"/>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="submit-field">
                                                        <h5>Фамилия</h5>
                                                        <input name="last_name" type="text" class="with-border"
                                                               value="{{ Auth::user()->last_name }}">
                                                        <x-input-error :messages="$errors->get('last_name')"
                                                                       class="mt-2"/>
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
                                                                <label for="{{ User::ROLE_EXECUTOR }}-radio"
                                                                       class="ripple-effect-dark"><i
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
                                                                <label for="{{ User::ROLE_CUSTOMER }}-radio"
                                                                       class="ripple-effect-dark"><i
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
                                            <button type="submit" class="button ripple-effect big margin-bottom-30">
                                                Сохранить изменения
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="col-xl-12">
                    <form method="post" action="{{ route('profile.profileUpdate') }}">
                        @csrf
                        @method('patch')
                        <div class="dashboard-box">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-material-outline-face"></i> Мой профиль</h3>
                            </div>

                            <div class="content">
                                <ul class="fields-ul">
                                    <li>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <div class="submit-field">
                                                    <h5>Специализация</h5>

                                                    <input name="title" type="text" class="with-border"
                                                           placeholder="прим. Уголовное право, семейное право"
                                                           value="{{ old('title', Auth::user()->settings->title ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="submit-field">
                                                    <h5>Специальности</h5>
                                                    <select multiple name="category_id[]" class="selectpicker with-border"
                                                            data-size="7"
                                                            title="Выберите свой перечень специальностей"
                                                            data-live-search="true">
                                                        @foreach(Category::all() as $category)
                                                            <option
                                                                value="{{ $category->id }}" @if(in_array($category->id, Auth::user()->categories->pluck('id')->toArray())) selected @endif>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="submit-field">
                                                    <h5>Страна</h5>
                                                    <select name="country_id" class="selectpicker with-border"
                                                            data-size="7"
                                                            title="Выберите страну" data-live-search="true">
                                                        @foreach(Country::all() as $country)
                                                            <option @if($country->id === Auth::user()->country_id) selected @endif
                                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="submit-field">
                                                    <h5>Информация о себе</h5>
                                                    <textarea name="description" cols="30" rows="5"
                                                              class="with-border">{{ Auth::user()->settings->description ?? ''}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                                <div class="col-xl-12">
                                    <button type="submit"
                                            class="button ripple-effect big margin-bottom-30 margin-top-30">Сохранить
                                        изменения
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Dashboard Box -->


                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

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
                                            <x-text-input id="update_password_current_password" name="current_password"
                                                          type="password" class="with-border"
                                                          autocomplete="current-password"/>
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')"
                                                           class="mt-2"/>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Новый пароль</h5>
                                            <x-text-input id="update_password_password" name="password" type="password"
                                                          class="with-border" autocomplete="new-password"/>
                                            <x-input-error :messages="$errors->updatePassword->get('password')"
                                                           class="mt-2"/>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Подтверждение нового пароля</h5>
                                            <x-text-input id="update_password_password_confirmation"
                                                          name="password_confirmation" type="password"
                                                          class="with-border" autocomplete="new-password"/>
                                            <x-input-error
                                                :messages="$errors->updatePassword->get('password_confirmation')"
                                                class="mt-2"/>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button type="submit"
                                                class="button ripple-effect big margin-bottom-30 margin-top-30">
                                            Сохранить изменения
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Row / End -->


            <!-- Footer -->
            <div class="dashboard-footer-spacer"></div>
            <div class="small-footer margin-top-15">
                <div class="small-footer-copyrights">
                    © {{ date('Y') }} <strong>Hireo</strong>. All Rights Reserved.
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
