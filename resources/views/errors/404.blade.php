<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
{{-- <meta name="description" content="Droled - Construction & Business HTML Template"/> --}}
{{-- <meta name="keywords" content="construction, business, clean, corporate, creative,"/> --}}
{{-- <meta name="author" content="ThemeMascot"/> --}}

<!-- Page Title -->
<title>{{ env('APP_NAME') }}</title>

<!-- Favicon and Touch Icons -->
<link href="images/favicon.png" rel="shortcut icon" type="image/png">
<link href="images/apple-touch-icon.png" rel="apple-touch-icon">
<link href="images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

<!-- Stylesheet -->
<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('frontend/css/animate.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('frontend/css/javascript-plugins-bundle.css') }}" rel="stylesheet"/>

<!-- CSS | menuzord megamenu skins -->
<link href="{{ asset('frontend/js/menuzord/css/menuzord.css') }}" rel="stylesheet"/>

<!-- CSS | Main style file -->
<link href="{{ asset('frontend/css/style-main.css') }}" rel="stylesheet" type="text/css">
<link id="menuzord-menu-skins" href="{{ asset('frontend/css/menuzord-skins/menuzord-rounded-boxed.css') }}" rel="stylesheet"/>

<!-- CSS | Responsive media queries -->
<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->

<!-- CSS | Theme Color -->
<link href="{{ asset('frontend/css/colors/theme-skin-color-set1.css') }}" rel="stylesheet" type="text/css">

<!-- external javascripts -->
<script src="{{ asset('frontend/js/jquery.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/javascript-plugins-bundle.js') }}"></script>
<script src="{{ asset('frontend/js/menuzord/js/menuzord.js') }}"></script>

<!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="tm-container-1300px">
<div id="wrapper" class="clearfix">

  <!-- Start main-content -->
  <div class="main-content-area">
    <!-- Section: home -->
    <section id="home" class="fullscreen bg-lightest">
      <div class="display-table text-center">
        <div class="display-table-cell">
          <div class="container pt-0 pb-0">
            <div class="row">
              <div class="col"></div>
              <div class="col-lg-6">
                <h1 class="text-theme-colored1 font-weight-600 font-size-200">404</h1>
                <h3 class="mt-0 mb-10">{{ __('Oops! Page Not Found') }}</h3>
                <p>{{ __('The page you were looking for could not be found.') }}</p>
                <a class="btn btn-theme-colored1 btn-sm smooth-scroll" href="{{ route('home.index') }}"><i class="fa fa-hand-o-left font-size-16 mr-10"></i>{{ __('Return Home') }}</a>
              </div>
              <div class="col"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->

  <!-- Footer -->
  <footer id="footer" class="footer bg-black-333 text-center pt-20 pb-20">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="mb-0">Copyright ©2022 {{ env('APP_NAME') }}. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>

</body>
</html>