<div>
    {{-- @if (session('success'))
        <div id="notif" role="alert" class="relative w-56 px-4 transition py-3 mx-auto bg-green-100 border border-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif --}}
    <livewire:meme.show>
</div>
{{-- <script>
    setTimeout(() => {
       document.getElementById('notif').classList.add('hidden'); 
    }, 3000);
</script> --}}
