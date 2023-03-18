<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background: #343a40;">
                        <h4 class="text-white">
                            {{ $componentName }}
                        </h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                                <i class="mr-1 fas fa-plus"></i>
                                <span>Crear Nuevo</span>
                            </button>

                            <a href="{{ route('admin.permissions.assign') }}" class="ml-2 btn btn-info" id="assign-button">
                                <i class="mr-1 fas fa-plus"></i>
                                <span>Asignar Permisos</span>
                            </a>
                        </div>
                    </div>

                    <div class="p-0 card-body">

                        @include('components.search')

                        <div class="table-responsive">
                            <table class="table table-striped table-hovered">
                                <thead class="table-dark">
                                    <th width="100px" class="text-center text-light">ID</th>
                                    <th class="text-center text-light">DESCRIPCIÓN</th>
                                    <th class="text-light">ACCIONES</th>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $permission->description }}</td>
                                        <td width="150px">
                                            <a href="javascript:void(0);" wire:click="Edit({{ $permission->id }})" class="text-white btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="Confirm('{{ $permission->id }}')" class="text-white btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <div style="margin:0!important; display:grid; justify-content:center;">
                                <div class="mt-2 mb-3 text-center">
                                    Mostrando {{ $permissions->firstItem() }} - {{ $permissions->lastItem() }} de {{ $permissions->total() }} registros
                                </div>
                                <div class="d-flex justify-center">
                                    {{ $permissions->links()}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('livewire.Roles.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modal', msg => {
            $('#modal').modal('show');
        });

        window.livewire.on('permission-added', msg => {
            Swal.fire({
                icon: 'success'
                , title: 'Correcto'
                , text: '¡El registro fue creado con éxito!'
            })
            $('#modal').modal('hide');
        });
        window.livewire.on('permission-updated', msg => {
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
