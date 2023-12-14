<div>
    <h2 class="text-3xl font-bold mx-20">All Memes</h2>
     @foreach ($memes as $key => $meme)
        <div class="mx-20 p-4 w-1/2 my-5 bg-slate-400">
            <h2 class="text-2xl font-semibold">{{ $meme->title }}</h2>
            <p>{{ $meme->caption }}</p>
            <i>by: {{ $meme->user->name }}</i>
            <img src="/storage/meme/{{ $meme->pics }}" alt="gambar">
            @if (Auth::id() == $meme->user_id)
                <button class="bg-blue-300 my-3 p-2 rounded-sm" wire:confirm='Are you sure to delete {{ $meme->title }}'
                    wire:click='del({{ $meme }})'>Delete</button>
                <a href="/update-meme/{{ $meme->id }}"><button class="bg-red-700 p-4">Edit</button></a>
            @endif
        </div>
    @endforeach
    <div>{{ $memes }}</div>
    <button>Disini PaginasiNya</button>
</div>
