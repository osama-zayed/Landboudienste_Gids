<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('admin.layouts.head')
</head>

<body>

    <div class="wrapper">

        <div id="pre-loader">
            <img src="assets/admin/images/pre-loader/loader-01.svg" alt="">
        </div>

        @include('admin.layouts.main-header')

        @include('admin.layouts.main-sidebar')

        @yield('content')
        @include('admin.layouts.footer')
    </div><!-- main content wrapper end-->
    </div>


    @include('admin.layouts.footer-scripts')

</body>

</html>
