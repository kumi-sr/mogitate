<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request) 
    {
        $query = Product::query();

        if ($request->filled('keyword')){
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->sort === 'asc'){
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'desc'){
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(6);
        return view('products.index', compact('products'));
    }
    
    public function create()
    {
        return view('products.register');
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0|max:10000',
            'image' => 'required|image|mimes:png,jpeg',
            'season' => 'required|array',
            'season.*' => 'in:春,夏,秋,冬',
            'description' => 'required|string|max:120',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'description' => $validated['description'],
        ]);

        $seasons = Season::whereIn('name', $validated['season'])->pluck('id');
        $product->seasons()->attach($seasons);

        return redirect()->route('products.index')->with('success', '商品を登録しました。');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
