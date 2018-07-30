@extends('layouts.master')

@section('breadcrumbs', isset($channel) ? Breadcrumbs::render('channel', $channel) : Breadcrumbs::render('home'))

@section('content')
<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
                @if(count($threads) > 0)
                @foreach($threads as $thread)
                    <article class="question question-type-normal">
                        <h2>
                        <a href="{{ url($thread->path()) }}">{{ $thread->title }}</a>
                        </h2>
                        <a class="question-report" href="index_no_box.html#">Report</a>
                        <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                        <div class="question-author">
                            <a href="{{ route('profile.show', $thread->creator->name) }}" original-title="{{ $thread->creator->name }}" class="tooltip-n"><img src="{{ Avatar::create($thread->creator->name)->toBase64() }}" /></a>
                        </div>
                        <div class="question-inner">
                            <div class="clearfix"></div>
                        <p class="question-desc">{{ $thread->body }}.</p>
                            <div class="question-details">
                                <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                                <span class="question-favorite"><i class="icon-star"></i>5</span>
                            </div>
                            <span class="question-category"><a href="{{ $thread->channel->path() }}"><i class="icon-folder-close"></i>{{ $thread->channel->name }}</a></span>
                        <span class="question-date"><i class="icon-time"></i>{{ $thread->created_at}}</span>
                            <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{ $thread->replies_count }} Answer</a></span>
                            <span class="question-view"><i class="icon-user"></i>70 views</span>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                @endforeach
            @endif
            <a href="cat_question.html#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
        </div><!-- End main -->
        @include('partials.sidebar')
    </div><!-- End row -->
</section>

@stop
