<div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-sucess">
            {{ session('success') }}
        </div>
    @endif
    <form wire:submit='save'>
        <label for="title">Title</label>
        <input id="title" class="block bg-blue-400 border border-slate-600" type="text" wire:model='form.title'>
        @error('form.title')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror

        <label for="caption">Caption</label>
        <input id="caption" class="block bg-blue-400 border border-slate-600" type="text" wire:model='form.caption'>
        @error('form.caption')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror

        <input class="block" type="file" wire:model='form.pic'>
        @error('form.pic')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror
        <button type="submit">Submit</button>
    </form>
</div>
