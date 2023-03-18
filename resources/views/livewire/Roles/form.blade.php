<div wire:ignore.self id="modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>{{ $componentName }}</b> | {{ $selected_id > 0 ? 'Editar' : 'Crear' }}
                </h5>
                <h6 class="text-center text-white" wire:loading>Por favor, espere...</h6>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label style="font-size:0.9rem;">
                                <strong>Nombre</strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-preprend">
                                    <span class="input-group-text bg-dark">
                                        <span class="text-white fas fa-edit">
                                        </span>
                                    </span>
                                </div>
                                <input type="text" wire:model.lazy="roleName" class="form-control" placeholder="ej: Nombre del proveedor">
                            </div>

                            @error('roleName')
                            <span class="ml-2 text-danger">
                                {{ $message }}
                            </span>
                            <script>
                                Swal.fire({
                                    icon: 'error'
                                    , title: 'Oops...'
                                    , text: 'Por favor, rellene todos los campos necesarios'
                                })

                            </script>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn" data-dismiss="modal">Cerrar</button>

                <div>
                    @if($selected_id < 1) <button type="button" wire:click.prevent="CreateRole()" class="btn btn-primary close-modal">
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

                        @else
                        <button type="button" wire:click.prevent="UpdateRole()" class="btn btn-primary close-modal">
                            <div class="spinner">
                                <span>Actualizar</span>
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
                        @endif
                </div>

            </div>
        </div>

        <style>
            .spinner {
                display: flex;
            }

            .fingerprint-spinner,
            .fingerprint-spinner * {
                box-sizing: border-box;
            }

            .fingerprint-spinner {
                height: 24px;
                width: 24px;
                padding: 2px;
                overflow: hidden;
                position: relative;
            }

            .fingerprint-spinner .spinner-ring {
                position: absolute;
                border-radius: 50%;
                border: 2px solid transparent;
                border-top-color: #fff;
                animation: fingerprint-spinner-animation 1500ms cubic-bezier(0.680, -0.750, 0.265, 1.750) infinite forwards;
                margin: auto;
                bottom: 0;
                left: 0;
                right: 0;
                top: 0;
            }

            .fingerprint-spinner .spinner-ring:nth-child(1) {
                height: calc(20px / 9 + 0 * 20px / 9);
                width: calc(20px / 9 + 0 * 20px / 9);
                animation-delay: calc(50ms * 1);
            }

            .fingerprint-spinner .spinner-ring:nth-child(2) {
                height: calc(20px / 9 + 1 * 20px / 9);
                width: calc(20px / 9 + 1 * 20px / 9);
                animation-delay: calc(50ms * 2);
            }

            .fingerprint-spinner .spinner-ring:nth-child(3) {
                height: calc(20px / 9 + 2 * 20px / 9);
                width: calc(20px / 9 + 2 * 20px / 9);
                animation-delay: calc(50ms * 3);
            }

            .fingerprint-spinner .spinner-ring:nth-child(4) {
                height: calc(20px / 9 + 3 * 20px / 9);
                width: calc(20px / 9 + 3 * 20px / 9);
                animation-delay: calc(50ms * 4);
            }

            .fingerprint-spinner .spinner-ring:nth-child(5) {
                height: calc(20px / 9 + 4 * 20px / 9);
                width: calc(20px / 9 + 4 * 20px / 9);
                animation-delay: calc(50ms * 5);
            }

            .fingerprint-spinner .spinner-ring:nth-child(6) {
                height: calc(20px / 9 + 5 * 20px / 9);
                width: calc(20px / 9 + 5 * 20px / 9);
                animation-delay: calc(50ms * 6);
            }

            .fingerprint-spinner .spinner-ring:nth-child(7) {
                height: calc(20px / 9 + 6 * 20px / 9);
                width: calc(20px / 9 + 6 * 20px / 9);
                animation-delay: calc(50ms * 7);
            }

            .fingerprint-spinner .spinner-ring:nth-child(8) {
                height: calc(20px / 9 + 7 * 20px / 9);
                width: calc(20px / 9 + 7 * 20px / 9);
                animation-delay: calc(50ms * 8);
            }

            .fingerprint-spinner .spinner-ring:nth-child(9) {
                height: calc(20px / 9 + 8 * 20px / 9);
                width: calc(20px / 9 + 8 * 20px / 9);
                animation-delay: calc(50ms * 9);
            }

            @keyframes fingerprint-spinner-animation {
                100% {
                    transform: rotate(360deg);
                }
            }

        </style>
    </div>
</div>
