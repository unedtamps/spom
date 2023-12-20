    <div class="main">
        <div id="notification">
            @if (session('error'))
                <small id="errorMessage">{{ session('error') }}</small>
            @elseif (session('success'))
                <small id="successMessage">{{ session('success') }}</small>
            @endif
        </div>
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <livewire:users.register>
            <a style="text-decoration: none" href="{{ route('about') }}"><button style="background-color: rgb(22, 22, 99)">About</button></a>
        </div>
        <div class="login">
            <livewire:users.login>
        </div>
    </div>

    @push('scripts')
        <script>
            setTimeout(() => {
                document.getElementById('notification').style.display = 'none'
            }, 5000);
        </script>
    @endpush
