<div class="card card-primary">
    <div class="card-header">
        <div class="btn-group">
            <button class="btn btn-primary mr-3 btn" data-toggle="modal" data-target="#modalProducts">
                <i class="fas fa-search"></i>
                Buscar Productos
            </button>
        </div>
    </div>
    <div class="card-body">
        @if ($total > 0)
        <div class="table-responsive" style="max-height:650px; overflow:hidden;">
            <table class="table table-bordered table-striped mt-1">
                <thead class="text-white table-dark">
                    <tr>
                        <th width="10%"></th>
                        <th class="text-white text-left">DESCRIPCIÓN</th>
                        <th class="text-white text-left">PRECIO</th>
                        <th width="13%" class="text-white text-center">CANT</th>
                        <th class="text-white text-center">IMPORTE</th>
                        <th class="text-white text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                    <tr>
                        <td class="text-center">
                            @if(count($item->attributes) > 0)
                            <span>
                                <img src="{{ asset('storage/products/' . $item->attributes[0]) }}" alt="imagen" height="80" width="80" class="img-fluid rounded">
                            </span>
                            @endif
                        </td>
                        <td>
                            <h6>
                                {{ $item->name }}
                            </h6>
                        </td>
                        <td class="text-center">
                            {{ number_format( $item->price, 2 ) }}
                        </td>
                        <td>
                            <input type="number" name="" id="r{{ $item->id }}" wire:change="updateQty({{ $item->id }}, $('#r' + {{ $item->id }}).val() )" style="font-size:1rem!important" class="form-control text-center" value="{{ $item->quantity }}">
                        </td>
                        <td>
                            <h6>
                                $ {{ number_format( $item->price * $item->quantity, 2 )  }}
                            </h6>
                        </td>
                        <td class="text-center">
                            <button onclick="Confirm('{{ $item->id }}', 'removeItem', '¿Confrimas eliminar el registro?')" class="btn btn-dark">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <button wire:click.prevent="decreaseQty({{ $item->id }})" class="btn btn-dark">
                                <i class="fas fa-minus"></i>
                            </button>

                            <button wire:click.prevent="increaseQty({{ $item->id }})" class="btn btn-dark">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <h5 class="text-center text-danger text-muted">AGREGAR PRODUCTOS A LA VENTA</h5>
        @endif

        <div wire:loading.inline class="text-center text-danger">
            Guardando Venta...
        </div>
    </div>
</div>
