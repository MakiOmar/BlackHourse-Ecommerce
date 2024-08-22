@extends('layouts.adminbase')

@section('content')
<div class="container">
    <h1>Create new user</h1>
    @include( 'error-messages' )
    <div class="row row-cols-1 row-cols-md-2 g-4">

        <form method="POST" action="{{ route('user.create', $user->id) }}" class="my-4">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="select">
                <label for="account-type">Account type</label>
                <select class="form-select" id="account-type" name="account_type" title="Account type">
                    <option value="customer">Customer</option>
                    <option value="vendor">Vendor</option>
                    <option value="admin">Vendor</option>
                  </select> 
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection