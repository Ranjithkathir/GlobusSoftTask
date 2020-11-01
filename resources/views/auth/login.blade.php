@extends('layouts.auth')

@section('content')
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-4">Employee Management!</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                         @if ( session()->has('errmessage') )
                            <div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>{{ session()->get('errmessage') }}</div>
                        @endif
                        <div class="form-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-pill border-0 shadow-sm px-4" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>

                        <div class="form-group mb-3">
                            
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-pill border-0 shadow-sm px-4 text-primary" placeholder="Password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                        </div>

                        
                            <div class="custom-control custom-checkbox mb-3">
                                <div class="form-check">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="custom-control-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        

                        <!-- <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4"> -->
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">
                                    {{ __('Login') }}
                                </button>
                                <?php /*
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif */?>
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        Not a memeber {{ __('Sign Up?') }}
                                    </a>
                            <!-- </div>
                        </div> -->
                    </form>
                </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
@endsection
