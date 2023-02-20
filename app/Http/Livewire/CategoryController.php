<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryController extends Component
{

    public $name, $description, $code, $search, $selected_id, $pageTitle, $componentName;

    private $pagination = 10;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorías';

    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = Category::where('name', 'LIKE',  '%' . $this->search  . '%')
            ->select('categories.*')
            ->orWhere('categories.description', 'LIKE', '%' . $this->search . '%')
            ->orWhere('categories.code', 'LIKE', '%' . $this->search . '%')
            ->orderBy('name', 'DESC')
                       ->paginate($this->pagination);
        else
            $data = Category::where('name', 'LIKE',  '%' . $this->search  . '%')
            ->select('categories.*')
            ->orWhere('categories.description', 'LIKE', '%' . $this->search . '%')
            ->orWhere('categories.code', 'LIKE', '%' . $this->search . '%')
            ->orderBy('name', 'DESC')
                   ->paginate($this->pagination);

        return view('livewire.Categories.index', ['data' => $data ]);
    }
}
