    <div class="left">
        <a href="/user?id={{ Auth::id() }}" class="profile">
            <div class="profile-photo">
                <img src="/storage/profile/{{ Auth::user()->profile_pic ?? 'profile.jpg' }}" alt="">
            </div>
            <div class="handle">
                <h4>{{ Auth::user()->name }}</h4>
                <p class="text-muted">
                    {{ '@' . Auth::user()->username }}
                </p>
            </div>
        </a>
        <!-----------SIDEBAR------------>
        <div class="sidebar" id="mysidebar">
            <x-nav-link class="menu-item" :active="request()->routeIs('home')" href="{{ route('home') }}">
                <span><i class="uil uil-home"></i></span>
                <h3>Home</h3>
            </x-nav-link>
            <x-nav-link class="menu-item" :active="request()->routeIs('origin')" href="{{ route('origin') }}">
                <span><i class="uil uil-book-alt"></i></span>
                <h3>Origin</h3>
            </x-nav-link>
            <x-nav-link :active="request()->routeIs('explore')" class="menu-item" href="{{ route('explore') }}">
                <span><i class="uil uil-compass"></i></span>
                <h3>Explore</h3>
            </x-nav-link>
            @if (Auth::user()->role == 'admin')
                <x-nav-link class="menu-item" :active="request()->routeIs('origin-sub')" href="{{ route('origin-sub') }}">
                    <span><i class="uil uil-envelope-download"></i></span>
                    <h3>Submission</h3>
                </x-nav-link>
            @endif
            <x-nav-link class="menu-item" :active="request()->routeIs('create-origin')" href="/create-origin?id={{ Auth::id() }}">
                <span><i class="uil uil-book-medical"></i></span>
                <h3>Add Origin</h3>
            </x-nav-link>
            <a class="menu-item" href="{{ route('about') }}">
                <span><i class="uil uil-compass"></i></span>
                <h3>About</h3>
            </a>

            <livewire:users.logout>
        </div>
        <div id="show-nav">
            <button class="togglebtn" onclick="toggleNav()"><span><i style="color: white;"
                        class="uil uil-arrow-circle-left"></i></span></button>
        </div>
        <!-------------END OF SIDEBAR------------->
    </div>
