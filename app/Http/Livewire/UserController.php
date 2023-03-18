<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserController extends Component
{
    use WithPagination;

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
    }
    public function render()
    {

        if(strlen($this->search) > 0)
            $users = User::where('name', 'ILIKE', "%{$this->search}%")
                         ->orWhere('lastname', 'ILIKE', "%{$this->search}%")
                         ->orWhere('email', 'LIKE', "%{$this->search}%")
                         ->orWhere('dni', 'LIKE', "%{$this->search}%")
                         ->latest('id')->paginate($this->pagination);
        else
            $users =  User::where('name', '!=', '0')->latest('id')->paginate($this->pagination);

        return view('livewire.Users.index',[
                'users' => $users
            ])
            ->extends('layouts.admin')
            ->section('content')
            ->section('js');
    }
}
