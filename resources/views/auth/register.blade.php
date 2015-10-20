@extends('layouts.master')

@section('content')
<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="/auth/register">
    <fieldset>
        <legend>Sign up</legend>

        {!! csrf_field() !!}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Laravel master">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="hero@imd.com">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </fieldset>
</form>
@stop