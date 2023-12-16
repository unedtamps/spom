<div>
    <button class="btn btn-success" wire:confirm='Are you sure to accept {{ $og->name }}' class="bg-green-400 p-2"
        wire:click='accepted({{ $og->id }})'>Accepted</button>
</div>
