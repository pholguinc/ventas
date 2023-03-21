<?php

namespace App\Http\Livewire;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserController extends Component
{
    use WithPagination;
    use WithFileUploads;


    public $name, $phone, $dni, $email, $status,$password,
    $selected_id, $fileLoaded, $profile;

    public $pageTitle, $componentName;

    public $search = '';

    private $pagination = 8;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
        $this->status = 'Elegir';
    }
    public function render()
    {

        if(strlen($this->search) > 0)
            $users = User::where('name', 'ILIKE', "%{$this->search}%")
                         ->orWhere('email', 'LIKE', "%{$this->search}%")
                         ->orWhere('dni', 'LIKE', "%{$this->search}%")
                         ->latest('id')->paginate($this->pagination);
        else
            $users =  User::where('name', '!=', '0')->latest('id')->paginate($this->pagination);

        return view('livewire.Users.index',[
                'users' => $users,
                'roles' => Role::orderBy('name', 'asc')->get()
            ])
            ->extends('layouts.admin')
            ->section('content')
            ->section('js');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->dni = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->status = 0;
        $this->resetValidation();
    }

    public function Edit(User $user){
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->dni = $user->dni;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->profile = $user->profile;
        $this->status = $user->status;
        $this->emit('show-modal', 'open');
    }

    protected $listeners = [
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'status' => 'required',
            'profile' => 'required',
            'password' => 'required|min:3',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'dni.required' => 'El DNI es requerido',
            'dni.min' => 'El DNI debe tener al menos 8 caracteres',
            'email.required' => 'Ingresa el correo',
            'email.email' => 'Ingresa un correo válido',
            'email.unique' => 'Ya existe un registro con este nombre',
            'status.required' => 'Seleccione el estado del usuario',
            'profile.required' => 'Seleccione el perfil del usuario',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);

       User::create([
            'name' => $this->name,
            'dni' => $this->dni,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' =>$this->profile,
            'password' => $this->password
        ]);

        $this->resetUI();
        $this->emit('user-added', 'Usuario registrado');
    }

    public function Update()
    {
        $rules = [
            'email' => "required|email|unique:users, email, {$this->selected_id}",
            'name' => 'required|min:3',
            'dni' => 'required|min:8',
            'status' => 'required',
            'profile' => 'required',
            'password' => 'required|min:3',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'dni.required' => 'El DNI es requerido',
            'dni.min' => 'El DNI debe tener al menos 8 caracteres',
            'email.required' => 'Ingresa el correo',
            'email.email' => 'Ingresa un correo válido',
            'email.unique' => 'Ya existe un registro con este nombre',
            'status.required' => 'Seleccione el estado del usuario',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);

        $user->update([
            'name' => $this->name,
            'dni' => $this->dni,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' =>$this->profile,
            'password' => bcrypt($this->password)
        ]);

        $this->resetUI();
        $this->emit('user-updated', 'Usuario actualizado');
    }


    public function destroy(User $user)
    {
        if($user){

        }
    }

    public function searchUser(){

        /*$rules = [
            'dni' => "required",
        ];

        $messages = [
            'dni.required' => 'El DNI es requerido',
        ];

        $this->validate($rules, $messages);*/

        $token = config('services.apisunat.token');
        $urldni = config('services.apisunat.urldni');

        $response = Http::withHeaders([
            'Referer' => 'http://apis.net.pe/consulta-dni-api',
            'Authorization' => 'Bearer ' . $token
        ])->get( $urldni . $this->dni);

        $data = $response->json();
        $this->name = $data['nombres'] .' '. $data['apellidoPaterno'] .' '. $data['apellidoMaterno'];
        $this->dni = $data['numeroDocumento'];
    }
}
