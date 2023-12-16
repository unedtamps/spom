    <div class="left">
        <a wire:navigate href="/user/{{ Auth::id() }}" class="profile">
            <div class="profile-photo">
                <img src="/storage/user/{{ Auth::user()->profile_pic }}" alt="">
            </div>
            <div class="handle">
                <h4>{{ Auth::user()->name }}</h4>
                <p class="text-muted">
                    {{ '@' . Auth::user()->username }}
                </p>
            </div>
        </a>
        <!-----------SIDEBAR------------>
        <div class="sidebar">
            <x-nav-link class="menu-item" :active="request()->routeIs('home')" href="{{ route('home') }}">
                <span><i class="uil uil-home"></i></span>
                <h3>Home</h3>
            </x-nav-link>
            <x-nav-link class="menu-item" :active="request()->routeIs('origin')" href="{{ route('origin') }}">
                <span><i class="uil uil-compass"></i></span>
                <h3>Origin</h3>
            </x-nav-link>
            <a class="menu-item">
                <span><i class="uil uil-compass"></i></span>
                <h3>Explore</h3>
            </a>
            <a class="menu-item">
                <span><i class="uil uil-bookmark"></i></span>
                <h3>Bookmarks</h3>
            </a>
            @if (Auth::user()->role == 'admin')
                <x-nav-link class="menu-item" :active="request()->routeIs('origin-sub')" href="{{ route('origin-sub') }}">
                    <span><i class="uil uil-envelope-download"></i></span>
                    <h3>Submission</h3>
                </x-nav-link>
            @endif
        </div>
        <!-------------END OF SIDEBAR------------->
        <x-nav-link class="btn btn-primary" :active="request()->routeIs('create-meme')" href="/create-meme/{{ Auth::id() }}">Create
            Meme</x-nav-link>
        <x-nav-link class="btn btn-primary" :active="request()->routeIs('create-origin')" href="/create-origin/{{ Auth::id() }}">Create
            Origin</x-nav-link>
    </div>
