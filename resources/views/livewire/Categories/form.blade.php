@include('components.Modal.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-preprend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Categoría">
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>

@include('components.Modal.modalFooter')

