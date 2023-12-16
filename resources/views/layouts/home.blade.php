<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="css/app.css">
    @stack('scripts')
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
                    <div class="profile-photo">
                        <a wire:navigate href="/user/{{ Auth::id() }}"></a><img src="{{ Auth::user()->profile_pic }}"
                            alt="">
                    </div>
                    <livewire:users.logout>
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
    </main>
</body>

</html>
