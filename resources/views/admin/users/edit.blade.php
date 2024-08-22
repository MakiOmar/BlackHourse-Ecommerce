@extends('layouts.adminbase')

@section('content')
<div class="container">
    <h1>Edit {{$user->name}}</h1>
    @include( 'error-messages' )
    <div class="row row-cols-1 row-cols-md-2 g-4">

        <form method="POST" action="{{ route('user.update', $user->id) }}" class="my-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="select">
                <label for="account-type">Account type</label>
                <select class="form-select" id="account-type" name="account_type" title="Account type">
                    <option value="customer"{{$user->utype === 'USR' ? ' selected' : ''}}>Customer</option>
                    <option value="vendor"{{$user->utype === 'VDR' ? ' selected' : ''}}>Vendor</option>
                    <option value="admin"{{$user->utype === 'ADM' ? ' selected' : ''}}>Vendor</option>
                  </select> 
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection