<div>
    @include('components.Modal.modalHead')

    <div class="row">
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
        <div class="col-sm-12 col-md-4">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>Código</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-barcode">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="code" class="form-control" placeholder="ej: 025897">
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
        <div class="col-sm-12 col-md-4">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>Stock</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-box">
                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="stock" class="form-control" placeholder="ej: 1">
                </div>
                @error('stock')
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
        <div class="col-sm-12 col-md-4">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>P. Compra</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-truck">
                            </span>
                        </span>
                    </div>
                    <input type="number" wire:model.lazy="cost" class="form-control" placeholder="ej: 0.00">
                </div>
                @error('cost')
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
        <div class="col-sm-12 col-md-4">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>P. Venta</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-shopping-cart">
                            </span>
                        </span>
                    </div>
                    <input type="number" wire:model.lazy="price" class="form-control" placeholder="ej: 0.00">
                </div>

                @error('price')
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
        <div class="col-sm-6">
            <div class="form-group">
                <label style="font-size:0.9rem;">
                    <strong>Categoría</strong>
                </label>
                <div class="input-group">
                    <div class="input-group-preprend">
                        <span class="input-group-text bg-dark">
                            <span class="text-white fas fa-indent">
                            </span>
                        </span>
                    </div>
                    <select wire:model.lazy="category_id" class="form-control">
                            <option value="Elegir" disabled>Elegir</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('category_id')
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
        <div class="col-sm-6">
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

