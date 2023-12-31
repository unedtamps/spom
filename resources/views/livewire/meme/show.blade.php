<div wire:key='$refreshState'>
    <livewire:meme.create>
        <div class="feeds">
            @foreach ($memes as $key => $meme)
                <div class="feed">
                    <div class="head">
                        <a href="/user?id={{ $meme->user_id }}">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="/storage/profile/{{ $meme->user->profile_pic ?? 'profile.jpg' }}"
                                        alt="">
                                </div>
                                <div class="info">
                                    <h3>{{ $meme->user->name }}</h3>
                                    <small>{{ (new DateTime($meme->created_at))->format('d F Y h:i A') }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div style="margin-top: 1rem;" class="meme-head">
                        <h1>{{ $meme->title }}</h1>
                    </div>

                    <div class="photo">
                        <img src="/storage/meme/{{ $meme->pics }}" alt="">
                    </div>

                    <div class="action-buttons">
                        <div class="interaction-button">
                            <livewire:meme.like :meme='$meme' wire:key='{{ $key }}'>
                                @if (Auth::id() == $meme->user_id)
                                    <livewire:meme.delete :meme='$meme' wire:key='{{ $key }}'>
                                        <a wire:navigate href="/update-meme?id={{ $meme->id }}"><button
                                                class="btn btn-second">Edit</button></a>
                                @endif
                        </div>
                    </div>
                    <div class="liked-by">
                        @foreach ($meme->likesby as $key => $like)
                            <span><img src="/storage/profile/{{ $like->user->profile_pic ?? 'profile.jpg' }}"
                                    alt=""></span>
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
            </div>
        @endforeach

        <div style="margin-bottom: 2rem; display: flex; justify-content: center; gap: 1rem">
            @if ($page != 0)
                <a wire:navigate href="/home?page={{ $page - 1 }}"><button
                        class="btn btn-second">Previous</button></a>
            @endif
            @if (count($memes) == 5)
                <a wire:navigate href="/home?page={{ $page + 1 }}"><button
                        class="btn btn-primary">Next</button></a>
            @endif
        </div>
    </div>
