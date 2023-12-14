<div>
    <div>{{ $ogs }}</div>
    @foreach ($ogs->example_sub as $o)
       <div>{{ $o }}</div> 
    @endforeach
</div>