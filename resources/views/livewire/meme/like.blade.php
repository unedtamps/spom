    <button wire:click='likeAct' class="btn btn-success">
        @if ($like == true)
            Liked
        @else
            Like
        @endif
    </button>
