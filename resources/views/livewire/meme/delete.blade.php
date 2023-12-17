    <button wire:click='del' class="btn btn-logout">
        @if ($delete == true)
            Deleted
        @else
            Delete
        @endif
    </button>