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
