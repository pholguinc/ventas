<div>
    @include('components.Modal.modalHead')

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>Categoría</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-tags">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Categoría">
                </div>
            </div>
            @error('name')
            <span class="ml-2 text-danger">
                {{ $message }}
            </span>
            <script>
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Por favor, rellene todos los campos necesarios'
                })

            </script>
            @enderror
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>Código</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-barcode">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="code" class="form-control" placeholder="ej: 015">
                </div>
            </div>
            @error('code')
            <span class="ml-2 text-danger">
                {{ $message }}
            </span>
            <script>
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Por favor, rellene todos los campos necesarios'
                })

            </script>
            @enderror
        </div>
    </div>

    @include('components.Modal.modalFooter')
</div>
