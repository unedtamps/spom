<div>
    @if ($form->about != '' || $form->origin_story != '' || $form->spread != '')
        <div class="feeds">
            <div class="feed">
                <div class="info" style="text-align: center ">
                    <h1>{{ $form->name }}</h1>
                </div>
                <div>
                    <h2>About</h2>
                    {!! $form->about !!}
                    <h2>Origin Story</h2>
                    {!! $form->origin_story !!}
                    <h2>Spread</h2>
                    {!! $form->spread !!}
                </div>
                <h2>Example</h2>
                <div class="input-result">
                    @foreach ($form->example as $ex)
                        <img src="{{ $ex->temporaryUrl() }}" alt="">
                    @endforeach
                </div>
            </div>
        </div>
    @endif
        <div style="display: flex; justify-content: center;align-items: center;margin-bottom: 2rem">
            <a wire:navigate href="/origin-edit?id={{ $origin->id }}" style="color: white"><button
                    class="btn btn-primary">Click This If Origin Not Changed</button></a>
        </div>
    <form wire:submit='save' class="">
        <div class="form-input">
            <label class="" for="name">
                <h3>Name</h3>
                <input class="input-name" placeholder="name" id="name" type="text" cols="10" rows="30"
                    wire:model.blur='form.name'>
                @error('form.name')
                    <div class="error-input">{{ $message }}</div>
                @enderror
            </label>
            <label for="about">
                <h3>About</h3>
            </label>
            <div wire:ignore>
                <textarea class="" placeholder="" name="about" wire:model='form.about' id="about" cols="10"
                    rows="20"></textarea>
            </div>
            @error('form.about')
                <div class="error-input">{{ $message }}</div>
            @enderror

            <label for="origin_story">
                <h3>Origin Story</h3>
            </label>
            <div wire:ignore>
                <textarea name="origin_story" wire:model='form.origin_story' id="origin_story" cols="10" rows="20"></textarea>
            </div>
            @error('form.origin_story')
                <div class="error-input">{{ $message }}</div>
            @enderror

            <label for="spread">
                <h3>Spread</h3>
            </label>
            <div wire:ignore>
                <textarea class="" placeholder="" name="spread" wire:model='form.spread' id="spread" cols="10"
                    rows="20"></textarea>
            </div>
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
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        $(function() {
            $('#about').summernote({
                placeholder: '',
                tabsize: 2,
                height: 200,
                code: @json($form->origin_story),
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('form.about', contents)
                    },
                }
            })
        })
        $(function() {
            $('#origin_story').summernote({
                placeholder: '',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('form.origin_story', contents)
                    },
                }
            })
        })
        $(function() {
            $('#spread').summernote({
                placeholder: '',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        console.log($editable)
                        @this.set('form.spread', contents)
                    },
                }
            })
        })
    </script>
@endpush
