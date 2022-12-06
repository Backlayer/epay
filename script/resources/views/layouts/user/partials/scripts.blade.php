<!-- Core -->
<script src="{{ asset('user/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('user/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('user/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('user/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>

<script src="{{ asset('plugins/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-confirm-js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('user/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('user/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/clipboard-js/clipboard.min.js') }}"></script>

@yield('script')
@stack('script')

<!-- Argon JS -->
<script src="{{ asset('user/js/argon.min.js') }}"></script>
<!-- Demo JS - remove this in your project -->
<script src="{{ asset('user/js/demo.min.js') }}"></script>

<script src="{{ asset('plugins/custom/custom.js') }}"></script>
<script src="{{ asset('plugins/custom/form.js') }}"></script>
<script src="{{ asset('plugins/custom/Notify.js') }}"></script>
<script src="{{ asset('user/custom.js') }}"></script>

@if(session('success'))
    <script>
        Notify('success', null, '{{ Session::get('success') }}')
    </script>
@endif

@if(Session::has('warning'))
    <script>
        Notify('warning', null, '{{ Session::get('warning') }}')
    </script>
@endif

@if(Session::has('error'))
    <script>
        Notify('error', null, '{{ Session::get('error') }}')
    </script>
@endif
