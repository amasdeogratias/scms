<!DOCTYPE html>
<html lang="en">

{{-- Include Head --}}
@include('admin.common.head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('admin.common.header')
    @include('admin.common.sidebar')
</div>


<div class="content-wrapper" id="app">
    @yield('content')
</div>



<script src="{{ Vite::asset('resources/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ Vite::asset('resources/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{ Vite::asset('resources/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ Vite::asset('resources/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

<script src="{{ Vite::asset('resources/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{ Vite::asset('resources/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ Vite::asset('resources/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ Vite::asset('resources/plugins/moment/moment.min.js')}}"></script>
<script src="{{ Vite::asset('resources/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
{{--<script src="{{ Vite::asset('resources/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>--}}
<!-- Summernote -->
<script src="{{ Vite::asset('resources/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ Vite::asset('resources/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ Vite::asset('resources/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ Vite::asset('resources/dist/js/pages/dashboard.js')}}"></script>
<!-- select 2 -->
<script src="{{ Vite::asset('resources/plugins/select2/js/select2.full.min.js') }}"></script>


<!--datatables-->
<script src="{{ Vite::asset('resources/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ Vite::asset('resources/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
@stack('scripts')
</body>

</html>
