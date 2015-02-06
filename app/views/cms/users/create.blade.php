@extends('layouts.admin')

@section('heading')
Create a user
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.users.index')}}"><i class="fa fa-user"></i> User</a></li>
<li>Create</li>
@stop

@section('content')

{{ Form::open(array('route' => 'admin.users.store', 'method' => 'POST')) }}

@include('cms.users.form')

{{Form::close()}}

@stop