<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method one
        $user     = Auth()->user();
        $products = Product::all();
        // Method two
        // $products = Product::where( 'user_id', Auth()->id() )->get();

        return view('products.index', compact('user', 'products'));
    }

    public function userProducts()
    {
        // Method one
        $user     = Auth()->user();
        $products = $user->products;

        // Method two
        // $products = Product::where( 'user_id', Auth()->id() )->get();

        return view('products.index', compact('user', 'products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();
        $authors = User::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create', compact('authors', 'categories', 'brands'));
    }

    /**
     * Get user products
     */
    public function users(User $user)
    {
        return $user;
    }
    protected function validation($request)
    {
        $validatedData =  $request->validate([
            'author_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:regular_price',
            'SKU' => 'required|string|max:100|unique:products,SKU',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        // Handle single image upload
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName(); // Get original file name with extension.
            $imageFile->move(public_path() . '/images', $imageName); // Store the file with its original name.
            $validatedData['image'] = $imageName; // Save the file name in the 'image' field.
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $imageNames = [];
            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName(); // Get original file name with extension.
                $imageFile->move(public_path() . '/images', $imageName); // Store the file with its original name.
                $imageNames[] = $imageName; // Collect the file names
            }
            $validatedData['images'] = implode(',', $imageNames); // Save the file names as a JSON string in the 'images' field.
        }

        return $validatedData;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validation($request);
        $product   = Product::create($validated);
        return redirect()->route('product.edit', array( 'product' => $product->id ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $user = Auth()->user();
        return view('products.show', compact('user', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $user = Auth()->user();
        $authors = User::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.edit', compact('product', 'user', 'categories', 'brands', 'authors'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $this->validation($request);
        $product->update($validated);
        return redirect()->back()->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->route('product')->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->route('product')->with('error', 'Failed to delete the product.');
        }
    }
}
