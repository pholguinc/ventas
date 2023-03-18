<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class AssignController extends Component
{
    use WithPagination;

    public $componentName, $role;

    public $permissionsSelected = [];

    public $old_permissions = [];


    private $pagination = 8;


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->role = 'Elegir';
        $this->componentName = 'Asignar Permisos';
    }


    public function render()
    {

        $permissions = Permission::select('name', 'description', 'id', DB::raw("0 as checked"))
            ->orderBy('name', 'asc')
            ->paginate($this->pagination);


        $roleCount = Role::with('permissions')->count();



        if ($this->role != 'Elegir') {
            $list = Permission::join('role_has_permissions as rp', 'rp.permission_id', 'permissions.id')
                ->where('role_id', $this->role)->pluck('permissions.id');
            $this->old_permissions = $list;
        }

        if ($this->role != 'Elegir') {
            foreach ($permissions as $permission) {
                $role = Role::find($this->role);
                $HavePermission = $role->hasPermissionTo($permission->name);
                if ($HavePermission) {
                    $permission->checked = 1;
                }
            }
        }

        return view('livewire.Assign.index', [
            'roles' => Role::orderBy('name', 'asc')->get(),
            'permissions' => $permissions,
            'roleCount' => $roleCount

        ])
            ->extends('layouts.admin')
            ->section('content')
            ->section('js');
    }

    public $listeners = ['revokeall' => 'RemoveAll'];

    public function RemoveAll()
    {
        if ($this->role == 'Elegir') {
            $this->emit('sync-error', 'Selecciona un rol válido');
            return;
        }

        $role = Role::find($this->role);


        $role->syncPermissions([0]);
        $this->emit('remove-all', "Se revocaron todos los permisos a $role->name");
    }

    public function SyncAll()
    {

        if ($this->role == 'Elegir') {
            $this->emit('sync-error', 'Selecciona un rol válido');
            return;
        }

        $role = Role::find($this->role);
        $permissions = Permission::pluck('id')->toArray();
        $role->syncPermissions($permissions);
        $this->emit('sync-all', "Se sincronizaron todos los permisos a $role->name");
    }


    public function SyncPermissions($state, $permissionName)
    {

        if ($this->role != 'Elegir') {
            $rolesName = Role::find($this->role);

            if ($state) {
                $rolesName->givePermissionTo($permissionName);
                $this->emit('permi-sync', "Permiso asignado correctamente");
            } else {
                $rolesName->revokePermissionTo($permissionName);
                $this->emit('permi-sync', "Permiso eliminado correctamente");
            }
        } else {
            $this->emit('permi', "Elige un rol válido");
        }
    }
}
