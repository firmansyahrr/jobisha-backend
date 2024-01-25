<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <link href="{{ asset('/dist//images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Jobisha</title>
    @yield('head')

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('/dist//css/app.css') }}" />
    <!-- END: CSS Assets-->

    @stack('styles')
</head>

<!-- END: Head -->

<body>
    @yield('content')

    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
    <script src="{{ asset('/dist/js/app.js') }}"></script>

    <!-- BEGIN: Vendor JS Assets-->
    @stack('vendors')
    <!-- END: Vendor JS Assets-->

    <!-- BEGIN: Pages, layouts, components JS Assets-->
    @stack('scripts')
    <!-- END: Pages, layouts, components JS Assets-->
</body>

</html>