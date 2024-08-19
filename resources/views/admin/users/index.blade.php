@extends('layouts.adminbase')

@section('content')
<div class="container">
    <h1>All users</h1>
    @include( 'error-messages' )
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>email</th>
                    <th>name</th>
                    <th>role</th>
                    <th>Account status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="align-middle">{{ $user->id }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">@if ( $user->utype === 'ADM' ) Admin @else Customer @endif</td>
                        <td class="align-middle">{{ $user->account_status }}</td>
                        <td class="align-middle">
                            @if ( $user->utype !== 'ADM' )
                            <div class="d-flex">
                                <form action="{{ route('user.destroy', ['user' => $user->id]) }}" class="m-2" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                @if ( $user->account_status === 'allowed' )
                                <form action="{{ route('user.block', ['user' => $user->id]) }}" class="m-2" method="POST" onsubmit="return confirm('Are you sure you want to block this user?');">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="action" value="block">
                                    <button class="btn btn-warning" type="submit">Block</button>
                                </form>
                                @endif

                                @if ( $user->account_status !== 'allowed' )
                                <form action="{{ route('user.unblock', ['user' => $user->id]) }}" class="m-2" method="POST" onsubmit="return confirm('Are you sure you want to allow this user?');">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="action" value="unblock">
                                    <button class="btn btn-success" type="submit">Allow</button>
                                </form>
                                @endif
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection