<div>
    @include('components.Modal.modalHead')

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>Nombre</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-tags">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Nombre">
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
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>DNI</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-tags">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="dni" class="form-control" placeholder="ej: Número de DNI">
                    <div class="input-group-preprend ml-2">
                        <a wire:click="searchUser" class="input-group-text bg-dark" style="text-decoration: none;">
                            <span class="text-white fas fa-search">
                            </span>
                            <span class="ml-1 text-white">Buscar</span>
                        </a>
                    </div>
                </div>
            </div>
            @error('dni')
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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>Teléfono</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-tags">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="phone" class="form-control" placeholder="ej: 905 326 45">
                </div>
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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>Email</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-tags">
                            </span>
                        </span>
                    </div>
                    <input type="email" wire:model.lazy="email" class="form-control" placeholder="ej: holguinpedro90@gmail.com">
                </div>
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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>Contraseña</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-tags">
                            </span>
                        </span>
                    </div>
                    <input type="password" wire:model.lazy="password" class="form-control">
                </div>
            </div>
            @error('password')
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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>Estado</strong>
                </label>
                <select wire:model.lazy="status" class="form-control">
                    <option value="Elegir" disabled>Elegir</option>
                    <option value="Active" selected>Activo</option>
                    <option value="Locked" selected>Bloqueado</option>
                </select>
            </div>
            @error('status')
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
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="" style="font-size:0.9rem;">
                    <strong>Asignar Rol</strong>
                </label>
                <select wire:model.lazy="profile" class="form-control">
                    <option value="Elegir" disabled>Elegir</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('profile')
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
