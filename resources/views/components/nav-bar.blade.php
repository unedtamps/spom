<nav class="mx-10 my-5">
    <div class="flex justify-start gap-4">
        <div class="flex gap-3">
            <a href="/">{{ config('app.name') }}</a>
            <img src="" alt="logo app">
        </div>
        <x-nav-link :active="request()->routeIs('home')" href="{{ route('home') }}">Home</x-nav-link>
        <x-nav-link :active="request()->routeIs('register')" :href="route('register')">Register</x-nav-link>
    </div>
</nav>