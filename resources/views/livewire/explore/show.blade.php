<div>
    <div class="feeds">
        @foreach ($memes['memes'] as $meme)
            <div class="feed">
                <div class="head">
                    <div class="user">
                        <div class="info">
                            <h2>{{ $meme['author'] }}</h2>
                            <i>{{ $meme['subreddit'] }}</i>
                            <p>{{ $meme['ups'] }} upvoted on reddit</p>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 1rem;" class="meme-head">
                    <h1>{{ $meme['title'] }}</h1>
                </div>

                <div class="photo">
                    @if ($meme['nsfw'])
                        <img src="{{ $meme['url'] }}" style="filter: blur(20px)" alt="ImageLoad"
                            id="{{ basename($meme['postLink']) }}" style="width: 100%">
                    @else
                        <img src="{{ $meme['url'] }}" alt="ImageNotLoad" style="width: 100%">
                    @endif
                </div>
                @if ($meme['nsfw'])
                    <button class="btn btn-logout" onclick="showImage('{{ basename($meme['postLink']) }}')">I'm
                        18+</button>
                @endif
                <a href="{{ $meme['postLink'] }}" target="_blank"><button class="btn btn-second">Source</button></a>
            </div>
        @endforeach
        <div style="margin: 1rem;display: flex;justify-content: center; align-items: center">
            <a wire:navigate href="/explore"><button class="btn btn-success">Refresh</button></a>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function showImage(postLink) {
            var idname = "#" + postLink;
            var image = $(idname);

            var currentFilter = image.css("filter");
            if (currentFilter === "blur(20px)") {
                image.css("filter", "none");
            } else {
                image.css("filter", "blur(20px)");
            }
        }
    </script>
@endpush
