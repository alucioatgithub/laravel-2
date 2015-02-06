@extends('layouts.main')

@section('content')

    {{ Form::open(array('method' => 'POST', 'url' => '/auth/basic/register' )) }}

        {{ Form::text('firstname', null, ['placeholder' => 'Firstname']) }}
        {{ Form::text('lastname', null, ['placeholder' => 'Lastname']) }}
        {{ Form::text('dob', null, ['placeholder' => 'Date of birth']) }}

        {{ Form::text('email', null, ['placeholder' => 'Email']) }}
        {{ Form::password('password', ['placeholder' => 'Password']) }}

        {{ Form::submit('register') }}

    {{ Form::close() }}

@stop