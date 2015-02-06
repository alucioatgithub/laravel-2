@extends('layouts.main')

@section('content')

    {{ Form::open(array('method' => 'POST', 'url' => '/auth/basic/login' )) }}

        {{ Form::text('email', null, ['placeholder' => 'Email']) }}
        {{ Form::password('password', ['placeholder' => 'Password']) }}

        {{ Form::submit('Login') }}

    {{ Form::close() }}

@stop