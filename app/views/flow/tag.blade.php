@extends('layouts.flow')

@section('content')

<div class="item active" id="summary">
    <div class="container ">

        <div class="panel panel-default question">

            <div class="panel-heading clearfix">
                <p class="lead pull-left" style="margin:0;"><strong>{{ $tag->title or " " }}</strong>
                </p>
                <a href="#next" class="btn btn-primary btn-sm pull-right">Continue <i class="fa fa-arrow-right fa-fw"></i></a>
            </div>

            <ul class="list-group">
                @if(count($surveys)>0)
                @foreach($surveys as $key => $sur)
                <li class="list-group-item clearfix">

                    <div class="summary_item">
                        <div class="col-xs-2 text-center">
                            <span class="sparkline">20,50,22,45,80</span>
                        </div>
                        <div class="col-xs-9">
                            <h3><a href="{{ URL::route('flow.question', array($sur->surveyid)); }}">{{ $sur->title }}</a></h3>

                            <p class="text-muted small">
                                22% agree with you &mdash; 15 people within 3 miles </p>
                            <p>
                                <a href="#" class="reasons">
                                    <i class="fa fa-microphone"></i> 45 Reasons <span class="text-muted">&middot; add</span>
                                </a> 
                                <a href="#" class="suggestions">
                                    <i class="fa fa-lightbulb-o"></i> 12 Suggestions <span class="text-muted">&middot; add</span>
                                </a>
                            </p>
                        </div>
                        <div class="col-xs-1">
                            <i class="fa fa-angle-right fa-fw fa-3x text-muted"></i>
                        </div>

                        <div class="notice col-xs-12">
                            Did you know you can <a href="#">click this affiliate link</a>?
                        </div>
                    </div>
                </li>
                @endforeach
                @else
                <li class="list-group-item clearfix">
                    <div style="padding:20px">
                    Question not found for "{{ $tag->title or " " }}" tag
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>

</div>
@stop