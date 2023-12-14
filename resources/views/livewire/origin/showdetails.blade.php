<div>
    <div>Name : {{ $og->name }}</div>
    <div>About: {{ $og->about }}</div>
    @foreach ($og->examples as $ex )
       <div>Example: {{ $ex->example }}</div> 
    @endforeach
    <div>{{ $og->origin_story }}</div>
</div>
