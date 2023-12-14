<div>
    @if (session('error'))
        <div>
            Error: {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div>
            Success : {{ session('success') }}
        </div>
    @endif
    @foreach ($ogsub as $og)
        <div>{{ $og->name }}
            <div>Example:
                @foreach ($og->example_sub as $ex)
                    <img class="w-[40%]" src="/storage/origin/{{ $ex->example }}" alt="">
                @endforeach
            </div>
        </div>
        <div>
            <button class="bg-red-400 p-2" wire:click='denied({{ $og->id }})'>Denied</button>
            <button class="bg-green-400 p-2" wire:click='accepted({{ $og->id }})'>Accepted</button>
        </div>
        <hr>
    @endforeach
</div>
