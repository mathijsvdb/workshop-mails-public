@extends('layouts.master')

@section('content')
<!-- resources/views/auth/login.blade.php -->

<form method="POST" action="/auth/login">
    <fieldset>
        <legend>Sign in</legend>

        {!! csrf_field() !!}

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="hero@imd.com">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div>
            <label for="remember">
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </fieldset>
</form>
@stop