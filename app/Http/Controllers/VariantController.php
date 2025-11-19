<?php
namespace App\Http\Controllers;

use App\Models\Variant;
use App\Models\Product;
use App\Http\Requests\VariantRequest;

class VariantController extends Controller
{
    public function index(Product $product)
    {
        $variants = $product->variants()->paginate(10);
        return view('variants.index', compact('product', 'variants'));
    }

    public function create(Product $product)
    {
        return view('variants.create', compact('product'));
    }

    public function store(VariantRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['product_id'] = $product->id;

        Variant::create($data);

        return redirect()->route('products.variants.index', $product)
                         ->with('success', 'Variant added successfully!');
    }

    public function edit(Product $product, Variant $variant)
    {
        return view('variants.edit', compact('product', 'variant'));
    }

    public function update(VariantRequest $request, Product $product, Variant $variant)
    {
        $variant->update($request->validated());

        return redirect()->route('products.variants.index', $product)
                         ->with('success', 'Variant updated successfully!');
    }

    public function destroy(Product $product, Variant $variant)
    {
        $variant->delete();
        return redirect()->route('products.variants.index', $product)
                         ->with('success', 'Variant deleted successfully!');
    }
}
