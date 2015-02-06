@extends('layouts.admin')

@section('heading')
Manage Survey
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.survey.index')}}"><i class="fa fa-comments"></i> Survey</a></li>
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
                                         
                                        <a style="float:right" href="{{route('admin.survey.create')}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="Create new survey"><i class="fa fa-plus fa-white"></i> Add survey</a>
                                      
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover table-striped">
                                      <thead>
                                      <tr>
                                           
                                            <th>Survey ID</th>
                                            <th>Type</th>
                                            <th>Author</th>                                            
                                            <th>Title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     	@if(count($surveys)>0)
                                        @foreach($surveys as $survey)

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
                                          
                                                <td>{{ $survey->surveyid or ''  }}</td>
                                                <td>{{ $survey->type or ''  }}</td>
                                                <td><?php $author = \User::find($survey->author); ?>{{$author->firstname." ". $author->lastname}}</td>
                                                <td>{{ $survey->title or ''  }}</td>     
                                                <td>{{ $start or '' }}</td>   
                                                <td>{{ $end or '' }}</td>   

                                              
                                                <td>
                                                    <div class="box-tools" data-toggle="btn-toggle">
                                                        <a href="{{route('admin.survey.show', array($survey->surveyid))}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="View Survey detail"><i class="fa fa-eye"></i></a>

                                                        <a href="{{route('admin.survey.edit', array($survey->surveyid))}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="Edit Survey"><i class="fa fa-edit"></i></a>
                                                         {{Form::open(array('url' => 'admin/survey/'.$survey->surveyid, 'method' => 'DELETE')) }}
                                                            {{ Form::button('<i class="fa fa-trash-o"></i>', array( 'data-toggle'=> 'tooltip',  'title'=> 'Delete Survey', 'class' => 'btn btn-danger btn-sm',  'onclick' => 'if(confirm("Are you sure you want to delete this survey?")) this.form.submit(); else return false;')) }}
                                                        {{Form::close()}}
                                                    </div>
                                                </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else

                                    <tr>
                                    	<td colspan="7"> Record not found.</td>

                                    </tr>
                                    @endif

                                    </tbody>
                                </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

 
@stop