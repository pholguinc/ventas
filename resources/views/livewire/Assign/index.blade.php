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
                    </div>
                </div>

                <div class="p-0 card-body">

                    <div class="form-inline p-2">
                        <select wire:model="role" class="mr-3 form-control">
                            <option value="Elegir" disabled>::::: Selecciona el rol :::::</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <button wire:click.prevent='SyncAll()' class="btn btn-dark d-block">
                            Sincronizar Todos
                        </button>

                        <button onclick="Remove()" class="ml-3 btn btn-dark d-block">
                            Remover Todos
                        </button>
                    </div>


                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hovered">
                                    <thead class="table-dark">
                                        <th width="100px" class="text-center text-light">ID</th>
                                        <th class="text-center text-light">PERMISOS</th>
                                        <th class="text-center text-light">CONTADOR</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="p-0 text-center">
                                                <div class="pretty p-svg p-curve">
                                                    <input type="checkbox" wire:change="SyncPermissions($('#p' + {{ $permission->id }}).is(':checked'), '{{ $permission->name }}' )" id="p{{ $permission->id }}" value="{{ $permission->id }}" {{ $permission->checked == 1 ? 'checked' : '' }}>
                                                    <div class="state p-primary">
                                                        <!-- svg path -->
                                                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                                                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                                        </svg>
                                                        <label>{{ $permission->description }}</label>
                                                    </div>
                                                </div>

                                            </td>
                                            <td class="text-center">
                                                {{ $roleCount }}
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

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.livewire.on('sync-error', msg => {

                iziToast.error({
                    title: '¡Error!'
                    , message: msg
                    , position: 'topRight'
                });


            });

            window.livewire.on('remove-all', msg => {

                iziToast.success({
                    title: '¡Correcto!'
                    , message: msg
                    , position: 'topRight'
                });


            });

            window.livewire.on('permi', msg => {

                iziToast.error({
                    title: '¡Error!'
                    , message: msg
                    , position: 'topRight'
                });


            });

            window.livewire.on('permi-sync', msg => {

                iziToast.success({
                    title: '¡Correcto!'
                    , message: msg
                    , position: 'topRight'
                });


            });

            window.livewire.on('permi-remove', msg => {

                iziToast.error({
                    title: '¡Correcto!'
                    , message: msg
                    , position: 'topRight'
                });


            });

            window.livewire.on('sync-all', msg => {

                iziToast.success({
                    title: '¡Correcto!'
                    , message: msg
                    , position: 'topRight'
                });


            });

        });


        function Remove(id) {
            Swal.fire({
                title: '¿Estás seguro de eliminar los permisos asignados?'
                , text: "¡Al eliminarlo podrá asignarlo nuevamente!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Sí, quiero eliminarlo'
                , cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    window.livewire.emit('revokeall')
                    Swal.close();
                }
            })
        }

    </script>

</div>
