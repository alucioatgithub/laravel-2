@extends('layouts.admin')

@section('heading')
Add Tag
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.tag.index')}}"><i class="fa fa-user"></i> Tag</a></li>
<li>Create</a></li>

@stop


@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::open(array('route' => 'admin.tag.store', 'method' => 'POST')) }}

@include('cms.tag.form')

{{Form::close()}}
 
@stop