<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <link href="{{asset('/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/admin/css/google-font.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @stack('script-head')
</head>

<body>

<!-- Navigation -->
@include('template.forum.partials.topbar')

<!-- Page Content -->
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="row p justify-content-center">
                <!-- left wigdet Widgets Column -->
                <div class="col-md-2 p-0">
                    <!-- Categories Widget -->
                    <ul class="navbar-nav sidebar-light m-0">
                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">
                        <hr class="sidebar-divider">

                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item active">
                            <a class="nav-link" href="/">
                                <i class="fas fa-fw fa-home"></i>
                                <span>Home</span></a>
                        </li>
                    </ul>
                </div>
                <!-- Blog Entries Column -->
                <div class="col-md-7 p-0">
                    @yield('content')
                </div>
                <!-- right wigdet Widgets Column -->
                <div class="col-md-2 ml-0 p-0">

{{--                    <div class="card border-0">--}}
{{--                        <h5 class="card-header">Categories</h5>--}}
{{--                        <div class="card-body">--}}
{{--                            <ul class="list-unstyled mb-0">--}}
{{--                                <li>--}}
{{--                                    <a href="#">Web Design</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">HTML</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">Freebies</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!-- Side Widget -->--}}
{{--                    <div class="card my-4 border-0">--}}
{{--                        <h5 class="card-header">Side Widget</h5>--}}
{{--                        <div class="card-body">--}}
{{--                            You can put anything you want inside of these side widgets. They are easy to use, and--}}
{{--                            feature the new Bootstrap 4 card containers!--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <!-- /.row -->
        </div>
        {{-- penutup content --}}
    </div>
</div>
@include('template.forum.partials.footer')

<!-- Bootstrap core JavaScript-->
<script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

@stack('script-body')
</body>

</html>
