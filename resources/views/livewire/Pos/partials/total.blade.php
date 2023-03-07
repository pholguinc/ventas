<div class="row">
    <div class="col-12">

        <div class="card card-success">
            <div class="card-header">
                <h5 class="text-center mt-2 ml-2">RESUMEN DE LA VENTA</h5>
            </div>
            <div class="card-body bg-dark">
                <h1 id="head-total" class=" text-center text-black" style="font-size:32px;">$ {{ number_format( $total,2 ) }} </h1>
                <input type="hidden" id="hiddenTotal" value="{{ $total }}">
                <h5 class="text-center text-white">Productos: {{ $itemsQuantity }}</h5>
            </div>
        </div>
    </div>
</div>
