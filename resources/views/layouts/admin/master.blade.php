<!doctype html>
<html lang="en">

<head>
    @include('layouts.admin._head')

</head>

<body data-layout="detached" data-topbar="colored">

    <div class="container-fluid" style="width: 100%;">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                 @include('layouts.admin._header')  
                </div>
            </header>
<!-- ========== Left Sidebar Start ========== -->
            @include('layouts.admin._sidebar')

<!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    @include('layouts.admin._footer')
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    @include('layouts.admin._script')

</body>

</html>