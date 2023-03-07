<div>
    <div wire:ignore.self id="modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">
                        <b>{{ $componentName }}</b>
                    </h5>
                    <h6 class="text-center text-white" wire:loading>Por favor, espere...</h6>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center pt-3">
                                        </th>
                                        <th class="text-light">NOMBRE</th>
                                        <th class="text-light">EMAIL</th>
                                        <th class="text-light">CARGO</th>
                                        <th class="text-light">ESTADO</th>
                                        <th class="text-light">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center pt-2">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            Nombre
                                        </td>
                                        <td>email</td>
                                        <td>
                                            Cargo
                                        </td>
                                        <td>Estado</td>
                                        <td><a href="#" class="btn btn-primary">Acciones</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn" data-dismiss="modal">Cerrar</button>

                    <div>
                        <button type="button" wire:click.prevent="Store()" class="btn btn-primary close-modal">
                            <div class="spinner">
                                <span>Guardar</span>
                                <div class="fingerprint-spinner" wire:loading>
                                    <div class="spinner-ring"></div>
                                    <div class="spinner-ring"></div>
                                    <div class="spinner-ring"></div>
                                    <div class="spinner-ring"></div>
                                    <div class="spinner-ring"></div>
                                    <div class="spinner-ring"></div>
                                    <div class="spinner-ring"></div>
                                    <div class="spinner-ring"></div>
                                    <div class="spinner-ring"></div>
                                </div>
                            </div>
                        </button>
                    </div>

                </div>
            </div>

        </div>
