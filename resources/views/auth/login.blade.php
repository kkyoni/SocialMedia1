@extends('auth.layouts.app')

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="height:600px"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                @if (session('error'))
                                    <span class="text-danger"> {{ session('error') }}</span>
                                @endif

                                <form method="POST" action="{{ url('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus placeholder="Enter Email Address.">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password" placeholder="Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input class="custom-control-input" type="checkbox" name="remember"
                                                id="customCheck" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-primary btn-user">SingIn</button>
                                    <a href="{{ url('registering') }}"
                                        class="btn btn-primary btn-user float-right">SingUp</a>
                                    <hr>
                                    <div class="text-center">
                                        <div class="text-center small" style="color:red"><b>Social Media Login</b></div>
                                        <hr>
                                        <a href="{{ route('facebook.login') }}" class="btn btn-facebook disabled"><i
                                                class="fab fa-facebook-f fa-fw"></i></a>
                                        <a href="{{ route('google.login') }}" class="btn btn-google"><i
                                                class="fab fa-google fa-fw"></i></a>
                                        <a href="{{ route('github.login') }}" class="btn btn-github"><i
                                                class="fab fa-github fa-fw"></i></a>
                                        <a href="{{ route('linkedin.login') }}" class="btn btn-linkedin disabled"><i
                                                class="fab fa-linkedin fa-fw"></i></a>
                                        <a href="{{ route('twitter.login') }}" class="btn btn-twitter disabled"><i
                                                class="fab fa-twitter fa-fw"></i></a>
                                    <div>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
