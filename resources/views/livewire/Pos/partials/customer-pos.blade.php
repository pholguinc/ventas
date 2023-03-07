<div class="row">
    <div class="col-12">

        <div class="card card-success">
            <div class="card-header">
                <h5 class="text-center mt-2 ml-2">CLIENTE</h5>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <div class="input-group-preprend">
                        <button type="button" class="input-group-text bg-dark" data-toggle="modal" data-target="#modal">
                            <span class="text-white fas fa-users">
                            </span>
                        </button>
                    </div>
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="Selecciona un cliente">
                </div>
            </div>
          </div>
          @include('livewire.Pos.partials.customer-modal')
    </div>
</div>
