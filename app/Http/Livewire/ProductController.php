<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $code, $cost, $price, $stock, $category_id, $image,
           $search, $selected_id, $pageTitle, $componentName;

    private $pagination = 8;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->category_id = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function render()
    {

        if (strlen($this->search) > 0)

            $products = Product::join('categories as c', 'c.id', 'products.category_id')
                       ->select('products.*','c.name as category')
                       ->where('products.name', 'like', '%' .$this->search . '%')
                       ->orWhere('products.code', 'like', '%' .$this->search . '%')
                       ->orWhere('c.name', 'like', '%' .$this->search . '%')
                       ->latest('id')
                       ->paginate($this->pagination);
        else
            $products = Product::join('categories as c', 'c.id', 'products.category_id')
                            ->select('products.*','c.name as category')
                            ->where('products.name', 'like', '%' .$this->search . '%')
                            ->orWhere('products.code', 'like', '%' .$this->search . '%')
                            ->orWhere('c.name', 'like', '%' .$this->search . '%')
                            ->latest('id')
                            ->paginate($this->pagination);

        return view('livewire.Products.index', [
            'data' => $products,
            'categories' => Category::all()
        ])->extends('layouts.admin')
          ->section('content');
    }


    public function Store(){
        $rules = [
            'name' => 'required|unique:products|min:3',
            'code' => 'required',
            'stock' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'code.required' => 'El código es requerido',
            'stock.required' => 'El stock es requerido',
            'cost.required' => 'El precio de compra es requerido',
            'price.required' => 'El precio de venta es requerido',
            'category_id.required' => 'La categoría es requerida',
        ];

        $this->validate($rules, $messages);

        $product = Product::create([
            'name' => $this->name,
            'code' => $this->code,
            'stock' => $this->stock,
            'cost' => $this->cost,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ]);

        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/products' , $customFileName);
            $product->image = $customFileName;
            $product->save();
        }

        $this->resetUI();
        $this->emit('product-added', 'Producto Registrado');
    }

    public function Edit(Product $product){
        $this->selected_id = $product->id;
        $this->name = $product->name;
        $this->code = $product->code;
        $this->cost = $product->cost;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->image = null;

        $this->emit('show-modal', 'Show modal');
    }


    public function Update(){
        $rules = [
            'name' => "required|min:3|unique:products,name,{$this->selected_id}",
            'code' => 'required',
            'stock' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'Ya existe un registro con este nombre',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'code.required' => 'El código es requerido',
            'stock.required' => 'El stock es requerido',
            'cost.required' => 'El precio de compra es requerido',
            'price.required' => 'El precio de venta es requerido',
            'category_id.required' => 'La categoría es requerida',
        ];

        $this->validate($rules, $messages);

        $product = Product::find($this->selected_id);

        $product->update([
            'name' => $this->name,
            'code' => $this->code,
            'stock' => $this->stock,
            'cost' => $this->cost,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ]);

        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/products' , $customFileName);
            $imageTemp = $product->image; //imagen temporal
            $product->image = $customFileName;
            $product->save();

            if($imageTemp != null){
                if(file_exists('storage/products' . $imageTemp)){
                    unlink('storage/products' . $imageTemp);
                }
            }
        }

        $this->resetUI();
        $this->emit('product-update', 'Producto Actualizado');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy',
        'scan-code-byId' => 'scanCodeById'
    ];

    public function Destroy(Product $product)
    {
        $imageTemp = $product->image;
        $product->delete();
        if($imageTemp != null){
            if(file_exists('storage/products' . $imageTemp)){
                unlink('storage/products' . $imageTemp);
            }
        }

        $this->resetUI();
        $this->emit('product-deleted', 'Producto Eliminado');
    }



    public function resetUI()
    {
        $this->name = '';
        $this->code = '';
        $this->cost = '';
        $this->price = '';
        $this->stock = '';
        $this->search = '';
        $this->category_id = '';
        $this->image = null;
        $this->selected_id = 0;
        $this->resetValidation();
    }


}
