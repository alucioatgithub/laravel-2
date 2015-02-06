@extends('layouts.admin')

@section('heading')
Edit User <small> {{$user->firstname or $user->email}}</small>
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.users.index')}}"><i class="fa fa-user"></i> User</a></li>
<li>Edit</li>
@stop



@section('content')

{{Form::model($user, 	array('route' => array('admin.users.update', $user->userid),  	'method' => 'PUT')) }}

@include('cms.users.form')

{{Form::close()}}

@stop