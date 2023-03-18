<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class PosController extends Component
{
    public $search, $products, $pageTitle, $componentName;

    public $total, $itemsQuantity, $efectivo, $change;

    public $cart = [];


    public function mount()
    {
        $this->search = "";
        $this->products = [];
        $this->componentName = 'Seleccionar Cliente';
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }


    public function render()
    {
        return view('livewire.Pos.index', [
            'cart' => Cart::getContent()->sortBy('name')
        ])
        ->extends('layouts.admin')
        ->section('content')
        ->section('js');
    }

    

}
