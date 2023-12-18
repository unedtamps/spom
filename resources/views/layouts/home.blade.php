<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    @livewireScripts
</head>

<body>
    <nav>
        <div class="container">
            <h2 class="log">
                {{ config('app.name') }}
            </h2>
            <livewire:search>
                <div class="create">
                    <div class="profile-photo photo-big">
                        <a wire:navigate href="/user/{{ Auth::id() }}"></a><img src="/storage/profile/{{ Auth::user()->profile_pic }}"
                            alt="">
                    </div>
                </div>
        </div>
    </nav>
    <main>
        <div class="container">
            <x-nav-bar />
            <div class="middle">
                {{ $slot }}
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    </main>
    @stack('scripts')
    @livewireScripts
</body>

</html>
