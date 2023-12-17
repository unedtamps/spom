<div>
    <div class="stories">
        @foreach ($trends as $t)
            <div style="background: url({{ config('app.url') }}/storage/meme/{{ $t->pics }}) no-repeat center center/cover;"
                class="story">
                <div class="profile-photo">
                    <img src="/storage/profile/{{ $t->user->profile_pic }}" alt="">
                </div>
                <p class="name">{{ $t->user->name }}</p>
            </div>
        @endforeach
    </div>

    <div class="feeds">
        @foreach ($memes as $key => $meme)
            <div class="feed">
                <div class="head">
                    <div class="user">
                        <div class="profile-photo">
                            <img src="./images/profile-12.jpg" alt="">
                        </div>
                        <div class="info">
                            <h3>{{ $meme->user->name }}</h3>
                            <small>{{ (new DateTime($meme->updated_at))->format('d F Y h:i A') }}</small>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 1rem;" class="meme-head">
                    <h1>{{ $meme->title }}</h1>
                    <div>{{ $meme->caption }}</div>
                </div>

                <div class="photo">
                    <img src="/storage/meme/{{ $meme->pics }}" alt="">
                </div>

                <div class="action-buttons">
                    <div class="interaction-button">
                        <livewire:meme.like :meme='$meme'>
                        @if (Auth::id() == $meme->user_id)
                            <button wire:click='del({{ $meme }})'
                                wire:confirm='Are you sure to delete {{ $meme->title }}'
                                class="btn btn-logout">Delete</button>
                            <a wire:navigate href="/update-meme/{{ $meme->id }}"><button class="btn btn-second">Edit</button></a>
                        @endif
                    </div>
                    <div class="bookmark">
                        <span><i class="uil uil-bookmark"></i></span>
                    </div>
                </div>
                <div class="liked-by">
                    @foreach ($meme->likesby as $key => $like)
                        <span><img src="/storage/profile/{{ $like->user->profile_pic }}" alt=""></span>
                        @if ($key == 3)
                        @break
                    @endif
                @endforeach
                <p>Liked by <b>{{ count($meme->likesby) != 0 ? $meme->likesby[0]->user->name : 'nobody' }}</b>
                    @if (count($meme->likesby) > 1)
                        and
                        <b>{{ count($meme->likesby) - 1 }} others
                        </b>
                    @endif
                </p>
            </div>
            {{-- <div class="caption">
                <p><b>{{ $meme->user->name }}</b>{{ $meme->caption }}</p>
            </div> --}}
            {{-- <div class="comments text-muted">View all 107 comments</div> --}}
        </div>
    @endforeach
</div>
<button class="btn">Disini PaginasiNya</button>
{{-- <div>{{ $memes }}</div> --}}
