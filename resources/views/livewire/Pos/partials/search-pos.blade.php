<label for="buscar">
    <strong>Buscar</strong>
</label>
<input wire:model="search" wire:keydown.enter="asignFirst()" type="text" class="form-control" id="buscar">


<input  id="coder" wire:keydown.enter.prevent="$emit('scan-code', $('#coder').val())" type="text" class="form-control" placeholder="buscador codigo de barras">
@if(count($products)>0)
<div class="shadow rounded px-3 pt-3 pb-0">
    @foreach($products as $product)

    <div id="result" class="d-flex flex-row" style="">
        <div class="p-2 text-center divimg" style="">
            <img src="{{ asset('storage/products/' . $product->imagen) }}" class="img-thumbnail" width="50" height="50">
        </div>
        <div class="p-2" style="cursor: pointer;">
            <strong wire:click="asignProduct('{{ $product->name }}')">
                {{ $product->name }}
            </strong>
            <p class="card-text text-light">
                P. venta: $ {{ $product->price }}
            </p>
        </div>
    </div>
    <hr class="hr-result">
    @endforeach
</div>
@else
<small class="form-text text-muted">Comienza a teclear para que aparezcan los resultados</small>
@endif


