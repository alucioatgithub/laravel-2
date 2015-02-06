@extends('layouts.admin')

@section('heading')
Edit Survey <small> {{$survey->type}}</small>
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.survey.index')}}"><i class="fa fa-comments"></i> Survey</a></li>
<li>Edit</li>
@stop



@section('content')

{{Form::model($survey, 	array('route' => array('admin.survey.update', $survey->surveyid),  	'method' => 'PUT')) }}

@include('cms.survey.form')

{{Form::close()}}

@stop