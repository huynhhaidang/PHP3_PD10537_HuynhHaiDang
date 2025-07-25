<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        echo "HELLO WORLD";
    }

    public function test()
    {
        return view('client.layout.master');
    }

    public function tinTrongLoai($idLoaiSanPham)
    {
       $products = Product::where('category_id', $idLoaiSanPham)->get();
        return view('client.categories.list-product', compact('products'));
    }
}
