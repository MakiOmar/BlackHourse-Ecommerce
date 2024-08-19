@extends('layouts.adminbase')

@section('content')

<!-- add-product.blade.php -->
<div class="container my-5">
    <a class="btn btn-primary m-2" href="{{ route( 'product' ) }}">Back</a>
    <h2>Edit Product</h2>
    @include( 'error-messages' )
    <form action="{{ route('product.update', [ 'product' => $product->id ]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="author_id">Author</label>
            <select class="form-control" id="author_id" name="author_id" required>
                <option value="">Select Author</option>
                <!-- Populate with authors -->
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $author->id == $product->author_id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required>
        </div>

        <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="full_description">Full Description</label>
            <textarea class="form-control" id="full_description" name="description" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="regular_price">Regular Price</label>
            <input type="number" class="form-control" id="regular_price" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}" required>
        </div>

        <div class="form-group">
            <label for="sale_price">Sale Price</label>
            <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
        </div>

        <div class="form-group">
            <label for="SKU">SKU</label>
            <input type="text" class="form-control" id="SKU" name="SKU" value="{{ old('SKU', $product->SKU) }}" required>
        </div>

        <div class="form-group">
            <label for="stock_status">Stock Status</label>
            <select class="form-control" id="stock_status" name="stock_status" required>
                <option value="instock" {{ old('stock_status', $product->stock_status) == 'instock' ? 'selected' : '' }}>In Stock</option>
                <option value="outofstock" {{ old('stock_status', $product->stock_status) == 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
            </select>
        </div>

        <div class="form-group">
            <label for="featured">Featured</label>
            <select class="form-control" id="featured" name="featured">
                <option value="1" {{ old('featured', $product->featured) == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('featured', $product->featured) == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Current Image</label>
            <div>
                <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="img-thumbnail" width="150">
            </div>
        </div>

        <div class="form-group">
            <label for="image">Replace Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <div class="form-group">
            <label for="images">Current Additional Images</label>
            <div>
                @if($product->images)
                    @foreach(explode(',', $product->images) as $image)
                        <img src="{{ asset('images/' . $image) }}" alt="Additional Image" class="img-thumbnail" width="100">
                    @endforeach
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="images">Replace Additional Images</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                <!-- Populate with categories -->
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="brand_id">Brand</label>
            <select class="form-control" id="brand_id" name="brand_id">
                <option value="">Select Brand</option>
                <!-- Populate with brands -->
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>


@endsection