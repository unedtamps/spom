<div>
    <form wire:submit='save'>
        <div class="feeds">
            <div class="feed">
                <label for="title">
                    <h2 style="padding-left: 1rem; padding-bottom: 0">Title</h2>
                    <input wire:ignore placeholder="Enter your title" id="title" class="input-meme" wire:model='form.title' type="text"
                        wire:model='form.title'>
                    @error('form.title')
                        <div class="error-input">{{ $message }}</div>
                    @enderror
                </label>

                <div class="input-image-meme" style="padding: 1rem 0rem 1rem 1rem">
                    <label for="input-post-meme">
                        <span style="font-size: 1.1rem"><i class="uil uil-image-plus">Upload Meme</i></span>
                    </label>
                    <input id="input-post-meme" type="file" wire:model='form.pic'>
                    @error('form.pic')
                        <div class="error-input">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-result">
                    @if ($form->pic)
                        <img src="{{ $form->pic->temporaryUrl() }}" alt="">
                    @endif
                </div>
                <button class="btn btn-primary" style="margin-top: 1rem; margin-bottom: 1rem;margin-left: 1rem"
                    type="submit">Submit</button>
            </div>
        </div>
    </form>
</div>
