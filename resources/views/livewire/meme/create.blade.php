<div>
    <form wire:submit='save'>
        <div class="form-input">
            <label for="title">
                <h4>Title</h4>
                <input id="title" class="input-name" type="text" wire:model='form.title'>
                @error('form.title')
                    <div class="error-input">{{ $message }}</div>
                @enderror
            </label>
            <label for="caption">
                <h4>Caption</h4>
                <input id="caption" class="input-name" type="text" wire:model='form.caption'>
                @error('form.caption')
                    <div class="error-input">{{ $message }}</div>
                @enderror
            </label>

        </div>
        <input class="input-file" style="margin-bottom: 2rem" type="file" wire:model='form.pic'>
        @error('form.pic')
            <div class="error-input">{{ $message }}</div>
        @enderror
        <div class="input-result">
            @if ($form->pic)
                <h3>Preview</h3>
                <img src="{{ $form->pic->temporaryUrl() }}" alt="">
            @endif
        </div>
        <button class="btn btn-primary" style="margin-top: 2rem; margin-bottom: 2rem" type="submit">Submit</button>
    </form>
    @if (session('error'))
        <div class="error-input">{{ session('error') }}</div>
    @endif
</div>
