@extends('layouts.auth.master')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-flex">
                        <div class="imgggg"
                            style="background-image: url({{ asset('admin-asset/assets/img/backgrounds/login-thumb.png') }});">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="authentication-inner">
                                <!-- Register -->
                                <div class="carddd">
                                    <div class="card-body">
                                        <!-- Logo -->
                                        <div class="app-brand justify-content-center">
                                            <a href="{{ route('admin.login') }}" class="app-brand-link gap-2">
                                                <span class="app-brand-logo demo">
                                                    <img src="{{ asset('admin-asset/assets/img/logo/ma-logo.png') }}"
                                                        alt="">
                                                </span>
                                            </a>
                                        </div>
                                        <!-- /Logo -->
                                        <h4 class="mb-2">Forgot Password? 🔒</h4>
                                        <p class="mb-4">Enter your email and we'll send you instructions to reset your
                                            password</p>
                                        <form id="formAuthentication" class="mb-3"
                                            action="{{ route('admin.password.email') }}" method="POST">
                                            @csrf
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email" name="email"
                                                    placeholder="Enter your email" autofocus />
                                            </div>
                                            <button type="submit" class="btn btn-primary d-grid w-100">Send Reset
                                                Link</button>
                                        </form>

                                        <p class="text-center">
                                            <span>Forgot your password?</span>
                                            <a href="{{ route('admin.login') }}"
                                                class="d-flex align-items-center justify-content-center">
                                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                                Back to login
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
@endsection
