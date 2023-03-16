<div>
    <div wire:ignore.self id="modalProducts" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="input-group mb-2">
                        <input wire:model="search" type="text" class="form-control text-left" id="inlineFormInputGroup2" placeholder="Your URL">
                        <div class="input-group-append">
                          <div class="input-group-text bg-dark">
                            <i class="fas fa-search text-light"></i>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="4%" class="text-center pt-3">
                                        </th>
                                        <th class="text-light">DESCRIPCIÓ<Noscript></Noscript></th>
                                        <th width="13%" class="text-light">PRECIO</th>
                                        <th class="text-light">CATEGORÍA</th>
                                        <th class="text-light">
                                            <button wire:click.prevent="addAll" class="btn btn-info" {{ count($products) > 0 ? '' : 'disabled' }}>
                                                <i class="fas fa-check"></i>
                                                TODOS
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/products/' . $product->imagen) }}" alt="imagen" height="50" width="50" class="rounded">
                                            </td>
                                            <td>
                                                <h6><b>{{ $product->name }}</b></h6>
                                                <small class="text-info">{{ $product->code }}</small>
                                            </td>
                                            <td>S/. {{ number_format( $product->price, 2 ) }}</td>
                                            <td>{{ $product->category }}</td>
                                            <td>
                                                <button class="btn btn-cart" wire:click.prevent="$emit('scan-code-byid', {{ $product->id }})">
                                                    <i class="fas fa-cart-arrow-down mr-1"></i>
                                                    AGREGAR
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">SIN RESULTADOS</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-dark close-btn" data-dismiss="modal">Cerrar</button>

                    <div>
                        <button type="button" class="btn btn-primary close-modal">
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
    </div>
</div>
