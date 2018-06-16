@extends('layouts.master')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            <div class="tabs-warp question-tab">
                <ul class="tabs">
                    <li class="tab"><a href="index_no_box.html#" class="current">Recent Questions</a></li>
                    <li class="tab"><a href="index_no_box.html#">Most Responses</a></li>
                    <li class="tab"><a href="index_no_box.html#">Recently Answered</a></li>
                    <li class="tab"><a href="index_no_box.html#">No answers</a></li>
                </ul>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @if(count($recent_question) > 0)
                            @foreach($recent_question as $rq)
                                <article class="question question-type-normal">
                                    <h2>
                                    <a href="{{ url($rq->path()) }}">{{ $rq->title }}</a>
                                    </h2>
                                    <a class="question-report" href="index_no_box.html#">Report</a>
                                    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                                    <div class="question-author">
                                        <a href="{{ route('profile.show', $rq->creator->name ) }}" original-title="ahmed" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ Avatar::create($rq->creator->name)->toBase64() }}"></a>
                                    </div>
                                    <div class="question-inner">
                                        <div class="clearfix"></div>
                                    <p class="question-desc">{{ $rq->body }}.</p>
                                        <div class="question-details">
                                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                                            <span class="question-favorite"><i class="icon-star"></i>5</span>
                                        </div>
                                        <span class="question-category"><a href="index_no_box.html#"><i class="icon-folder-close"></i>{{ $rq->channel->name }}</a></span>
                                    <span class="question-date"><i class="icon-time"></i>{{ $rq->created_at}}</span>
                                        <span class="question-comment"><a href="index_no_box.html#"><i class="icon-comment"></i>{{ $rq->replies_count }} Answer</a></span>
                                        <span class="question-view"><i class="icon-user"></i>70 views</span>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            @endforeach
                        @endif
                        <a href="index_no_box.html#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @if(count($most_response) > 0)
                            @foreach($most_response as $ms)
                                <article class="question question-type-normal">
                                    <h2>
                                    <a href="{{ url($ms->path()) }}">{{ $ms->title }}</a>
                                    </h2>
                                    <a class="question-report" href="index_no_box.html#">Report</a>
                                    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                                    <div class="question-author">
                                        <a href="{{ route('profile.show', $ms->creator->name ) }}" original-title="ahmed" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ Avatar::create($ms->creator->name)->toBase64() }}"></a>
                                    </div>
                                    <div class="question-inner">
                                        <div class="clearfix"></div>
                                        <p class="question-desc">{{ $ms->body}}.</p>
                                        <div class="question-details">
                                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                                            <span class="question-favorite"><i class="icon-star"></i>5</span>
                                        </div>
                                        <span class="question-category"><a href="index_no_box.html#"><i class="icon-folder-close"></i>wordpress</a></span>
                                        <span class="question-date"><i class="icon-time"></i>{{ $ms->created_at }}</span>
                                        <span class="question-comment"><a href="index_no_box.html#"><i class="icon-comment"></i>{{ $ms->replies_count }} Answer</a></span>
                                        <span class="question-view"><i class="icon-user"></i>70 views</span>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            @endforeach
                        <a href="index_no_box.html#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
                        @endif
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @if(count($recently_answer) > 0)
                            @foreach($recently_answer as $ra)
                            <article class="question question-type-normal">
                                    <h2>
                                    <a href="{{ url($ra->path()) }}">{{ $ra->title }}</a>
                                    </h2>
                                    <a class="question-report" href="index_no_box.html#">Report</a>
                                    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                                    <div class="question-author">
                                        <a href="{{ route('profile.show', $ra->creator->name ) }}" original-title="ahmed" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ Avatar::create($ra->creator->name)->toBase64() }}"></a>
                                    </div>
                                    <div class="question-inner">
                                        <div class="clearfix"></div>
                                        <p class="question-desc">{{ $ra->body}}.</p>
                                        <div class="question-details">
                                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                                            <span class="question-favorite"><i class="icon-star"></i>5</span>
                                        </div>
                                        <span class="question-category"><a href="index_no_box.html#"><i class="icon-folder-close"></i>{{ $ra->channel->name }}</a></span>
                                        <span class="question-date"><i class="icon-time"></i>{{ $ra->created_at }}</span>
                                        <span class="question-comment"><a href="index_no_box.html#"><i class="icon-comment"></i>{{ $ra->replies_count }} Answer</a></span>
                                        <span class="question-view"><i class="icon-user"></i>70 views</span>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            @endforeach
                        @endif
                        <a href="index_no_box.html#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                            @if(count($no_answer) > 0)
                            @foreach($no_answer as $na)
                            <article class="question question-type-normal">
                                    <h2>
                                    <a href="{{ url($na->path()) }}">{{ $na->title }}</a>
                                    </h2>
                                    <a class="question-report" href="index_no_box.html#">Report</a>
                                    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                                    <div class="question-author">
                                        <a href="{{ route('profile.show', $na->creator->name ) }}" original-title="ahmed" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ Avatar::create($na->creator->name)->toBase64() }}"></a>
                                    </div>
                                    <div class="question-inner">
                                        <div class="clearfix"></div>
                                        <p class="question-desc">{{ $na->body}}.</p>
                                        <div class="question-details">
                                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                                            <span class="question-favorite"><i class="icon-star"></i>5</span>
                                        </div>
                                        <span class="question-category"><a href="index_no_box.html#"><i class="icon-folder-close"></i>{{ $ra->channel->name }}</a></span>
                                        <span class="question-date"><i class="icon-time"></i>{{ $na->created_at }}</span>
                                        <span class="question-comment"><a href="index_no_box.html#"><i class="icon-comment"></i>{{ $na->replies_count }} Answer</a></span>
                                        <span class="question-view"><i class="icon-user"></i>70 views</span>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            @endforeach
                            <a href="index_no_box.html#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
                        @endif
                    </div>
                </div>
            </div><!-- End page-content -->
        </div><!-- End main -->
        @include('partials.sidebar')<!-- End sidebar -->
    </div><!-- End row -->
</section>

@stop