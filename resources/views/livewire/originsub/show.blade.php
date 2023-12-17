<div wire:key='$refreshState'>
    @if (session('error'))
        <div>
            Error: {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div>
            Success : {{ session('success') }}
        </div>
    @endif
    <div class="feeds">
        <div class="feed">
            <div class="statistic">
                <div class="stats">
                    <h3>Meme</h3>
                    <div>
                        <h4>{{ $total_meme }}</h4>
                    </div>
                </div>
                <div class="stats">
                    <h3>Origin</h3>
                    <div>
                        <h4>{{ $total_origin }}</h4>
                    </div>
                </div>
                <div class="stats">
                    <h3>Submited</h3>
                    <div>
                        <h4>{{ $total_submited }}</h4>
                    </div>
                </div>
                <div class="stats">
                    <h3>User</h3>
                    <div>
                        <h4>{{ $total_user }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        @foreach ($ogsub as $og)
            <div class="feeds">
                <div class="feed" style="gap: 1rem">
                    <div style="text-align: center;margin-bottom: 1rem">
                        <h1 style="text-align: center">{{ $og->name }}</h1>
                        <small>
                            {{ (new DateTime($og->updated_at))->format('d F Y h:i A') }}
                        </small>
                        <p style="margin-top: 0.4rem"><a
                                style="background: #5FBDFF; padding: 0.2rem 1rem 0.2rem 1rem;border-radius: 1rem;"
                                wire:navigate href="/user/{{ $og->user->id }}">{{ '@' . $og->user->username }}</a></p>
                    </div>
                    <h2>About</h2>
                    <p>{!! $og->about !!}</p>
                    <div
                        style="display: flex;flex-wrap: wrap;gap: 1rem; margin: 1rem 0rem 1rem 0rem;justify-content: center;align-items: center">
                        <livewire:originsub.delete :og="$og">
                            <livewire:originsub.accepted :og="$og">
                                @if ($og->origins)
                                    <a wire:navigate href="/origin/{{ $og->origins->id }}"><button
                                            class="btn btn-primary">Origin</button></a>
                                @endif
                                <a wire:navigate href="/origin-sub/{{ $og->id }}"><button
                                        class="btn btn-second">Details</button></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
