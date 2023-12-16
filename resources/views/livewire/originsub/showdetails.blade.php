<div>
    <div class="feeds">
        <div class="feed">
            <div class="head" style="display: flex; justify-content: center;text-align: center">
                <div class="user">
                    <div class="info">
                        <h1>{{ $ogs->name }}</h1>
                        <small>{{ (new DateTime($ogs->updated_at))->format('d F Y h:i A') }}</small>
                    </div>
                </div>
            </div>

            <div>
                <h2>About</h2>
                {{ $ogs->about }}
                <h2>Origin Story</h2>
                {{ $ogs->origin_story }}
                <h2>Spread</h2>
                {{ $ogs->spread }}
            </div>
            <div class="origin-example">
                <h2>Example</h2>
                <div>
                    @foreach ($ogs->example_sub as $oex)
                        <img class="origin-img" src="/storage/origin/{{ $oex->example }}" alt="">
                    @endforeach
                </div>
            </div>
            <div
                style="display: flex;flex-wrap: wrap;gap: 1rem; margin: 1rem 0rem 1rem 0rem;justify-content: center;align-items: center">
                <livewire:originsub.delete :og="$ogs">
                    <livewire:originsub.accepted :og="$ogs">
                        @if ($ogs->origins)
                            <a wire:navigate href="/origin/{{ $ogs->origins->id }}"><button
                                    class="btn btn-primary">Origin</button></a>
                        @endif
                        <a wire:navigate href="/origin-sub"><button
                                class="btn btn-second">Back</button></a>
            </div>
        </div>
    </div>
</div>
