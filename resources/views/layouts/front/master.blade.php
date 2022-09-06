<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.front._head')
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    @include('layouts.front._header')
    <div class="main-section">
        @yield('content')
    </div>

    <!-- FOOTER -->
    @include('layouts.front._footer')


    @include('layouts.front._script')

</body>

</html>
