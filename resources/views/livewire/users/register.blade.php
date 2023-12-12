<div>
    <form wire:submit='create' class="flex flex-col w-1/2 mx-auto">
        <label for="name">Nama</label>
        <input type="text" id="name" wire:model='form.name'>
        @error('form.name')
           <div class="error">{{ $message }}</div> 
        @enderror
        <label for="username">Username</label>
        <input type="text" id="username" wire:model='form.username'>
        @error('form.username')
           <div class="error">{{ $message }}</div> 
        @enderror
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
        <button class="submit bg-red-300 rounded-sm w-1/4 mx-auto" >Submit</button>
    </form>
    {{-- <p>{{ $name }}</p>
    <p>{{ $username }}</p>
    <p>{{ $password }}</p>
    <p>{{ $email }}</p> --}}
</div>
