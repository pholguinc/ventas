<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerController extends Component
{
    use WithPagination;

    public $pageTitle, $componentName, $selected_id, $document_id;

    public $name, $lastname, $numDocument, $phone, $email, $address;

    public $search = '';

    private $pagination = 8;


    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Clientes';
        $this->document_id = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $customers = Customer::where('name', 'LIKE', "%{$this->search}%")->latest('id')->paginate($this->pagination);
        else
            $customers =  Customer::where('name', '!=', '0')->latest('id')->paginate($this->pagination);


        return view('livewire.Customers.index', compact('customers'))
            ->extends('layouts.admin')
            ->section('content')
            ->section('js');
    }

    public function Store(){
        $rules = [
            'numDocument' => 'required|unique:customers',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:customers|email',
            'address' => 'required'
        ];

        $messages = [
            'numDocument.required' => 'El documento es requerido',
            'numDocument.unique' => 'Ya existe un registro con este nombre',
            'name.required' => 'El nombre es requerido',
            'phone.required' => 'El teléfono es requerido',
            'email.required' => 'El correo es requerido',
            'email.unique' => 'Ya existe un registro con este nombre',
            'address.required' => 'La dirección es requerida',
        ];

        $this->validate($rules, $messages);

        Customer::create([
            'numDocument' => $this->numDocument,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        $this->resetUI();
        $this->emit('customer-added', 'Cliente Registrado');
    }


    public function Edit($id){
        $record = Customer::find($id);
        $this->numDocument = $record->numDocument;
        $this->name = $record->name;
        $this->phone = $record->phone;
        $this->email = $record->email;
        $this->address = $record->address;
        $this->selected_id = $record->id;
        $this->emit('show-modal', 'show modal');

    }


    public function Update(){
        $rules = [
            'numDocument' => "required|unique:customers,numDocument, {$this->selected_id}",
            'name' => 'required',
            'phone' => 'required',
            'email' => "required|email|unique:customers,email,{$this->selected_id}",
            'address' => 'required'
        ];

        $messages = [
            'numDocument.required' => 'El documento es requerido',
            'numDocument.unique' => 'Ya existe un registro con este nombre',
            'name.required' => 'El nombre es requerido',
            'phone.required' => 'El teléfono es requerido',
            'email.required' => 'El correo es requerido',
            'email.unique' => 'Ya existe un registro con este nombre',
            'address.required' => 'La dirección es requerida',
        ];

        $this->validate($rules, $messages);

        $customers = Customer::find($this->selected_id);

        $customers->update([
            'numDocument' => $this->numDocument,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        $this->resetUI();
        $this->emit('customer-update', 'Marca Actualizada');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy',
    ];

    public function Destroy(Customer $customer)
    {

        $customer->delete();
        $this->resetUI();
        $this->emit('customer-deleted', 'Marca Eliminada');
    }


    public function searchCustomer(){

        $rules = [
            'numDocument' => "required",
        ];

        $messages = [
            'numDocument.required' => 'El documento es requerido',
        ];

        $this->validate($rules, $messages);

        $token = config('services.apisunat.token');
        $urlruc = config('services.apisunat.urlruc');
        $urldni = config('services.apisunat.urldni');

        if($this->document_id == 'DNI'){

           $response = Http::withHeaders([
                'Referer' => 'http://apis.net.pe/consulta-dni-api',
                'Authorization' => 'Bearer ' . $token
            ])->get( $urldni . $this->numDocument);

            $data = $response->json();
            $this->name = $data['nombres'] .' '. $data['apellidoPaterno'] .' '. $data['apellidoMaterno'];
            $this->numDocument = $data['numeroDocumento'];
            //dd($data);

        }elseif($this->document_id == 'RUC'){
            $response =  Http::withHeaders([
                'Referer' => 'http://apis.net.pe/api-ruc',
                'Authorization' => 'Bearer ' . $token
            ])->get( $urlruc . $this->numDocument);

            $data = $response->json();
            $this->numDocument = $data['numeroDocumento'];
            $this->name = $data['nombre'];
            $this->address = $data['direccion'];
            //dd($data);
        }


    }


    public function resetUI()
    {
        $this->name = '';
        $this->numDocument = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->document_id = 0;
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
