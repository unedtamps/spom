<div>
    <button class="btn btn-logout" wire:confirm='Are you sure to deny {{ $og->name }}' class="bg-red-400 p-2"
        wire:click='denied'>Denied</button>
</div>
