<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return inertia('Products', ['products' => $products]);
    }


    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($validated['products'] as $productData) {
            Product::query()->create([
                'name' => $productData['name'],
                'count' => $productData['count'],
                'price' => $productData['price'],
            ]);
        }

        return redirect()->back()->with('success', 'Products saved successfully.');
    }

}
