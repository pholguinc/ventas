<?php

namespace App\Http\Livewire;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

use Livewire\Component;
use Livewire\WithPagination;

class RolesController extends Component
{
    use WithPagination;

    public $roleName, $name, $selected_id, $pageTitle, $componentName;

    public $search = '';

    private $pagination = 8;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $roles = Role::where('name', 'LIKE', "%{$this->search}%")
                           ->latest('id')->paginate($this->pagination);
        else
            $roles = Role::where('name', '!=', '0')->latest('id')->paginate($this->pagination);



        return view('livewire.Roles.index', compact('roles'))
            ->extends('layouts.admin')
            ->section('content')
            ->section('js');
    }

    public function CreateRole(){
        $rules = ['roleName' => 'required|min:2|unique:roles,name'];

        $messages= [
            'roleName.required' => 'El nombre del rol es requerido',
            'roleName.unique' => 'Ya existe un registro con este nombre',
            'roleName.min' => 'El nombre debe tener al menos 2 caracteres',
        ];

        $this->validate($rules, $messages);

        Role::create(['name' => $this->roleName]);

        $this->emit('role-added', 'Rol Registrado');
        $this->resetUI();
    }

    public function Edit(Role $role){
        $this->selected_id = $role->id;
        $this->roleName = $role->name;
        $this->emit('show-modal', 'show modal');
    }

    public function UpdateRole(){

        $rules = ['roleName' => "required|min:2|unique:roles,name, {$this->selected_id}"];

        $messages= [
            'roleName.required' => 'El nombre del rol es requerido',
            'roleName.unique' => 'Ya existe un registro con este nombre',
            'roleName.min' => 'El nombre debe tener al menos 2 caracteres',
        ];

        $this->validate($rules, $messages);

        $role = Role::find($this->selected_id);
        $role->name = $this->roleName;
        $role->save();

        $this->emit('role-updated', 'Rol Actualizado');
        $this->resetUI();
    }


    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        $permissionsCount = Role::find($id)->permissions->count();

        if($permissionsCount > 0) {
            $this->emit('role-error', 'No se puede eliminar porque tiene permisios asociados');
            return;
        }

        Role::find($id)->delete();

        $this->emit('role-deleted', 'Rol Eliminado');

        $this->resetUI();

    }


     public function resetUI()
    {
        $this->roleName = '';
        $this->search = '';
        $this->selected_id = 0;
    }

}
