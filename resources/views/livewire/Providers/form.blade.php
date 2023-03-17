<div>
    @include('components.Modal.modalHead')

    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>RUC</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white far fa-address-card">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="ruc" class="form-control" placeholder="ej: 20422521263">
                    <div class="input-group-preprend ml-2">
                        <a wire:click="searchProvider" class="input-group-text bg-dark" style="text-decoration: none;">
                            <span class="text-white fas fa-search">
                            </span>
                            <span class="ml-1 text-white">Buscar</span>
                        </a>
                    </div>
                </div>
                @error('ruc')
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
        <div class="col-sm-12 col-md-8">
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
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Nombre del proveedor">
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

        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>Teléfono</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-phone" style="transform: rotate(95deg)">
                            </span>
                        </span>
                    </div>
                    <input type="phone" wire:model.lazy="phone" class="form-control" placeholder="ej: 123456789">
                </div>
                @error('phone')
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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>Correo</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-envelope">
                            </span>
                        </span>
                    </div>
                    <input type="email" wire:model.lazy="email" class="form-control" placeholder="ej: email@email.com">
                </div>
                @error('email')
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
        <div class="col-sm-12">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>Dirección</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-shopping-cart">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="address" class="form-control" placeholder="ej: Av. Las Palmeras 123">
                </div>

                @error('address')
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
    </div>

    @include('components.Modal.modalFooter')
</div>

