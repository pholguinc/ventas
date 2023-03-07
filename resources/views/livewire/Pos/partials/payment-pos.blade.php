<div class="row">
    <div class="col-12">

        <div class="card card-success">
            <div class="card-header">
                <h5 class="text-center mt-2 ml-2">DATOS DE LA VENTA</h5>
            </div>
            <div class="card-body">
                <div class="input-group mb-2">
                    <div class="input-group-preprend">
                        <button type="button" class="input-group-text bg-dark" data-toggle="modal" data-target="#modal">
                            <span class="text-white fas fa-money-bill-wave">
                            </span>
                        </button>
                    </div>
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="Descuento">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-preprend">
                        <button type="button" class="input-group-text bg-dark" data-toggle="modal" data-target="#modal">
                            <span class="text-white fas fa-money-check">
                            </span>
                        </button>
                    </div>
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="SUBTOTAL">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-preprend">
                        <button type="button" class="input-group-text bg-dark" data-toggle="modal" data-target="#modal">
                            <span class="text-white fas fa-file-invoice">
                            </span>
                        </button>
                    </div>
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="IGV">
                </div>

                <div class="input-group input-group-md mt-3 mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-dark text-white">Efectivo F8
                        </span>
                    </div>
                    <input type="number" class="form-control text-center" wire:model="efectivo" wire:keydown.enter="saveSale" value="{{ $efectivo }}">
                    <div class="input-group-append">
                        <span class="input-group-text bg-dark text-white">
                            <i class="fas fa-backspace fa-2x"></i>
                        </span>
                    </div>
                </div>

                <h4 class="text-muted">Cambio: ${{ number_format( $change, 2 ) }}</h4>

                <div class="row justify-between mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        @if ($total>0)
                            <button onclick="Confirm('','clearCart' ,'¿Estás seguro de limpiar el carrito?')" class="btn btn-dark">
                                CANCELAR F4
                            </button>
                        @endif
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-6">
                        @if ($efectivo >= $total && $total > 0)
                        <button wire:click.prevent="saveSale" class="btn btn-dark btn-block">GUARDAR F9</button>
                        @endif
                    </div>
                </div>
            </div>
          </div>

    </div>
</div>
