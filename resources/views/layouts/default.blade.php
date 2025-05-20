<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="shortcut icon" href="{{ asset('storage/icons/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('storage/icons/favicon.ico') }}" type="image/x-icon">

    <!-- For modern browsers -->
    <link rel="icon" type="image/png" href="{{ asset('storage/icons/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('storage/icons/favicon-16x16.png') }}" sizes="16x16">

    <!-- For iOS -->
    <link rel="apple-touch-icon" href="{{ asset('storage/icons/apple-touch-icon.png') }}">
    <title>{{ $header ?? "Image gallery" }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{$slot}}
</body>
</html>
