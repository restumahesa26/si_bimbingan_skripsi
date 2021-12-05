<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>SI Bimb. Skripsi</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('includes.home.style')

</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== NAVBAR TWO PART START ======-->

    @include('includes.home.navbar')

    <!--====== NAVBAR TWO PART ENDS ======-->

    <!--====== SLIDER PART START ======-->

    @yield('content')

    @include('includes.home.script')

</body>

</html>
