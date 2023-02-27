</div>
<div class="modal-footer bg-whitesmoke br">
    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn" data-dismiss="modal">Cerrar</button>

    <div>
        @if($selected_id < 1) <button type="button" wire:click.prevent="Store()" class="btn btn-primary close-modal">Guardar</button>
    @else
        <button type="button" wire:click.prevent="Update()" class="btn btn-primary close-modal">Actualizar</button>
    @endif
    </div>

</div>
</div>
