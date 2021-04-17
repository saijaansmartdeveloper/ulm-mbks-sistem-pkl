<script type="text/javascript" src="{{ asset('public_assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public_assets/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('public_assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public_assets/js/jquery.mCustomScrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('public_assets/lib/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public_assets/js/scrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('public_assets/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('public_assets/js/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@laravelViewsScripts()

<script>
    $(document).on('click', '.page-link-scroll-to-top', function (e) {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="{{ asset('public_assets/toastr/toastr.min.js') }}"></script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

@if(session()->has('success'))
    <script>
        $(function() {
            toastr.success('{{ session()->get('success') }}', 'Yee!')
        });
    </script>
    @php
        session()->forget('success');
    @endphp
@endif

@if(session()->has('error'))
    <script>
        $(function() {
            toastr.error('{{ session()->get('error') }}', 'Oh Tidak!')
        });
    </script>
    @php
        session()->forget('error');
    @endphp
@endif

<script>
    window.addEventListener('success', event => {
        toastr.success(event.detail.message, 'Yee!');
    })
    window.addEventListener('error', event => {
        toastr.error(event.detail.message, 'Oh Tidak!');
    })
</script>

@stack('js')

