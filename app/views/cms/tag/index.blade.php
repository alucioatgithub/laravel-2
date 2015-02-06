@extends('layouts.admin')

@section('heading')
Manage Tags
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.tag.index')}}"><i class="fa fa-tag"></i> Tags</a></li>
@stop


@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif


<style type="text/css">
.btn-left{
float: left;
margin-right: 7px;
}
</style>

<div class="row">
                        <div class="col-xs-12">
                            <div class="box">

                                <div class="box-header">
                                   
                                    <div class="box-tools">
                                        <a style="float:right" href="{{route('admin.tag.create')}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="Create new tag"><i class="fa fa-plus fa-white"></i> Add tag</a>
                                         
                                      
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover table-striped">
                                      <thead>
                                      <tr>
                                           
                                            <th>Tag ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@if(count($tags)>0)
                                        @foreach($tags as $tag)
                                        <tr>
                                          
                                                <td>{{ $tag->tagid or ''  }}</td>
                                                <td>{{ $tag->title or ''  }}</td>  
                                                <td>
                                                   <?php  $v = str_limit($tag->description, 30) ;?>
                                                    {{ $v or ''  }}</td>  
                                                <td>
                                                    <div class="box-tools" data-toggle="btn-toggle">
                                                        <a href="{{route('admin.tag.show', array($tag->tagid))}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="View Tag detail"><i class="fa fa-eye"></i></a>

                                                        <a href="{{route('admin.tag.edit', array($tag->tagid))}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="Edit Tag"><i class="fa fa-edit"></i></a>
                                                         {{Form::open(array('url' => 'admin/tag/'.$tag->tagid, 'method' => 'DELETE')) }}
                                                            {{ Form::button('<i class="fa fa-trash-o"></i>', array( 'data-toggle'=> 'tooltip',  'title'=> 'Delete Tag', 'class' => 'btn btn-danger btn-sm',  'onclick' => 'if(confirm("Are you sure you want to delete this tag?")) this.form.submit(); else return false;')) }}
                                                        {{Form::close()}}
                                                    </div>
                                                </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else

                                    <tr>
                                    	<td colspan="3"> Record not found.</td>

                                    </tr>
                                    @endif

                                    </tbody>
                                </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

 
@stop