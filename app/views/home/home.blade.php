@extends('layouts.main')

@section('content')
    Hello {{ HTML::link('/account', $username) }}! {{ HTML::link('/auth/logout', 'logout') }}
@stop