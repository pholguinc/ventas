<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BrandController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $pageTitle , $componentName, $selected_id, $name, $image;

    public $search = '';

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
        if(strlen($this->search) > 0)
            $brands = Brand::where('name', 'LIKE', "%{$this->search}%")->latest('id')->paginate($this->pagination);
        else
            $brands =  Brand::where('name', '!=', '0')->latest('id')->paginate($this->pagination);

        return view('livewire.Brands.index', compact('brands'))
            ->extends('layouts.admin')
            ->section('content')
            ->section('js');
    }

    public function Store(){
        $rules = [
            'name' => 'required|unique:products|min:3',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);

        $brand = Brand::create([
            'name' => $this->name
        ]);

        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/brands' , $customFileName);
            $brand->image = $customFileName;
            $brand->save();
        }
        $this->resetUI();
        $this->emit('brand-added', 'Marca Registrada');
    }

    public function Edit($id){
        $record = Brand::find($id);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->emit('show-modal', 'show modal');

    }

    public function Update(){
        $rules = [
            'name' => "required|min:3|unique:products,name,{$this->selected_id}"
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $brand = Brand::find($this->selected_id);

        $brand->update([
            'name' => $this->name
        ]);

        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/brands' , $customFileName);
            $imageTemp = $brand->image; //imagen temporal
            $brand->image = $customFileName;
            $brand->save();

            if($imageTemp != null){
                if(file_exists('storage/brands' . $imageTemp)){
                    unlink('storage/brands' . $imageTemp);
                }
            }
        }

        $this->resetUI();
        $this->emit('brand-update', 'Marca Actualizada');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy',
    ];

    public function Destroy(Brand $brand)
    {
        $imageTemp = $brand->image;
        $brand->delete();
        if($imageTemp != null){
            if(file_exists('storage/brands' . $imageTemp)){
                unlink('storage/brands' . $imageTemp);
            }
        }

        $this->resetUI();
        $this->emit('brand-deleted', 'Marca Eliminada');
    }



    public function resetUI()
    {
        $this->name = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
