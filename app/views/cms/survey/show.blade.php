@extends('layouts.admin')

@section('heading')
Survey Details <small> {{$survey->title or ''}}</small>
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.survey.index')}}"><i class="fa fa-comments"></i> Survey</a></li>
<li>Detail</li>
@stop

@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
    <div class="box box-primary">
      
        <!-- form start -->
    <div class="row">        
         <div class="col-md-8">
            <div class="box-body">
				<table class="table table-bordered">
					<tbody>						
					<tr>
						<th>Type</th>
						<td>{{ucfirst($survey->type)}}</td>
					</tr>
					<tr>
						<th>Information</th>
						<td>{{ucfirst($survey->information)}}</td>
					</tr>
					<tr>
						<th>Author</th>
						<?php $author = \User::find($survey->author); ?>
						<td>{{$author->firstname." ". $author->lastname}}</td>
					</tr>
					@if($survey->tags)
					<tr>
						<th>Tags</th>
						<td>
							<ul>
							@foreach($survey->tags as $tag)
								<?php $chosen_tag = \Survey\Tag::find($tag); ?>
								<li>{{$chosen_tag->title}}</li>
							@endforeach
							</ul>
						</td>
					</tr>
					@endif
					<?php 
	                    $start =  isset($survey->targeting['start']) ? $survey->targeting['start'] : '';
	                   
	                    if($start !='')
	                    {
	                        $start = \Carbon\Carbon::parse($start['date']);
	                        $start = $start->toDateString();
	                    }


	                    $end =  isset($survey->targeting['end']) ? $survey->targeting['end'] : '';
	                    if($end !='')
	                    {
	                        $end = \Carbon\Carbon::parse($end['date']);
	                        $end = $end->toDateString();
	                    }
                    ?>
					<tr>
						<th>Start Date</th>
						<td>{{ $start }}</td>
					</tr>
					<tr>
						<th>End Date</th>
						<td>{{ $end }}</td>
					</tr>
					<tr>
						<th>Polygon</th>
						<?php $polygon = \survey\Target::find($survey->targeting['polygon']); ?>
						<td>{{ $polygon->title or  '' }}</td>
					</tr>
					<tr>
						<th>Referrer</th>
						<td>{{ $survey->targeting['referrer'] or  '' }}</td>
					</tr>
					<tr>
						<th>Manual end</th>
						<td>{{($survey->targeting['manualend'] == 1)? "Yes" : "No"}}</td>
					</tr>
					<tr>
						<th>Created Date</th>
						<td>{{ $survey->created_at or  '' }}</td>
					</tr>
					<tr>
						<th>Updated Date</th>
						<td>{{ $survey->updated_at or  '' }}</td>
					</tr>
					
					
					</tbody>
				</table>

           </div>

        </div>
    </div>

    </div><!-- /.box -->

    </div><!--/.col (right) -->
</div>


@stop