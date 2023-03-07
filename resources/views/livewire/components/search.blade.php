<div>
    <input id="coder" wire:keydown.enter.prevent="$emit('scan-code', $('#coder').val())" type="text" class="form-control" placeholder="buscador codigo de barras">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            livewire.on('scan-code', action => {
                $('#coder').val('');
            })
        })
    </script>

</div>

