@extends('layouts.admin')

@section('heading')
Dashboard
@stop



@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

Dashboard
 
@stop