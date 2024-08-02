<!-- jquery -->
<script src="{{ URL::asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/admin/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script>
    var plugin_path = 'js/';
</script>

<!-- chart -->
<script src="{{ URL::asset('assets/admin/js/chart-init.js') }}"></script>
<!-- calendar -->
{{-- <script src="{{ URL::asset('assets/admin/js/calendar.init.js') }}"></script> --}}
<!-- charts sparkline -->
{{-- <script src="{{ URL::asset('assets/admin/js/sparkline.init.js') }}"></script> --}}
<!-- charts morris -->
{{-- <script src="{{ URL::asset('assets/admin/js/morris.init.js') }}"></script> --}}
<!-- datepicker -->
{{-- <script src="{{ URL::asset('assets/admin/js/datepicker.js') }}"></script> --}}
<!-- sweetalert2 -->
{{-- <script src="{{ URL::asset('assets/admin/js/sweetalert2.js') }}"></script> --}}
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/admin/js/toastr.js') }}"></script>
<!-- validation -->
{{-- <script src="{{ URL::asset('assets/admin/js/validation.js') }}"></script> --}}
<!-- lobilist -->
{{-- <script src="{{ URL::asset('assets/admin/js/lobilist.js') }}"></script> --}}
<!-- custom -->
<script src="{{ URL::asset('assets/admin/js/custom.js') }}"></script>
<script>
    function openWindow(route, width = 794, height = 1123) {
        var left = (window.screen.width - width) / 2;
        var top = (window.screen.height - height) / 2;
        var windowFeatures = `top=${top},left=${left},width=${width},height=${height},resizable=no`;
        window.open(route, '_blank', windowFeatures);
    }
    </script>