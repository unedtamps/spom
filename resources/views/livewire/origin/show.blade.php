<div>
    @foreach ($origin as $o )
       <div>{{ $o }}</div> 
       <button class="bg-cyan-500 p-2"><a href="/origin-edit/{{ $o->id }}">Edit</a></button>
    @endforeach
    <div>{{ $origin }}</div>
</div>
