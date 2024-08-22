<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method one
        $user     = Auth()->user();
        if ($user->utype === 'ADM') {
            $products = Product::all();
            $view     = 'product.show';
            $edit     = 'product.edit';
            $destroy   = 'product.destroy';
            $create   = 'product.create';
        } elseif ($user->utype === 'VDR') {
            $products = Product::where('author_id', $user->id)->get();
            $view     = 'vendor.product.show';
            $edit     = 'vendor.product.edit';
            $destroy   = 'vendor.product.destroy';
            $create   = 'vendor.product.create';
        }
        // Method two
        // $products = Product::where( 'user_id', Auth()->id() )->get();

        return view('products.index', compact('user', 'products', 'view', 'edit', 'destroy', 'create'));
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $products = Product::where('slug', '!=', $slug)->inRandomOrder()->get()->take(8);
        return view('details', ['product' => $product, 'products' => $products]);
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
        $authors = User::where('utype', 'VDR')->get();
        $categories = Category::all();
        $brands = Brand::all();
        if ($user->utype === 'ADM') {
            $create   = 'product.store';
        } elseif ($user->utype === 'VDR') {
            $create   = 'vendor.product.store';
        }
        return view('products.create', compact('authors', 'categories', 'brands', 'user', 'create'));
    }

    /**
     * Get user products
     */
    public function users(User $user)
    {
        return $user;
    }
    protected function validation($request, $extra_validation = array())
    {
        $default = [
            'author_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:regular_price',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ];
        $validate = array_merge($default, $extra_validation);
        $validatedData =  $request->validate($validate);


        // Handle single image upload
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName(); // Get original file name with extension.
            $imageFile->move(public_path() . 'assets/uploads', $imageName); // Store the file with its original name.
            $validatedData['image'] = $imageName; // Save the file name in the 'image' field.
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $imageNames = [];
            foreach ($request->file('images') as $imageFile) {
                $imageName = $imageFile->getClientOriginalName(); // Get original file name with extension.
                $imageFile->move(public_path() . '/assets/uploads', $imageName); // Store the file with its original name.
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
        if (Auth()->user()->utype === 'ADM') {
            $edit   = 'product.edit';
        } elseif (Auth()->user()->utype === 'VDR') {
            $edit   = 'vendor.product.edit';
        }

        $validated = $this->validation($request, array( 'slug' => 'required|string|max:255|unique:products,slug', 'SKU' => 'required|string|max:100|unique:products,SKU', ));
        $product   = Product::create($validated);
        return redirect()->route($edit, array( 'product' => $product->id ));
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

        if ($user->utype === 'ADM') {
            $update   = 'product.update';
        } elseif ($user->utype === 'VDR') {
            $update   = 'vendor.product.update';
        }
        return view('products.edit', compact('product', 'user', 'categories', 'brands', 'authors', 'update'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $user = Auth()->user();
        if ($user->id != $product->author_id && $user->utype != 'ADM') {
            return redirect()->back()->with('Error', 'Not allowed');
        }
        $validated = $this->validation(
            $request,
            array(
                'slug' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('products', 'slug')->ignore($product->id),
                ],
                'SKU' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('products', 'SKU')->ignore($product->id),
                ],
            )
        );
        $product->update($validated);
        return redirect()->back()->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Auth()->user()->utype === 'ADM') {
            $trdirect   = 'product';
        } elseif (Auth()->user()->utype === 'VDR') {
            $trdirect   = 'vendor.products';
        }
        if ($product->delete()) {
            return redirect()->route($trdirect)->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->route($trdirect)->with('error', 'Failed to delete the product.');
        }
    }
}
