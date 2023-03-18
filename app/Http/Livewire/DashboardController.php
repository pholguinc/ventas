<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Provider;
use Livewire\Component;

class DashboardController extends Component
{
    public function render()
    {
        $customers = Customer::count();
        $products = Product::count();
        $brands = Brand::count();
        $providers = Provider::count();
        $categories = Category::count();
        return view('livewire.Dashboard.index', compact('customers', 'products', 'brands', 'providers', 'categories'))
        ->extends('layouts.admin')
        ->section('content')
        ->section('js');
    }
}
