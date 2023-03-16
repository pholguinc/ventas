<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <!--Detalles-->
            <div class="card card-primary">
                <div class="card-body">
                    <livewire:search>
                </div>
            </div>
         @include('livewire.Pos.partials.detail')
        </div>
        <div class="col-sm-12 col-md-4">
            <!--Total-->
            @include('livewire.Pos.partials.total')

            <!--Clientes-->
            @include('livewire.Pos.partials.customer-pos')

            <!--Venta-->

            @include('livewire.Pos.partials.payment-pos')

        </div>
    </div>
</div>
<livewire:modal-products>
<script src="{{ asset('js/onscan/onscan.js') }}"></script>
@include('livewire.Pos.scripts.scan')

