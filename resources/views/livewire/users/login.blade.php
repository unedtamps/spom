    <form wire:submit="login">
        <label for="chk" aria-hidden="true">Login</label>
        <input type="email" id="email" placeholder="Email" wire:model='form.email' required>
        @error('form.email')
            <div class="error">{{ $message }}</div>
        @enderror
        <input type="password" id="password" placeholder="Password" wire:model='form.password' required>
        @error('form.password')
            <div class="error">{{ $message }}</div>
        @enderror
        <button type="submit">Login</button>
        @if (session('error'))
            <div class="error-input" style="text-align: center">
                {{ session('error') }}
            </div>
        @endif
    </form>
