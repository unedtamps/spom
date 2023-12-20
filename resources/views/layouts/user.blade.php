<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'User Profile' }}</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <main class="cd__main">
        {{ $slot }}
    </main>
    @stack('scripts')
    @livewireScripts
</body>

</html>
