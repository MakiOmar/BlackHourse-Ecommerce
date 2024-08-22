<!-- resources/views/profile_form.blade.php -->

@extends('layouts.adminbase')
@section('content')
<div class="container m-4">
    <h2>Products list</h2>
    <a class="btn btn-success m-2" href="{{ route($create) }}">Create product</a>
    <table class="table">
        <thead>
            <tr>
                <th>Publisher</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td class="align-middle"><a href="{{ route($edit, ['product' => $product->id]) }}">{{ $product->user ? $product->user->name : 'Anonymous' }}</a></td>
                <td class="align-middle">{{ $product->name }}</td>
                <td class="align-middle">{{ Illuminate\Support\Str::limit($product->description, 40) }}</td>
                <td class="align-middle">${{ $product->regular_price }}</td>
                <td class="align-middle">
                    <div class="d-flex">
                        <a href="{{ route($edit, ['product' => $product->id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route($destroy, ['product' => $product->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection