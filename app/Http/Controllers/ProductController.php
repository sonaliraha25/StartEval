<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
{
    $products = \App\Models\Product::where('user_id', auth()->id())->latest()->get();
    return view('backend.product_create', compact('products'));
}


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'status' => 'required|in:Live,Draft',
        'description' => 'required|string',
        'revenue' => 'required|numeric|min:0',
        'profit' => 'required|numeric|min:0',
        'asking_price' => 'required|numeric|min:0',
        'logo' => 'nullable|image|max:2048',
        'product_type' => 'required|string|max:255'
    ]);

   $path = null;
if ($request->hasFile('logo')) {
    $file = $request->file('logo');
    $folderName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->title ?: 'product');
    $fileName = time() . '_' . $file->getClientOriginalName();

    $path = $file->storeAs(
        "products/{$folderName}",
        $fileName,
        'public' // ensures it's under storage/app/public
    );
}
    \App\Models\Product::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'status' => $request->status,
        'description' => $request->description,
        'revenue' => $request->revenue,
        'profit' => $request->profit,
        'asking_price' => $request->asking_price,
        'logo' => $path,
        'product_type' => $request->product_type
    ]);

    return redirect()->route('products.create')->with('success', 'Product created successfully!');
}
public function edit($id)
{
    $product = \App\Models\Product::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view('backend.product_edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = \App\Models\Product::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $request->validate([
        'title' => 'required|string|max:255',
        'status' => 'required|in:Live,Draft',
        'description' => 'required|string',
        'revenue' => 'required|numeric|min:0',
        'profit' => 'required|numeric|min:0',
        'asking_price' => 'required|numeric|min:0',
        'logo' => 'nullable|image|max:2048',
        'product_type' => 'required|string|max:255'
    ]);

    // Handle logo upload if new file provided
    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $folder = preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->title);
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs("products/$folder", $fileName, 'public');
        $product->logo = $path;
    }

    // Update other fields
    $product->update([
        'title' => $request->title,
        'status' => $request->status,
        'description' => $request->description,
        'revenue' => $request->revenue,
        'profit' => $request->profit,
        'asking_price' => $request->asking_price,
        'product_type' => $request->product_type
    ]);

    return redirect()->route('products.create')->with('success', 'Product updated successfully!');
}
public function destroy($id)
{
    // Make sure only the owner can delete
    $product = \App\Models\Product::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // Delete the product
    $product->delete();

    return redirect()->route('products.create')->with('success', 'Product deleted successfully!');
}
public function viewProduct($id)
{
$product = Product::with('user')->findOrFail($id);
    return view('backend.product_detail', compact('product'));
}
}
