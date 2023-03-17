<div>
    @include('components.Modal.modalHead')

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>Nombre</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-edit">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Cámara de seguridad">
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
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <label class="mb-3" style="font-size:0.9rem;">
                    <strong>Imagen</strong>
                </label>
                <input wire:model="image" type="file" id="real-file" accept="image/*" hidden>
                    <label id="image-file" class="btn btn-primary btn-block btn-outlined" placeholder="">Seleccionar imagen</label>
                    <label for="">{{ $image }}</label>
            </div>
        </div>
    </div>

    @include('components.Modal.modalFooter')
</div>
