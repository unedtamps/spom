<nav class="mx-10 my-5">
    <div class="flex justify-start gap-4">
        <div class="flex gap-3">
            <a href="/">{{ config('app.name') }}</a>
            <img class="w-10" src="/logo/reditlogo.png" alt="logo app">
        </div>
        <x-nav-link :active="request()->routeIs('home')" href="{{ route('home') }}">Home</x-nav-link>
        <x-nav-link :active="request()->routeIs('origin')" href="{{ route('origin') }}">Origin</x-nav-link>
        <x-nav-link :active="request()->routeIs('origin-sub')" href="/origin-sub">Origin Submission</x-nav-link>
        <x-nav-link :active="request()->routeIs('origin-sub')" href="/create-meme/{{ Auth::id() }}">Create Meme</x-nav-link>
        <x-nav-link :active="request()->routeIs('create-origin')" href="/create-origin/{{ Auth::id() }}">Create Origin</x-nav-link>
        <x-nav-link>@livewire('users.logout')</x-nav-link>
    </div>
</nav>
