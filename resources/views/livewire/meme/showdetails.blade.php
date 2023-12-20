    <div class="feeds">
        <div class="feed">
            <div class="head">
                <div class="user">
                    <div class="profile-photo">
                        <img src="/storage/profile/{{ $meme->user->profile_pic ?? 'profile_pic' }}" alt="">
                    </div>
                    <div class="info">
                        <h3>{{ $meme->user->name }}</h3>
                        <small>{{ (new DateTime($meme->updated_at))->format('d F Y h:i A') }}</small>
                    </div>
                </div>
            </div>
            <div style="margin-top: 1rem;" class="meme-head">
                <h1>{{ $meme->title }}</h1>
            </div>

            <div class="photo">
                <img src="/storage/meme/{{ $meme->pics }}" alt="">
            </div>

            <div class="action-buttons">
                <div class="interaction-button">
                    <livewire:meme.like :meme='$meme'>
                        @if (Auth::id() == $meme->user_id)
                            <livewire:meme.delete :meme='$meme'>
                                <a wire:navigate href="/update-meme/{{ $meme->id }}"><button
                                        class="btn btn-second">Edit</button></a>
                        @endif
                        <a wire:navigate href="/"><button class="btn btn-second">Back</button></a>
                </div>
            </div>
        </div>
    </div>
