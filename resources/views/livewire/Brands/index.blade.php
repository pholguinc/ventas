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
                                    <th width="15%" class="text-center text-light">FOTO</th>
                                    <th class="text-center text-light">NOMBRE</th>
                                    <th class="text-light">ACCIONES</th>
                                </thead>
                                <tbody>
                                    @if ($brands->count())
                                        @foreach ($brands as $brand)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td width="15%" class="text-center">
                                                <img id="light-image" src="{{ asset('storage/brands/' . $brand->imagen) }}" alt="{{ $brand->name }}" class="mt-2 img-fluid" width="70" height="80">
                                            </td>
                                            <td class="text-center">{{ $brand->name }}</td>
                                            <td width="150px">
                                                <a href="javascript:void(0);" wire:click="Edit({{ $brand->id }})" class="text-white btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="Confirm('{{ $brand->id }}')" class="text-white btn btn-danger">
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
                            <hr>
                            <div class="float-right pr-5">
                                    {{ $brands->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('livewire.Brands.form')

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

        window.livewire.on('brand-added', msg => {
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
