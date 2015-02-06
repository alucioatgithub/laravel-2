@extends('layouts.main')

@section('content')

    {{ Form::open(array('method' => 'POST', 'url' => '/auth/password/remind'))  }}

        {{ Form::text('email', null, array('placeholder' => 'Your email')) }}

        {{ Form::submit() }}

    {{ Form::close()  }}

@stop