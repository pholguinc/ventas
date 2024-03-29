<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ModalProducts extends Component
{
    public $componentName, $search, $products = [];

    protected $paginationTheme = 'bootstrap';


    public function mount(){

        $this->componentName = 'buscador';
    }

    public function liveSearch(){
        if(strlen($this->search)> 0){
            $this->products = Product::join('categories as c', 'c.id', 'products.category_id')
                 ->select('products.*', 'c.name as category')
                 ->where('products.name', 'like', "%{$this->search}%")
                 ->orWhere('products.code', 'like', "%{$this->search}%")
                 ->orWhere('c.name', 'like', "%{$this->search}%")
                 ->orderBy('products.name', 'asc')
                 ->get()->take(6);
        }
        else{
            return $this->products = [];
        }
    }

    public function render()
    {
        $this->liveSearch();
        return view('livewire.components.modal-products');
    }

    public function addAll()
    {
        if(count($this->products) > 0){
            foreach ($this->products as $product) {
               $this->emit('scan-code-byid', $product->id);
            }
        }
    }
}
