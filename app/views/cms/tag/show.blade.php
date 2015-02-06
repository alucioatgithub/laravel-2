@extends('layouts.admin')

@section('heading')
Tag Details <small> {{$tag->title or ''}}</small>
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.tag.index')}}"><i class="fa fa-tag"></i> Tag</a></li>
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
						<th>Title</th>
						<td>{{ucfirst($tag->title)}}</td>
					</tr>
					<tr>
						<th>Description</th>
						<td>{{ucfirst($tag->description)}}</td>
					</tr>				
					<tr>
						<th>Graphics</th>
						<td>{{ $tag->graphics or  '' }}</td>
					</tr>
		
					<tr>
						<th>Created Date</th>
						<td>{{ $tag->created_at or  '' }}</td>
					</tr>
					<tr>
						<th>Updated Date</th>
						<td>{{ $tag->updated_at or  '' }}</td>
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