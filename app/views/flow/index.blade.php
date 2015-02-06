@section('content')


<!-- Page Content -->

    <div class="item active">
    <div class="fill"></div>
    <div class="container">
    <div class="panel panel-default question">

        <div class="panel-heading">

    <?php
    $tags = $survey->getTags();
    ?>
    @foreach ($tags as $tag)
     <a href="{{ URL::route('flow.tag', array($tag->slug)); }}"><span class="label label-primary">{{$tag->title}}</span></a>
    @endforeach


            <a href="#save" class="pull-right">
                <i class="fa fa-star"></i>
            </a>
        </div>
        <div class="panel-body">
            <h1>
                <a href="{{ URL::route('flow.question', array($survey->surveyid)); }}">{{$survey->title}}</a>
            </h1>

        </div>

        <div class="panel-body">
            <div class="text-center answers">
                <div class="answers_scale">
                    <div class="item">
                        <a href="#myCarousel" data-slide="next">
                            <svg xmlns="http://www.w3.org/2000/svg" class="nnag" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                <path d="M50.433,0.892c-27.119,0-49.102,21.983-49.102,49.102s21.983,49.103,49.102,49.103s49.101-21.984,49.101-49.103  S77.552,0.892,50.433,0.892z M78,51.036C78,54.882,74.882,58,71.036,58H27.964C24.118,58,21,54.882,21,51.036v-0.072  C21,47.118,24.118,44,27.964,44h43.072C74.882,44,78,47.118,78,50.964V51.036z" />
                                            </svg>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#myCarousel" data-slide="next">
                            <svg xmlns="http://www.w3.org/2000/svg" class="nag" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                <path d="M50.433,0.892c-27.119,0-49.102,21.983-49.102,49.102s21.983,49.103,49.102,49.103s49.101-21.984,49.101-49.103  S77.552,0.892,50.433,0.892z M50.433,93.258c-23.895,0-43.264-19.371-43.264-43.265c0-23.894,19.37-43.264,43.264-43.264  c23.894,0,43.263,19.37,43.263,43.264C93.696,73.887,74.327,93.258,50.433,93.258z" />
                                <path d="M78,50.964C78,47.118,74.882,44,71.036,44H27.964C24.118,44,21,47.118,21,50.964v0.072C21,54.882,24.118,58,27.964,58  h43.072C74.882,58,78,54.882,78,51.036V50.964z" />
                                            </svg>
                        </a>
                    </div>

                    <div class="item">
                        <a href="#myCarousel" data-slide="next" id="skip" class="flipper">
                            <svg xmlns="http://www.w3.org/2000/svg" class="skip" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                <path d="M50.433,0.892c-27.119,0-49.102,21.983-49.102,49.102s21.983,49.103,49.102,49.103s49.101-21.984,49.101-49.103  S77.552,0.892,50.433,0.892z M50.433,93.258c-23.895,0-43.264-19.371-43.264-43.265c0-23.894,19.37-43.264,43.264-43.264  c23.894,0,43.263,19.37,43.263,43.264C93.696,73.887,74.327,93.258,50.433,93.258z" />
                                <circle cx="50.433" cy="22.072" r="9.141" />
                                <path d="M59,79.031C59,83.433,55.194,87,50.5,87l0,0c-4.694,0-8.5-3.567-8.5-7.969V42.469c0-4.401,3.806-7.969,8.5-7.969l0,0  c4.694,0,8.5,3.568,8.5,7.969V79.031z" />
                                            </svg>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#myCarousel" data-slide="next">
                            <svg xmlns="http://www.w3.org/2000/svg" class="yag" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                <path d="M50.433,0.892c-27.119,0-49.102,21.983-49.102,49.102s21.983,49.103,49.102,49.103s49.101-21.984,49.101-49.103  S77.552,0.892,50.433,0.892z M50.433,93.258c-23.895,0-43.264-19.371-43.264-43.265c0-23.894,19.37-43.264,43.264-43.264  c23.894,0,43.263,19.37,43.263,43.264C93.696,73.887,74.327,93.258,50.433,93.258z" />
                                <path d="M78,50.964C78,47.118,74.882,44,71.036,44H27.964C24.118,44,21,47.118,21,50.964v0.072C21,54.882,24.118,58,27.964,58  h43.072C74.882,58,78,54.882,78,51.036V50.964z" />
                                <path d="M57,28.964C57,25.118,53.882,22,50.036,22h-0.071C46.118,22,43,25.118,43,28.964v43.071C43,75.882,46.118,79,49.964,79  h0.071C53.882,79,57,75.882,57,72.035V28.964z" />
                                            </svg>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#myCarousel" data-slide="next">
                            <svg xmlns="http://www.w3.org/2000/svg" class="yyag" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                <path d="M50.433,0.892c-27.119,0-49.102,21.983-49.102,49.102s21.983,49.103,49.102,49.103s49.101-21.984,49.101-49.103  S77.552,0.892,50.433,0.892z M78,51.036C78,54.882,74.882,58,71.036,58H57v14.035C57,75.882,53.882,79,50.036,79h-0.071  C46.118,79,43,75.882,43,72.035V58H27.964C24.118,58,21,54.882,21,51.036v-0.072C21,47.118,24.118,44,27.964,44H43V28.964  C43,25.118,46.118,22,49.964,22h0.071C53.882,22,57,25.118,57,28.964V44h14.036C74.882,44,78,47.118,78,50.964V51.036z" />
                                            </svg>
                        </a>
                    </div>
                </div>

            </div>

        </div>
        <div class="panel-footer text-center">
            <div class="text-center pull-left friend_stat">
                <div class="stat-title">
                   {{$survey->totalAnswers()}}
                </div>
                <div class="text-uppercase stat-text">
                    answers
                </div>
            </div>
            <a class="btn btn-social btn-twitter">
                <i class="fa fa-twitter"></i> Tweet
            </a>
            <a class="btn btn-social btn-facebook">
                <i class="fa fa-facebook"></i> Share
            </a>
            <div class="input-group input-xs pull-right shortcode">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-link"></i>
                                    </button>
                                  </span>
                <input type="text" class="form-control" value="rpsnt.cc/123">
            </div>
            <!-- /input-group -->
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Info</a>
                    </li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Asked by</a>
                    </li>
                    <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="info">                        
                     <p>   {{$survey->information}}</p>
                    </div>
                    <!--info-->
                    <?php  $author = $survey->getAuthor();?>

                    <div role="tabpanel" class="tab-pane" id="profile">

                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <?php if(isset($author->avatar) AND $author->avatar !=''):?>
                                <img src="{{$author->avatar or 'http://placehold.it/120x120'}}" class="img-thumbnail img-responsive" alt="" />
                                <?php endif;?>
                            </div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                              <a href="#" class="user author">{{ $author->firstname or '' }} {{$author->lastname or ''}}</a>
                                </div>
                                <div class="comment-text">
                                   <p>{{ $author->bio or ''}}</p>
                                </div>
                            </div>
                        </div>


                        <div class="metadata">
                            <div class="date">{{ time_ago($survey->created_at)}}</div>
                        </div>
                        <div class="text">

                        </div>
                        <div class="actions">
                            <a><i class="star icon"></i> 18 Followers </a>
                            <i class="fa fa-facebook"></i>
                            <i class="fa fa-twitter"></i>
                            <i class="fa fa-linkedin"></i>
                            <i class="fa fa-mobile"></i>
                            <a href="#compare">Compare</a>
                            <a href="#compare">See all their questions</a>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="history">


                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge"><i class="glyphicon glyphicon-check"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Mussum ipsum cacilds</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                                        <pre>
                                    Question closed.Expiry date reached.
                                    2 minutes ago
                                     
                                    Elliot Funbear voted upyour reason
                                    1 hour ago
                                    Because this is no place to stop, between an ape and an angel.
                                    IAgree admin authorised this question.
                                    1 days ago
                                    Received 10 votes
                                    2 days ago
                                     
                                    4 days ago
                                    Justen Kitsune added this question.</pre>
                                        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis a ta de bolis, mais bolis eu num gostis.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Mussum ipsum cacilds</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                                        <p>Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge danger"><i class="glyphicon glyphicon-credit-card"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Mussum ipsum cacilds</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge info"><i class="glyphicon glyphicon-floppy-disk"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Mussum ipsum cacilds</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Mussum ipsum cacil onti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                                        <hr>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Action</a>
                                                </li>
                                                <li><a href="#">Another action</a>
                                                </li>
                                                <li><a href="#">Something else here</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Mussum ipsum cacilds</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Pa i latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge success"><i class="fa fa-thumbs-up"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Mussum ipsum cacilds</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra alavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--history-->
                </div>

            </div>

        </div>
    </div>
    </div>




    <!-- carousel-->
    </div>
    <!-- /.row -->

    </div>
    <!-- /.container -->

    @stop

