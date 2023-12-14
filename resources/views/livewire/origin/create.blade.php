<div>
    @if (session('error'))
        <div>
            Error: {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div>
            Sucess: {{ session('success') }}
        </div>
    @endif
    <form wire:submit='createOrigin' class="block gap-4">
        <label class="block" for="name">Nama
            <input class="bg-slate-500" placeholder="name" id="name" type="text" wire:model='form.name'>
            @error('form.name')
                <div class="block text-sm text-red-400 error">{{ $message }}</div>
            @enderror
        </label>
        <label class="block" for="tags">Tags
            <input id="tags" class="bg-slate-500" placeholder="tags" type="text" wire:model='form.tags'>
            @error('form.tags')
                <div class="block text-sm text-red-400 error">{{ $message }}</div>
            @enderror
        </label>
        <textarea class="block" placeholder="about the origin" name="about" wire:model='form.about' id=""
            cols="30" rows="10"></textarea>
        @error('form.about')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror
        <textarea class="block" placeholder="origin story" name="origin_story" wire:model='form.origin_story' id=""
            cols="30" rows="10"></textarea>
        @error('form.origin_story')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror

        <label for="example">Example Meme</label>
        <input type="file" id="example" wire:model='form.example' multiple>
        @error('form.example')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror
        <button type="submit">Submit</button>
    </form>
</div>