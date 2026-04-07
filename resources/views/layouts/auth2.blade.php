<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Simplex gestion</title>

    @include('layouts.partials.css')

    @include('layouts.partials.extracss_auth')

    <!-- Meta Pixel Code
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '768128085832071');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=768128085832071&ev=PageView&noscript=1"
    /></noscript>
     End Meta Pixel Code -->


</head>

<body class="pace-done" data-new-gr-c-s-check-loaded="14.1172.0" data-gr-ext-installed="" cz-shortcut-listen="true">
    @inject('request', 'Illuminate\Http\Request')
    @if (session('status') && session('status.success'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}"
            data-msg="{{ session('status.msg') }}">
    @endif
    <div class="container-fluid">
        <div class="row eq-height-row">
            <div class="col-md-12 col-sm-12 col-xs-12 right-col tw-pt-20 tw-pb-10 tw-px-5">
                <div class="row">
                    <div
                        class="lg:tw-w-16 md:tw-h-16 tw-w-12 tw-h-12 tw-flex tw-items-center tw-justify-center tw-mx-auto tw-overflow-hidden tw-bg-white tw-rounded-full tw-p-2 tw-mb-4">
                        <img src="{{ asset('img/logo-small.png')}}" alt="lock" class="tw-rounded-full tw-object-fill" />
                    </div>


                    <div class="tw-absolute tw-top-5 md:tw-top-8 tw-right-5 md:tw-right-10 tw-flex tw-items-center tw-gap-4"
                        style="text-align: left">
                        @if (!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                            <!-- Register Url -->

                            {{-- <span
                                class="tw-text-white tw-font-medium tw-text-sm md:tw-text-base">{{ __('business.not_yet_registered') }}
                            </span> --}}

                            <div class="tw-border-2 tw-border-white tw-rounded-full tw-h-10 md:tw-h-12 tw-w-24 tw-flex tw-items-center tw-justify-center">
                             <a href="{{ route('business.getRegister')}}"
                                    class="tw-text-white tw-font-medium tw-text-sm md:tw-text-base hover:tw-text-white">
                                    {{ __('business.register') }}</a>
                            </div>


                        @endif
                        @if ($request->segment(1) != 'login')
                            <a class="tw-text-white tw-font-medium tw-text-sm md:tw-text-base hover:tw-text-white"
                                href="{{ action([\App\Http\Controllers\Auth\LoginController::class, 'login'])}}">{{ __('business.sign_in') }}</a>
                        @endif
                    </div>
                    <div class="col-md-10 col-xs-8" style="text-align: right;">

                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>


    @include('layouts.partials.javascripts')

    @yield('javascript')
    
    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2_register').select2();

            // $('input').iCheck({
            //     checkboxClass: 'icheckbox_square-blue',
            //     radioClass: 'iradio_square-blue',
            //     increaseArea: '20%' // optional
            // });
        });
    </script>
    <style>
        .wizard>.content {
            background-color: white !important;
        }
    </style>
</body>

</html>
