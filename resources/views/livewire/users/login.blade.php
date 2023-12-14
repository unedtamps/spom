<div>
    @if (session('error'))
        <div>
            Error: {{ session('error') }}
        </div>
    @endif
    <form wire:submit="login">
        <label for="email">Email</label>
        <input type="email" id="email" wire:model='form.email'>
        @error('form.email')
            <div class="error">{{ $message }}</div>
        @enderror
        <label for="password">Password</label>
        <input type="password" id="password" wire:model='form.password'>
        @error('form.password')
            <div class="error">{{ $message }}</div>
        @enderror
        <button type="submit">Login</button>
    </form>
</div>
