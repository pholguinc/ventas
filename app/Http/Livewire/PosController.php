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

    public function updatedSearch(){
        $this->validate([
            "search" => "required|min:2"
        ]);

        $this->products = Product::where("name", "like", trim($this->search) . "%")
            ->take(3)
            ->get();
    }

    public function asignProduct($name)
    {
        $this->search = $name;
    }

    public function asignFirst()
    {
        $product = Product::where("name", "like", trim($this->search) . "%")->first();
        if($product)
        {
            $this->search = $product->name;
        }
        else
        {
            $this->search = "...";
        }
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

    public function ACash($value){

        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ( $this->efectivo - $this->total);

    }

    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale'
    ];


    public function ScanCode($code, $cant=1){
        //37820/R2SN03508dd($code);
        $product =  Product::where('code', $code)->first();

        if($product == null || empty($product)){

            $this->emit('scan-notfound', 'El producto no está registrado');
        } else{
            if($this->InCart($product->id)){
                $this->increaseQty($product->id);
                return;
            }

            if($product->stock < 1){
                $this->emit('no-stock', 'stock insuficiente :/');
                return;
            }

            Cart::add( $product->id, $product->name, $product->price, $cant, $product->image);

            $this->total = Cart::getTotal();

            $this->emit('scan-ok', 'Producto agregado');

        }
    }


    public function inCart($productId){
        $exist = Cart::get($productId);

        if($exist)
            return true;
        else
            return false;
    }

    public function increaseQty($productId, $cant = 1){
        $title = '';
        $product = Product::find($productId);

        $exist= Cart::get($productId);

        if($exist)
            $title = 'Cantidad actualizada';
        else
            $title = 'Producto agregado';


        if($exist){
            if($product->stock > ($cant + $exist->quantity)){

                $this->emit('no-stock', 'Stock insuficiente :/');
                return;
            }
        }

        Cart::add($product->id, $product->name, $product->price, $cant, $product->image);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', $title);

    }


    public function updateQty($productId, $cant = 1){
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);

        if($exist)
            $title = 'Cantidad actualizada';
        else
            $title = 'Producto agregado';

        if($exist){
            if($product->stock < $cant){
                $this->emit('no-stock', 'Stock insuficiente :/');
                return;
            }
        }

        $this->removeItem($productId);

        if($cant>0){
            Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok', $title);
        }



    }

    public function removeItem($productId){
         Cart::remove($productId);

         $this->total = Cart::getTotal();
         $this->itemsQuantity = Cart::getTotalQuantity();
         $this->emit('scan-ok', 'Producto eliminado');
    }


    public function decraseQty($productId){

        $item = Cart::get($productId);
        Cart::remove($productId);
        $newQty = ($item->quantity) - 1;

        if($newQty > 0)
            Cart::add($item->id, $item->name, $item->price, $newQty, $item->attributes[0]);


        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Cantidad actualizada');

    }

    public function clearCart(){
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Carrito vacío');
    }

    public function saveSale()
    {
        if($this->total <= 0){
            $this->emit('sale-error', 'AGREGA PRODUCTOS A LA VENTA');
            return;
        }

        if($this->efectivo <= 0){
            $this->emit('sale-error', 'INGRESA EL EFECTIVO');
            return;
        }

        if($this->total > $this->efectivo){
            $this->emit('sale-error', 'EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
            return;
        }

        DB::beginTransaction();

        try {
           $sale = Sale::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'change' => $this->change,
                'user_id' => Auth()->user()->id,
           ]);

           if($sale){
                $items = Cart::getContent();

                foreach($items as $item){
                   SaleDetail::create([
                        'price' => $item->price,
                        'quantity' => $item->quanity,
                        'product_id' => $item->id,
                        'sale_' => $sale->id
                   ]);

                   //update stock

                   $product = Product::find($item->id);
                   $product->stock = $product->stock - $item->quantity;
                   $product->save();
                }
           }

           DB::commit();
           Cart::clear();
           $this->efectivo =0;
           $this->change = 0;
           $this->total = Cart::getTotal();
           $this->itemsQuantity = Cart::getTotalQuantity();
           $this->emit('sale-ok', 'Venta registrada con éxito');
           $this->emit('print-ticket', $sale->id);

        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('sale-error', $e->getMessage());
        }

    }

    public function printTicket($sale){
        //return redirect->to("print://$sale->id");
    }


}
