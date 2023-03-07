<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background: #343a40;">
                        <h4 class="text-white">
                            {{ $pageTitle }} | {{ $componentName }}
                        </h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                                <i class="mr-1 fas fa-plus"></i>
                                <span>Crear Nuevo</span>
                            </button>
                        </div>
                    </div>

                    <div class="p-0 card-body">

                        @include('components.search')

                        <div class="table-responsive">
                            <table class="table table-striped table-hovered">
                                <thead class="table-dark">
                                    <th width="100px" class="text-center text-light">ID</th>
                                    <th class="text-light">CÓDIGO</th>
                                    <th class="text-light">IMAGEN</th>
                                    <th class="text-light">NOMBRE</th>
                                    <th class="text-light">STOCK</th>
                                    <th class="text-light">P.COMPRA</th>
                                    <th class="text-light">P.VENTA</th>
                                    <th class="text-light">ACCIONES</th>
                                </thead>
                                <tbody>
                                    @if($data->count())
                                    @foreach ($data as $product)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $product->code }}</td>
                                        <td>
                                            <img id="light-image" src="{{ asset('storage/products/' . $product->imagen) }}" alt="{{ $product->name }}" class="img-fluid" width="70" height="80">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            @if ($product->stock == 0)
                                            <span class="badge badge-danger">{{ $product->stock }}</span>
                                            @else
                                            <span class="badge badge-success">{{ $product->stock }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $product->cost }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">{{ $product->price }}</span>
                                        </td>
                                        <td width="150px">
                                            <a href="javascript:void(0);" wire:click="Edit({{ $product->id }})" class="text-white btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="Confirm('{{ $product->id }}')" class="text-white btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center font-weight-bold" colspan="8">No se encontraron resultados con su búsqueda</td>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="row" style="margin:0!important;">
                                <div class="col-sm-7">
                                    <div class="float-left mt-2">
                                        Mostrando {{ $data->firstItem() }} - {{ $data->lastItem() }} de {{ $data->total() }} registros
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="float-right">
                                        {{ $data->links()}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include('livewire.Products.form')

</div>

<script>
    const realFileBtn = document.getElementById("real-file");
    const imageFile = document.getElementById("image-file");
    const customTxt = document.getElementById("custom-text");

    imageFile.addEventListener("click", function() {
        realFileBtn.click();
    })


    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modal', msg => {
            $('#modal').modal('show');
        });

        window.livewire.on('product-added', msg => {
            Swal.fire({
                icon: 'success'
                , title: 'Correcto'
                , text: '¡El registro fue creado con éxito!'
            })
            $('#modal').modal('hide');
        });
        window.livewire.on('product-update', msg => {
            Swal.fire({
                icon: 'success'
                , title: 'Correcto'
                , text: '¡El registro fue actualizado con éxito!'
            })
            $('#modal').modal('hide');
        });

    });

    function Confirm(id) {
        Swal.fire({
            title: '¿Estás seguro de eliminar el registro?'
            , text: "¡Al eliminarlo no hay opción a recuperarlo!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Sí, quiero eliminarlo'
            , cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('deleteRow', id)
                Swal.fire(
                    '¡Eliminado!'
                    , '¡Su registro fue eliminado con éxito!'
                    , 'success'
                )
            }
        })
    }

</script>
