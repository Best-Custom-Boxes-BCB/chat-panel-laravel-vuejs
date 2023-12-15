<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed " dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

    {{-- <audio id="myAudio">
        <source src="{{ asset('admin-asset/sound/notification.mp3') }}" type="audio/mpeg">
      </audio> --}}

        

{{-- header start --}}
@include('layouts.admin.header')
{{-- header end --}}

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <!-- sidebar start-->

            @include('layouts.admin.sidebar')
            <!-- / sidebar end -->
            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('layouts.admin.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    @yield('content')

                    <!-- / Content -->
                    {{-- footer start --}}
                    @include('layouts.admin.footer')
                    {{-- footer end --}}


</body>

</html>
