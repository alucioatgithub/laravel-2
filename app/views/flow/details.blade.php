@extends('layouts.flow')

@section('content')

<div class="item active">
    <div class="container ">

    <!-- result -->
    <div class="panel panel-default panel-yyag report">

    <div class="panel-heading text-center">
        <h3>
            {{$survey->title}}
        </h3>
    </div>
    <div class="panel-footer text-center">
        Care? Share:
        <a target="_blank" href="https://twitter.com/share?url={{Request::url()}}&text= {{$survey->title}}" class="btn btn-social btn-twitter">
            <i class="fa fa-twitter"></i> Share on Twitter
        </a>
        <a target="_blank" href="http://www.facebook.com/sharer.php?u={{Request::url()}}" class="btn btn-social btn-facebook">
            <i class="fa fa-facebook"></i> Share on Facebook
        </a>
    </div>
    <div class="panel-body">
        <img src="{{asset('assets/img/map.png')}}" class="center-block img-responsive" style="height:250px; width: 100%;" />
        <div class="row stat">
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="stat-title">
                   {{$survey->totalAnswers()}}
                </div>
                <div class="text-uppercase stat-text">
                    answered
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="stat-title">
                    51%
                </div>
                <div class="text-uppercase stat-text">
                    agree with you
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="stat-title">
                    61
                </div>
                <div class="text-uppercase stat-text">
                    actions suggested
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">

                <div class="box">
                    <div class="box-header">
                        Demographic
                    </div>
                    <div class="box-body">
                        population pyramid here
                    </div>
                </div>


                <div class="box">
                    <div class="box-header">
                        Popularity
                    </div>
                    <div class="box-body">
                        Show number of times each day this question was answered, in a sparkline / tinme series graph
                    </div>
                </div>


            </div>

            <div class="col-sm-6">

                <div class="box">
                    <div class="box-header">
                        Basic answers
                    </div>
                    <div class="box-body">
                        Show donut chart of results
                    </div>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="box comment">
                    <div class="box-header">
                        <div class="pull-right">
                            <span class="label label-default">Recent</span>
                            <span class="label label-default">Popular</span>
                        </div>
                        <i class="fa fa-question"></i> Reasons
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal col-sm-12" role="form">
                            <div class="form-group ">
                                <textarea class="form-control" rows="3" placeholder="Why did you answer as you did?"></textarea>
                            </div>
                        </form>

                        <div id="widget-comments">
                            <div class="media">
                                <a href="#" class="pull-left"><img src="http://api.randomuser.me/portraits/thumb/women/39.jpg" alt="" class="img-circle img-responsive">
                                </a>
                                <div class="media-body">
                                    <div class="media-content">
                                        <h4 class="media-heading"><a href="#" class="text-link">Alice Lane</a> <i class="fa fa-circle nnag" data-toggle="tooltip" title="Strongly disagreed"></i> <small class="text-muted pull-right">14 hours ago</small></h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum.
                                        <div class="media-actions">
                                            <a href="#" class="vote_up"><i class="fa fa-thumbs-o-up"></i> 45</a> &nbsp;&nbsp;
                                            <a href="#" class="vote_down"><i class="fa fa-thumbs-o-down"></i> 4</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <a href="#" class="pull-left"><img src="http://api.randomuser.me/portraits/thumb/men/60.jpg" alt="" class="img-circle width-50">
                                </a>
                                <div class="media-body">
                                    <div class="media-content">
                                        <h4 class="media-heading"><a href="#" class="text-link">Alice Lane</a> <i class="fa fa-circle nag" data-toggle="tooltip" title="Disagreed"></i> <small class="text-muted pull-right">14 hours ago</small></h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum.
                                        <div class="media-actions">
                                            <a href="#" class="vote_up"><i class="fa fa-thumbs-o-up"></i> 45</a> &nbsp;&nbsp;
                                            <a href="#" class="vote_down"><i class="fa fa-thumbs-o-down"></i> 4</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <a href="#" class="pull-left"><img src="http://api.randomuser.me/portraits/thumb/men/68.jpg" alt="" class="img-circle width-50">
                                </a>
                                <div class="media-body">
                                    <div class="media-content">
                                        <h4 class="media-heading"><a href="#" class="text-link">Alice Lane</a> <i class="fa fa-circle yag" data-toggle="tooltip" title="Agreed"></i> <small class="text-muted pull-right">14 hours ago</small></h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum.
                                        <div class="media-actions">
                                            <a href="#" class="vote_up"><i class="fa fa-thumbs-o-up"></i> 45</a> &nbsp;&nbsp;
                                            <a href="#" class="vote_down"><i class="fa fa-thumbs-o-down"></i> 4</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="box comment">
                    <div class="box-header">
                        <div class="pull-right">
                            <span class="label label-default">Recent</span>
                            <span class="label label-default">Popular</span>
                        </div>
                        <i class="fa fa-envelope"></i> Suggestions
                    </div>
                    <div class="box-body">

                        <form class="form-horizontal col-sm-12" role="form">
                            <div class="form-group ">
                                <textarea class="form-control" rows="3" placeholder="What would you like people / someone to do about that?"></textarea>
                            </div>
                        </form>

                        <div id="widget-comments">
                            <div class="media">
                                <a href="#" class="pull-left"><img src="http://api.randomuser.me/portraits/thumb/women/39.jpg" alt="" class="img-circle img-responsive">
                                </a>
                                <div class="media-body">
                                    <div class="media-content">
                                        <h4 class="media-heading"><a href="#" class="text-link">Alice Lane</a> <i class="fa fa-circle yyag" data-toggle="tooltip" title="Strongly agreed"></i> <small class="text-muted pull-right">14 hours ago</small></h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum.
                                        <div class="media-actions">
                                            <a href="#" class="vote_up"><i class="fa fa-thumbs-o-up"></i> 45</a> &nbsp;&nbsp;
                                            <a href="#" class="vote_down"><i class="fa fa-thumbs-o-down"></i> 4</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <a href="#" class="pull-left"><img src="http://api.randomuser.me/portraits/thumb/men/60.jpg" alt="" class="img-circle width-50">
                                </a>
                                <div class="media-body">
                                    <div class="media-content">
                                        <h4 class="media-heading"><a href="#" class="text-link">Alice Lane</a> <i class="fa fa-circle nnag" data-toggle="tooltip" title="Strongly disagreed"></i> <small class="text-muted pull-right">14 hours ago</small></h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum.
                                        <div class="media-actions">
                                            <a href="#" class="vote_up"><i class="fa fa-thumbs-o-up"></i> 45</a> &nbsp;&nbsp;
                                            <a href="#" class="vote_down"><i class="fa fa-thumbs-o-down"></i> 4</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <a href="#" class="pull-left"><img src="http://api.randomuser.me/portraits/thumb/men/68.jpg" alt="" class="img-circle width-50">
                                </a>
                                <div class="media-body">
                                    <div class="media-content">
                                        <h4 class="media-heading"><a href="#" class="text-link">Alice Lane</a> <i class="fa fa-circle nnag" data-toggle="tooltip" title="Strongly disagreed"></i> <small class="text-muted pull-right">14 hours ago</small></h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum.
                                        <div class="media-actions">
                                            <a href="#" class="vote_up"><i class="fa fa-thumbs-o-up"></i> 45</a> &nbsp;&nbsp;
                                            <a href="#" class="vote_down"><i class="fa fa-thumbs-o-down"></i> 4</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="panel-footer">
        <a target="_blank" href="https://twitter.com/share?url={{Request::url()}}&text= {{$survey->title}}" class="btn btn-social btn-twitter">
            <i class="fa fa-twitter"></i> Share on Twitter
        </a>
        <a target="_blank" href="http://www.facebook.com/sharer.php?u={{Request::url()}}" class="btn btn-social btn-facebook">
            <i class="fa fa-facebook"></i> Share on Facebook
        </a>
        <p class="strong pull-right">228 answers / 18 friends</p>

    </div>
    </div>
    </div>
    </div>
@stop