<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryController extends Component
{

    use WithPagination;

    public $name, $code, $search, $selected_id, $pageTitle, $componentName;

    private $pagination = 8;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorías';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $data = Category::where('name', 'LIKE',  '%' . $this->search  . '%')
                ->orderBy('name', 'DESC')
                ->select('categories.*')
                ->orWhere('code', 'LIKE', '%' . $this->search . '%')
                ->paginate($this->pagination);
        else
            $data = Category::paginate($this->pagination);

        return view('livewire.Categories.index', ['data' => $data])
            ->extends('layouts.admin')
            ->section('content')
            ->section('js');
    }

    public function Edit($id){

        $record = Category::find($id);
        $this->name = $record->name;
        $this->code = $record->code;
        $this->selected_id = $record->id;
        $this->emit('show-modal', 'show modal');

    }

    public function Store(){
        sleep(3);
        $rules = [
            'name' => 'required|unique:categories|min:3',
            'code' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'code.required' => 'El código es requerido',
            'code.min' => 'El código de la categoría debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);

        Category::create([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->resetUI();
        $this->emit('category-added', 'Categoría Registrada');

    }


    public function Update(){
        sleep(3);
        $rules = [
            'name' => "required|min:3,name, {$this->selected_id}",
            'code' => "required|min:3,code, {$this->selected_id}"
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'code.required' => 'El código es requerido',
            'code.min' => 'El código de la categoría debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);

        $category = Category::find($this->selected_id);

        $category->update([
            'name' => $this->name,
            'code' => $this->code,
        ]);

        $this->resetUI();
        $this->emit('category-update', 'Categoría Actualizada');

    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Category $category)
    {
        //$category = Category::find($id);
        $category->delete();

        $this->resetUI();
        $this->emit('category-deleted', 'Categoría Eliminada');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->code = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
