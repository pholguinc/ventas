<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandController extends Component
{
    use WithPagination;

    public $pageTitle , $componentName, $selected_id, $name, $image;

    private $pagination = 8;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Marcas';
    }


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        $brands = Brand::paginate($this->pagination);
        return view('livewire.Brands.index', compact('brands'))
            ->extends('layouts.admin')
            ->section('content')
            ->section('js');
    }

    public function Edit($id){
        $record = Brand::find($id);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->emit('show-modal', 'show modal');

    }
}
