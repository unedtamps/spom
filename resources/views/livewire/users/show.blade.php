    <div class="profile-page">
        <div class="content">
            <div class="content__cover">
                <div class="content__avatar">
                    @if ($pic)
                        <img src="{{ $pic->temporaryUrl() }}" alt="" />
                    @else
                        <img src="/storage/profile/{{ $user->profile_pic ?? 'profile.jpg' }}" alt="" />
                    @endif
                </div>
                <div class="content__bull">
                    <span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>

            <div class="content__actions">
                <a href="{{ route('home') }}">
                    <span><i class="uil uil-previous"></i></span><span>Back</span>
                </a>
            </div>

            <form wire:submit='save' style="display: none" id="form-profile">
                <input id="profile-pic" wire:model='pic' type="file">
            </form>

            <div class="content__title">
                @if (Auth::id() == $user->id)
                    <label for="profile-pic" style="padding: 0.5rem; border-radius: 0.5rem;"><span
                            class="btn btn-primary"
                            style="padding: 0.5rem;border-radius: 10px ;border-radius: 0.5rem"><i
                                class="uil uil-user-circle"> Change Profile</i></span></label>
                    <button wire:click='save' class="btn btn-primary"
                        style="padding: 0.5rem;border-radius: 10px ;background: rgb(132, 255, 0);border-radius: 0.5rem;color: black"><span><i
                                class="uil uil-save">Save</i></span></button>

                    @error('pic')
                        <div class="error-input">{{ $message }}</div>
                    @enderror
                @endif
                <h1>{{ $user->name }}</h1>
                <i>{{ '@' . $user->username }}</i>
                <h2>{{ $user->role }}</h2>
            </div>
            <div class="content__description">
            </div>
            <ul class="content__list">
                <li><span>{{ $user->detail->meme_posted }}</span>Posted Meme</li>
                <li><span>{{ $user->detail->origin_created }}</span>Created Origin</li>
                <li><span>{{ $user->detail->origin_denied }}</span>Denied Origin</li>
                <li><span>{{ $user->detail->origin_accepted }}</span>Accepted Origin</li>
                <li><span>{{ $user->detail->meme_likes }}</span>Liking Meme</li>
                <li><span>{{ $get_like }}</span>Liked Meme</li>
            </ul>
        </div>
        <div class="bg">
            <div>
                <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>
