<!DOCTYPE html>
<html lang="en">

<head>
  <title>E-SHOP || Login Page</title>
  @include('backend.layouts.head')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('/toastr/toastr.min.css')}}">
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9 mt-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <div class="logmod__container">
                    <ul class="nav nav-tabs" id="myTab">
                        <li data-tabtar="nav-item"><a href="#login" class="nav-link active" data-bs-toggle="tab">Login</a></li>
                        <li data-tabtar="nav-item"><a href="#register" class="nav-link" data-bs-toggle="tab">Register</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="login"><br>
                        <div class="logmod__heading">
                          <span class="logmod__heading-subtitle">Log In To Your Account</span>
                        </div><br>
                        <div class="logmod__form">
                          <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="sminputs">
                              <div class="input full">
                                <input class="string optional  form-control" maxlength="255" id="user-email"  value="{{old('email') }}" placeholder="Username/Email" name="email" type="email" size="50" />
                              </div>
                            </div><br>
                            <div class="sminputs">
                              <div class="input full">
                                <input class="string optional form-control" maxlength="255" id="user-pw" placeholder="Password" name="password" type="password" size="50" />
                              </div>
                            </div>
                            <div class="rememberme-div">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                              </div>
                            </div>
                            <div class="simform__actions">
                              <button class="btn btn-primary">Log In</button>
                            </div>
                          </form>
                        </div>
                        <div class="text-center">
                          @if (Route::has('password.request'))
                            <a class="btn btn-link small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                          @endif
                        </div>
                      </div>
                      <div  class="tab-pane fade show" id="register"><br>
                        <div class="logmod__heading">
                          <span class="logmod__heading-subtitle">Register Your Account</strong></span>
                        </div><br>
                        <div class="logmod__form">
                          <form method="POST" action="{{ route('vendor_register.submit') }}">
                            @csrf
                            <input type="hidden" name="roles[]" value="User">
                            <div class="sminputs">
                              <div class="input full">
                                <input class="string optional form-control" id="user-email" value="{{old('name') }}" placeholder="Username" type="text" name="name" size="50" />
                              </div>
                            </div><br>
                            <div class="sminputs">
                              <div class="input full">
                                <input class="string optional form-control" id="user-email" value="{{old('email') }}" placeholder="Email" type="email" name="email" size="50" />
                              </div>
                            </div><br>
                            <div class="sminputs">
                              <div class="input full" style="margin-bottom: 20px;">
                                <input class="string optional form-control" maxlength="255" id="user-pw" value="{{old('password') }}" placeholder="Password" type="password" name="password" size="50" />
                              </div>
                            </div>
                            
                            <div class="simform__actions">
                              <div class="simform__actions"><button class="btn btn-primary">Sign Up</button></div>
                              <span class="simform__actions-sidetext">
                                By creating an account you agree to our <a class="special" href="#" target="_blank" role="link">Terms & Privacy</a>
                              </span>
                            </div>
                          </form>
                        </div>    
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Toastr -->
<script src="{{asset('/toastr/toastr.min.js')}}"></script>
<script>
@if(session('success'))
  toastr.success("{{session('success')}}");
@endif
@if(session('error'))
  toastr.error("{{session('error')}}")
@endif
@if($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{$error}}")
    @endforeach
@endif
</script>
</html>
