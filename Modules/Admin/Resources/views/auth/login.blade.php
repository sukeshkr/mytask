@extends('layouts.auth.master')

@section('content')
<!-- Content -->


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-flex">
                    <div class="imgggg"
                        style="background-image: url({{ asset('admin-asset/assets/img/backgrounds/login-thumb.jpg') }});">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="authentication-inner">
                            <!-- Register -->
                            <div class="carddd">
                                <div class="card-body">
                                    <!-- Logo -->
                                    <div class="app-brand justify-content-center">
                                        <a href="{{route('admin.login')}}" class="app-brand-link gap-2">
                                            <span class="app-brand-logo demo">
                                                <img src="{{ asset('admin-asset/assets/img/logo/ma-logo.png') }}"
                                                    alt="">
                                            </span>
                                        </a>
                                    </div>
                                    <!-- /Logo -->
                                    <h4 class="mb-2">Welcome to My Task! 👋</h4>
                                    <p class="mb-4">Please sign-in to your account and start the adventure</p>

                                    <form autocomplete="off" id="formAuthentication" class="mb-3"
                                        action="{{ route('admin.logpost') }}" method="POST">
                                        @csrf
                                        @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                        @endforeach
                                        @method('POST')
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email or Username</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Enter your email or username"
                                                autofocus />
                                        </div>
                                        <div class="mb-3 form-password-toggle">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                                <span class="input-group-text cursor-pointer"><i
                                                        class="bx bx-hide"></i></span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input name="remember" class="form-check-input" type="checkbox"
                                                    id="remember-me" />
                                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                                        </div>
                                    </form>

                                    <p class="text-center">
                                        <span>Forgot your password?</span>
                                        <a href="{{route('admin.password.request')}}">
                                            <span>Click here</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <!-- /Register -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Content -->
@endsection
