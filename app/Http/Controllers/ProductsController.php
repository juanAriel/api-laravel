<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function show(Product $product)
    {

        abort_unless(Auth::user()->tokenCan('product:show'), 403 , "you don't have permissions to perform this action.");

        return new ProductResource($product);
    }
}
