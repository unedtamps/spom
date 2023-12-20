<div>
    <div class="feeds">
        @foreach ($origin as $key => $og)
            <div class="feed">
                <div class="head" style="display: flex; justify-content: center;text-align: center">
                    <div class="user">
                        <div class="info">
                            <h1>{{ $og->name }}</h1>
                            <small>{{ (new DateTime($og->updated_at))->format('d F Y h:i A') }}</small>
                        </div>
                    </div>
                </div>

                <div>
                    <h2>About</h2>
                    {!! $og->about !!}
                </div>
                <div class="origin-example">
                    <h2>Example</h2>
                    <div class="photo">
                        @foreach ($og->examples as $oex)
                            <img class="origin-img" src="/storage/origin/{{ $oex->example }}" alt="">
                        @endforeach
                    </div>
                </div>
                <div class="action-buttons">
                    <div class="interaction-button">
                        <a wire:navigate href="/origin-edit?id={{ $og->id }}"><button class="btn btn-primary"
                                style="margin-bottom: 1rem;">Contribute</button></a>
                        <a href="/origin-details?id={{ $og->id }}&page={{ $page }}"><button
                                class="btn btn-success">Details</button></a>
                    </div>
                </div>
                <div>
                    <h4>Contributors :
                        @foreach ($og->contributors as $oc)
                            <a href="/user?id={{ $oc->user_id }}"> <i>{{ '@' . $oc->user->username . '  ' }}</i></a>
                        @endforeach
                    </h4>
                </div>

            </div>
        @endforeach
        <div style="margin-bottom: 2rem; display: flex; justify-content: center; gap: 1rem">
            @if ($page != 0)
                <a wire:navigate href="/origin?page={{ $page - 1 }}"><button
                        class="btn btn-second">Previous</button></a>
            @endif
            @if (count($origin) == 5)
                <a wire:navigate href="/origin?page={{ $page + 1 }}"><button
                        class="btn btn-primary">Next</button></a>
            @endif
        </div>
    </div>
</div>
