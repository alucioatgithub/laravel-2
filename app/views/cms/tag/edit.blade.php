@extends('layouts.admin')

@section('heading')
Edit Tag <small> {{$tag->title}}</small>
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.tag.index')}}"><i class="fa fa-tag"></i> Tag</a></li>
<li>Edit</li>
@stop


@section('content')

{{Form::model($tag, array('route' => array('admin.tag.update', $tag->tagid),  'method' => 'PUT')) }}

@include('cms.tag.form')

{{Form::close()}}

@stop