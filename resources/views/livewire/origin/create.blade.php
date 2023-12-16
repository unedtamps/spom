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


    <form wire:submit='createOrigin' class="">
        <div class="form-input">
            <label class="" for="name">
                <h3>Name</h3>
                <input class="input-name" placeholder="name" id="name" type="text" wire:model='form.name'>
                @error('form.name')
                    <div class="error-input">{{ $message }}</div>
                @enderror
            </label>
            <label for="about">
                <h3>About</h3>
            </label>
            <textarea class="" placeholder="" name="about" wire:model='form.about' id="about" cols="30"
                rows="10"></textarea>
            @error('form.about')
                <div class="error-input">{{ $message }}</div>
            @enderror
            <label for="origin_story">
                <h3>Origin Story</h3>
            </label>
            <textarea name="origin_story" wire:model='form.origin_story' id="origin_story" cols="30" rows="10"></textarea>
            @error('form.origin_story')
                <div class="error-input">{{ $message }}</div>
            @enderror
            <label for="spread">
                <h3>Spread</h3>
            </label>
            <textarea class="" placeholder="" name="spread" wire:model='form.spread' id="" cols="30"
                rows="10"></textarea>
            @error('form.spread')
                <div class="error-input">{{ $message }}</div>
            @enderror

            <label for="example">
                <h3>Example Meme <span style="font-size: 10px"><i>( max:1MB )</i></span></h3>
                <input type="file" class="input-file" id="example" wire:model='form.example' multiple>
                @error('form.example')
                    <div class="error-input">{{ $message }}</div>
                @enderror
            </label>
            <div class="input-result">
                @foreach ($form->example as $ex)
                    <img src="{{ $ex->temporaryUrl() }}" alt="">
                @endforeach
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>