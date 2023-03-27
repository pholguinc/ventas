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
                                    <th class="text-center text-light">NOMBRE</th>
                                    <th class="text-center text-light">EMAIL</th>
                                    <th class="text-center text-light">DNI</th>
                                    <th class="text-center text-light">TELÉFONO</th>
                                    <th class="text-center text-light">PERFIL</th>
                                    <th class="text-center text-light">STATUS</th>
                                    <th class="text-center text-light">ACCIONES</th>
                                </thead>
                                <tbody>
                                    @if($users->count())
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $user->id }}</td>
                                        <td>{{ $user->name.' '.$user->lastname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->dni }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->profile }}</td>
                                        <td>
                                            <div class="badge {{ $user->status == 'ACTIVE' ? 'badge-success' : 'badge-danger' }}">
                                                {{ $user->status }}
                                            </div>
                                        </td>
                                        <td width="150px">
                                            <a href="javascript:void(0);" wire:click="Edit({{ $user->id }})" class="text-white btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="Confirm('{{ $user->id }}')" class="text-white btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center font-weight-bold" colspan="7">No se encontraron resultados con su búsqueda</td>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <hr>
                            <div style="margin:0!important; display:grid; justify-content:center;">
                                <div class="mt-2 mb-3 text-center">
                                    Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }} registros
                                </div>
                                <div class="d-flex justify-center">
                                    {{ $users->links()}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('livewire.Users.form')

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modal', msg => {
            $('#modal').modal('show');
        });

        window.livewire.on('user-added', msg => {
            Swal.fire({
                icon: 'success'
                , title: 'Correcto'
                , text: '¡El registro fue creado con éxito!'
            })
            $('#modal').modal('hide');
        });

    });

</script>
