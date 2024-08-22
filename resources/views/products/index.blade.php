<!-- resources/views/profile_form.blade.php -->

@extends('layouts.adminbase')
@section('content')
<div class="container m-4">
    <h2>Products list</h2>
<<<<<<< HEAD
    @include( 'error-messages' )
=======
>>>>>>> 54193d4b1478c54cd8d38eee677afb0432aa3549
    <a class="btn btn-success m-2" href="{{ route($create) }}">Create product</a>
    <table class="table">
        <thead>
            <tr>
                <th>Publisher</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
<<<<<<< HEAD
                <th>Status</th>
=======
>>>>>>> 54193d4b1478c54cd8d38eee677afb0432aa3549
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
<<<<<<< HEAD
                <td class="align-middle {{ $product->status === 'pending' ? 'text-warning': 'text-success' }}">{{ Str::ucfirst($product->status) }}</td>
                <td class="align-middle">
                    <div class="d-flex">
                        <a href="{{ route($edit, ['product' => $product->id]) }}" class="btn btn-primary">Edit</a>
                        <form class="ms-2 me-2" action="{{ route($destroy, ['product' => $product->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
=======
                <td class="align-middle">
                    <div class="d-flex">
                        <a href="{{ route($edit, ['product' => $product->id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route($destroy, ['product' => $product->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
>>>>>>> 54193d4b1478c54cd8d38eee677afb0432aa3549
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
<<<<<<< HEAD
                        @if ($product->status === 'pending' && Auth::user()->utype === 'ADM')
                            <form action="{{ route('product.publish', ['product' => $product]) }}" method="POST" onsubmit="return confirm('Are you sure you want to publish this product?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Publish</button>
                            </form> 
                        @endif

                        @if ($product->status === 'published' && Auth::user()->utype === 'ADM')
                            <form action="{{ route('product.pending', ['product' => $product]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning">Pending</button>
                            </form> 
                        @endif
                        
=======
>>>>>>> 54193d4b1478c54cd8d38eee677afb0432aa3549
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection