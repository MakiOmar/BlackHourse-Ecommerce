@extends('layouts.adminbase')

@section('content')

<!-- add-product.blade.php -->
<div class="container mt-5">
    <h2>Create Product</h2>
    @include( 'error-messages' )
    <form action="{{ route($create) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if ( $user->utype === 'ADM' )
        <div class="form-group">
            <label for="author_id">Author</label>
            <select class="form-control" id="author_id" name="author_id" required>
                <option value="">Select Author</option>
                <!-- Populate with authors -->
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @else
        <input type="hidden" name='author_id' value="{{$user->id}}">
        @endif

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
        </div>

        <div class="form-group">
            <label for="short_description">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" rows="3">{{ old('short_description') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="full_description">Full Description</label>
            <textarea class="form-control" id="full_description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="regular_price">Regular Price</label>
            <input type="number" class="form-control" id="regular_price" name="regular_price" value="{{ old('regular_price') }}" required>
        </div>

        <div class="form-group">
            <label for="sale_price">Sale Price</label>
            <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
        </div>

        <div class="form-group">
            <label for="SKU">SKU</label>
            <input type="text" class="form-control" id="SKU" name="SKU" value="{{ old('SKU') }}" required>
        </div>

        <div class="form-group">
            <label for="stock_status">Stock Status</label>
            <select class="form-control" id="stock_status" name="stock_status" required>
                <option value="instock" {{ old('stock_status') == 'instock' ? 'selected' : '' }}>In Stock</option>
                <option value="outofstock" {{ old('stock_status') == 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
            </select>
        </div>

        <div class="form-group">
            <label for="featured">Featured</label>
            <select class="form-control" id="featured" name="featured">
                <option value="1" {{ old('featured') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('featured') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <div class="form-group">
            <label for="images">Additional Images</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                <!-- Populate with categories -->
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="brand_id">Brand</label>
            <select class="form-control" id="brand_id" name="brand_id">
                <option value="">Select Brand</option>
                <!-- Populate with brands -->
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>
@endsection