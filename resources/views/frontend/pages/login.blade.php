@extends('frontend.layouts.master')

@section('title','E-Shop || Login Page')

@section('content')
<section class="login-sec">
        <div class="logmod">
            <div class="logmod__wrapper">
                <div class="logmod__container">
                    <ul class="logmod__tabs">
                        <li data-tabtar="lgm-2"><a href="#">Login</a></li>
                        <li data-tabtar="lgm-1"><a href="#">Register</a></li>
                    </ul>
                    <div class="logmod__tab-wrapper">
                        <div class="logmod__tab lgm-1">
                            <div class="logmod__heading">
                                <span class="logmod__heading-subtitle">Register Your Account</strong></span>
                            </div>
                            <div class="logmod__form">
                              <form method="POST" action="{{ route('register.submit') }}">
                                @csrf
                                <input type="hidden" name="roles[]" value="User">
                                <div class="sminputs">
                                        <div class="input full">
                                            <input class="string optional" id="user-email" value="{{old('name') }}"
                                                placeholder="Username" type="text" name="name" size="50" />
                                        </div>
                                    </div>
                                    <div class="sminputs">
                                        <div class="input full">
                                            <input class="string optional" id="user-email" value="{{old('email') }}"
                                                placeholder="Email" type="email" name="email" size="50" />
                                        </div>
                                    </div>
                                    <div class="sminputs">
                                        <div class="input full" style="margin-bottom: 20px;">
                                            <input class="string optional" maxlength="255" id="user-pw" value="{{old('password') }}"
                                                placeholder="Password" type="password" name="password" size="50" />
                                        </div>
                                    </div>
                                    <div class="sminputs">
                                        <div class="input full" style="margin-bottom: 20px;">
                                            <input class="string optional" maxlength="255" id="user-pw" value="{{old('confirmed') }}"
                                                placeholder="Confirm Password" type="password" name="confirmed" size="50" />
                                        </div>
                                    </div>
                                    <div class="simform__actions">
                                        <div class="simform__actions">
                                              <button class="btn-sim-sumit">Sign Up</button>
                                        </div>
                                        <span class="simform__actions-sidetext">By creating an account you agree to our
                                            <a class="special" href="#" target="_blank" role="link">Terms &
                                                Privacy</a></span>
                                    </div>
                                </form>
                            </div>
                            <div class="logmod__alter">
                                <div class="logmod__alter-container">
                                    <h4 class="login-with">Sign up with:</h4>
                                    <div class="logmod-social">
                                    <a href="#">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa-brands fa-google-plus-g"></i>
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="logmod__tab lgm-2">
                            <div class="logmod__heading">
                                <span class="logmod__heading-subtitle">Log In To Your Account</span>
                            </div>
                            <div class="logmod__form">
                              <form method="POST" action="{{ route('login.submit') }}">
                                @csrf
                                    <div class="sminputs">
                                        <div class="input full">
                                            <input class="string optional" maxlength="255" id="user-email"  value="{{old('email') }}"
                                                placeholder="Username/Email" name="email" type="email" size="50" />
                                        </div>
                                    </div>
                                    <div class="sminputs">
                                        <div class="input full">
                                            <input class="string optional" maxlength="255" id="user-pw"
                                                placeholder="Password" name="password" type="password" size="50" />
                                            <a href="javascript:"><span class="hide-password">Forgot?</span></a>
                                        </div>
                                    </div>
                                    <div class="rememberme-div">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="simform__actions">
                                        <!-- <input class="sumbit" name="commit" type="sumbit" value="Log In" /> -->
                                       <button class="btn-sim-sumit">Log In</button>
                                    </div>
                                </form>
                            </div>
                            <div class="logmod__alter">
                                <div class="logmod__alter-container">
                                    <h4 class="login-with">Log in with:</h4>
                                    <div class="logmod-social">
                                    <a href="#">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa-brands fa-google-plus-g"></i>
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
