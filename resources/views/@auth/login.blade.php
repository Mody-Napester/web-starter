<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/ubold/layouts/default/auth-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 21 Aug 2021 22:46:06 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Log In | UBold - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="https://coderthemes.com/ubold/layouts/assets/images/favicon.ico">

		<!-- App css -->
        <link href="{{ url('assets_dashboard/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets_dashboard/css/config/default/app-dark.min.css') }}" rel="stylesheet" type="text/css"/>

		<!-- icons -->
		<link href="{{ url('assets_dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    </head>

    <body class="loading auth-fluid-pages pb-0">

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <div class="auth-logo">
                                <a href="" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ url('assets_dashboard/images/logo-dark.png') }}" alt="" height="22">
                                    </span>
                                </a>

                                <a href="" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ url('assets_dashboard/images/logo-light.png') }}" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- title-->
                        <h4 class="mt-0">Sign In</h4>
                        <p class="text-muted mb-4">Enter your email address and password to access account.</p>

                        <!-- form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                            </div>

                            <div class="mb-3">
{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a href="{{ route('password.request') }}" class="text-muted float-end"><small>{{ __('Forgot your password?') }}</small></a>--}}
{{--                                @endif--}}

                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password" placeholder="Enter your password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="fa fa-fw fa-eye"></span>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="mb-3">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input type="checkbox" class="form-check-input" name="remember" id="remember_me">--}}
{{--                                    <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="text-center d-grid">
                                <button class="btn btn-primary" type="submit">{{ __('Log in') }} </button>
                            </div>

                        </form>
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">Don't have an account? <a href="" class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </footer>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3 text-white">I love the color!</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <h5 class="text-white">
                        - Fadlisaad (Ubold Admin User)
                    </h5>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
        <!-- end auth-fluid-->

        <!-- Vendor js -->
        <script src="{{ url('assets_dashboard/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ url('assets_dashboard/js/app.min.js') }}"></script>

    </body>

</html>
