<!-- resources/views/profile_form.blade.php -->

@extends('layouts.adminbase')

@section('content')
<!-- products.blade.php -->
<div class="container m-4">
    <h2>Products list</h2>
    <a class="btn btn-success m-2" href="{{ route( 'product.create' ) }}">Create product</a>
    <div class="row">
        @if ( count( $products ) > 0)
        @foreach($products as $product)
            <div id="product{{ $product->id }}" class="col-md-4 mb-2">
                <div class="card border-0 rounded-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Publisher:</strong> <a href="#">@if ( $product->user ) {{ $product->user->name }} @else Anonymous @endif </a></h5>
                        <h5 class="card-title"><strong>Title:</strong> {{ $product->name }}</h5>
                        <p class="card-text"><strong>Description:</strong> {{ Illuminate\Support\Str::limit($product->description, 40) }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $product->regular_price }}</p>
                        <div class="d-flex justify-content-between">
                            <a class="m-2" href="{{ route( $edit, [ 'product' => $product->id ] ) }}">Edit</a></div>
                            <form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</div>

@endsection