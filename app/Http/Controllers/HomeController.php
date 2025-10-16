<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $product1 = Product::find(1);
        $product2 = Product::find(2);
        $product3 = Product::find(3);

        return view('index', compact('product1', 'product2', 'product3'));
    }
}
