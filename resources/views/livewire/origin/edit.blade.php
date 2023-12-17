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
    <form wire:submit='save' class="block gap-4">
        <label class="block" for="name">Nama
            <input class="bg-slate-500" placeholder="name" id="name" type="text" wire:model='form.name'>
            @error('form.name')
                <div class="block text-sm text-red-400 error">{{ $message }}</div>
            @enderror
        </label>
        <div wire:ignore>
            <textarea class="" name="about" wire:model='form.about' id="about"></textarea>
        </div>
        @error('form.about')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror
        <div wire:ignore>
            <textarea name="origin_story" wire:model='form.origin_story' id="origin_story"></textarea>
        </div>
        @error('form.origin_story')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror
        <div wire:ignore>
            <textarea name="spread" wire:model='form.spread' id="spread"></textarea>
        </div>

        <label for="example">Example Meme</label>
        <input type="file" id="example" wire:model='form.example' multiple>
        @error('form.example')
            <div class="block text-sm text-red-400 error">{{ $message }}</div>
        @enderror
        <button type="submit">Submit</button>
    </form>
</div>

@push('scripts')
    <script>
        $('#spread').summernote('code', @json($form->spread));
        $('#about').summernote('code', @json($form->about))
        $('#origin_story').summernote('code', @json($form->origin_story))
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
                    @this.set('form.spread', contents)
                },
            }
        });
        $('#about').summernote({
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
                    @this.set('form.about', contents)
                },
            }
        });
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
        });
    </script>
@endpush
