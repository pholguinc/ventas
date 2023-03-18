<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionController extends Component
{
    use WithPagination;

    public $permissionName, $selected_id, $pageTitle, $componentName;

    public $search = '';

    private $pagination = 8;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Permisos';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $permissions = Permission::where('name', 'LIKE', "%{$this->search}%")
                           ->latest('id')->paginate($this->pagination);
        else
            $permissions = Permission::where('name', '!=', '0')->latest('id')->paginate($this->pagination);

        return view('livewire.Permissions.index', compact('permissions'))
        ->extends('layouts.admin')
        ->section('content')
        ->section('js');
    }


    public function CreatePermission(){
        $rules = ['permissionName' => 'required|min:2|unique:roles,name'];

        $messages= [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'Ya existe un registro con este nombre',
            'permissionName.min' => 'El nombre debe tener al menos 2 caracteres',
        ];

        $this->validate($rules, $messages);

        Permission::create(['name' => $this->permissionName]);

        $this->emit('permission-added', 'Permiso Registrado');
        $this->resetUI();
    }

    public function Edit(Permission $permission){
        $this->selected_id = $permission->id;
        $this->permissionName = $permission->name;
        $this->emit('show-modal', 'show modal');
    }


    public function UpdatePermission(){

        $rules = ['permissionName' => "required|min:2|unique:roles,name, {$this->selected_id}"];

        $messages= [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'Ya existe un registro con este nombre',
            'permissionName.min' => 'El nombre debe tener al menos 2 caracteres',
        ];

        $this->validate($rules, $messages);

        $permission = Permission::find($this->selected_id);
        $permission->name = $this->permissionName;
        $permission->save();

        $this->emit('permission-updated', 'Permiso Actualizado');
        $this->resetUI();
    }


    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        $rolesCount = Permission::find($id)->getRolesNames()->count();

        if($rolesCount > 0) {
            $this->emit('permission-error', 'No se puede eliminar porque tiene roles asociados');
            return;
        }

        Permission::find($id)->delete();

        $this->emit('permission-deleted', 'Permiso Eliminado');
        $this->resetUI();

    }

    public function resetUI()
    {
        $this->permissionName = '';
        $this->search = '';
        $this->selected_id = 0;
    }

}
