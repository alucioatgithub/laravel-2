@extends('layouts.admin')

@section('heading')
Add Survey
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.survey.index')}}"><i class="fa fa-comments"></i> Survey</a></li>
<li>Create</li>
@stop


@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::open(array('route' => 'admin.survey.store', 'method' => 'POST')) }}

@include('cms.survey.form')

{{Form::close()}}
 
@stop



