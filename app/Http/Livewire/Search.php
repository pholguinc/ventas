<?php

namespace App\Http\Livewire;
use Darryldecode\Cart\Facades\CartFacade as Cart;

use Livewire\Component;
use App\Models\Product;

class Search extends Component
{


    public function render()
    {
        return view('livewire.search');
    }




}
