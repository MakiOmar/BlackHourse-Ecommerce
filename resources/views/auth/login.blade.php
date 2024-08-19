@extends('layouts.base')

@section('content')
<!-- Log In Section Start -->
<div class="container">
    <div>
        @include('error-messages')
    </div>
    <div class="login-section">
        <div class="materialContainer">
            <div class="box">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-title">
                        <h2>Login</h2>
                    </div>
                    <div class="input">
                        <label for="name">Username</label>
                        <input type="email" id="name" name="email" :value="old('email')" required="" autofocus="" autocomplete="name">
                        @error('email') <span class="text-danger mt-3">{{ $message }}</span>@enderror
                    </div>

                    <div class="input">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" class="block mt-1 w-full" name="password" required="" autocomplete="current-password">
                        @error('password') <span class="text-danger mt-3">{{ $message }}</span>@enderror
                    </div>

                    <a href="javascript:void(0)" class="pass-forgot">Forgot your password?</a>

                    <div class="button login">
                        <button type="submit">
                            <span>Log In</span>
                            <i class="fa fa-check"></i>
                        </button>
                    </div>

                    <p>Not a member? <a href="{{ route( 'register' ) }}" class="theme-color">Sign up now</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Log In Section End -->
@endsection
