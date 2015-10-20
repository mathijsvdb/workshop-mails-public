@extends('layouts.master')

@section('content')
    @if(Auth::check())
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <p>Welcome, {{ Auth::user()->name }}</p>
        <a href="/auth/logout">Log out</a>
    @else
        <a href="auth/login">Login</a> or <a href="auth/register">Register</a>
    @endif
@stop