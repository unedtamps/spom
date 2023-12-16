<div>
    <div class="search-bar">
        <i class="uil uil-search"></i>
        <input wire:model.live='search' type="search" placeholder="Search for users, memes, and origins">
    </div>
    @if ($users || $memes || $origin)
        <div class="search-result">
            <h3>Result</h3>
            @foreach ($users as $user)
                <a wire:navigate href="/user/{{ $user->id }}">
                    <div class="search-detail">
                        <div class="profile-photo">
                            <img src="/storage/profile/{{ $user->profile_pic }}" alt="photo">
                        </div>
                        <div>
                            <h3>{{ $user->name }} ({{ $user->role }})</h3>
                        </div>
                    </div>
                </a>
            @endforeach
            @foreach ($memes as $meme)
                <a wire:navigate href="/meme/{{ $meme->id }}">
                    <div class="search-detail">
                        <div class="profile-photo">
                            <img src="/storage/meme/{{ $meme->pics }}" alt="photo">
                        </div>
                        <div>
                            <h3>{{ $meme->title }} (meme)</h3>
                        </div>
                    </div>
                </a>
            @endforeach
            @foreach ($origin as $or)
                <a wire:navigate href="/origin/{{ $or->id }}" href="">
                    <div class="search-detail">
                        <div class="profile-photo">
                            <img src="/storage/origin/{{ count($or->examples) != 0 ? $or->examples[0]->example : 'something'}}" alt="photo">
                        </div>
                        <div>
                            <h3>{{ $or->name }} (origin)</h3>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
