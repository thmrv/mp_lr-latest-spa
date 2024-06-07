<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show (Product $product){
        return view('templates.' . ($product->template_name ?? 'product'), ['product' => $product]);
    }
}
