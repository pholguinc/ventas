<?php

namespace App\Http\Livewire;

use App\Models\Provider;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;


class ProviderController extends Component
{
    use WithPagination;

    public $pageTitle, $componentName, $selected_id;

    public $ruc, $name, $phone, $email, $address, $searchProvider;

    public $search = '';

    private $pagination = 8;


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Proveedores';
    }
    public function render()
    {


        if(strlen($this->search) > 0)
            $providers = Provider::where('name', 'LIKE', "%{$this->search}%")
                           ->orWhere('ruc', 'LIKE', "%{$this->search}%")
                           ->orWhere('email', 'LIKE', "%{$this->search}%")
                           ->orWhere('phone', 'LIKE', "%{$this->search}%")
                           ->latest('id')->paginate($this->pagination);
        else
            $providers =  Provider::where('name', '!=', '0')->latest('id')->paginate($this->pagination);


        return view('livewire.Providers.index', compact('providers'))
        ->extends('layouts.admin')
        ->section('content')
        ->section('js');
    }

    public function Store(){
        $rules = [
            'ruc' => "required|min:11|unique:providers",
            'name' => "required|min:3|unique:providers",
            'phone' => 'required|min:9',
            'email' => 'required|email',
            'address' => 'required'
        ];

        $messages = [
            'ruc.required' => 'El RUC es requerido',
            'ruc.unique' => 'Ya existe un registro con este nombre',
            'ruc.min' => 'El nombre debe tener al menos 11 caracteres',
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'phone.min' => 'Ingrese un teléfono valido',
            'email.required' => 'El correo es requerido',
            'address.required' => 'La dirección es requerida',
        ];

        $this->validate($rules, $messages);

        Provider::create([
            'ruc' => $this->ruc,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);


        $this->resetUI();
        $this->emit('provider-added', 'Proveedor Registrado');
    }

    public function Edit($id){
        $record = Provider::find($id);
        $this->ruc = $record->ruc;
        $this->name = $record->name;
        $this->phone = $record->phone;
        $this->email = $record->email;
        $this->address = $record->address;
        $this->selected_id = $record->id;
        $this->emit('show-modal', 'show modal');

    }

    public function Update(){
        $rules = [
            'ruc' => "required|min:3|unique:providers,ruc,{$this->selected_id}",
            'name' => "required|min:3|unique:providers,name,{$this->selected_id}",
            'phone' => 'required|min:9',
            'email' => 'required|email',
            'address' => 'required'
        ];

        $messages = [
            'ruc.required' => 'El RUC es requerido',
            'ruc.unique' => 'Ya existe un registro con este nombre',
            'ruc.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'phone.min' => 'Ingrese un teléfono valido',
            'email.required' => 'El correo es requerido',
            'address.required' => 'La dirección es requerida',
        ];

        $this->validate($rules, $messages);

        $provider = Provider::find($this->selected_id);

        $provider->update([
            'ruc' => $this->ruc,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        $this->resetUI();
        $this->emit('provider-update', 'Proveedor Actualizado');
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Provider $provider)
    {

        $provider->delete();

        $this->resetUI();
        $this->emit('provider-deleted', 'Proveedor Eliminado');
    }

    public function resetUI()
    {
        $this->ruc = '';
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function searchProvider(){

        $rules = [
            'ruc' => "required",
        ];

        $messages = [
            'ruc.required' => 'El RUC es requerido',
        ];

        $this->validate($rules, $messages);

        $token = config('services.apisunat.token');
        $urlruc = config('services.apisunat.urlruc');

        $response = Http::withHeaders([
            'Referer' => 'http://apis.net.pe/api-ruc',
            'Authorization' => 'Bearer ' . $token
        ])->get( $urlruc . $this->ruc);

        $data = $response->json();
        $this->name = $data['nombre'];
        $this->ruc = $data['numeroDocumento'];
        $this->address = $data['direccion'];
        //dd($data);

    }
}
