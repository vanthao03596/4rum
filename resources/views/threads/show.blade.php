@extends('layouts.master')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('thread', $thread))
<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            <article class="question single-question question-type-normal">
                <h2>
                <a href="#">{{ $thread->title }}</a>
                </h2>
                <a class="question-report" href="single_question.html#">Report</a>
                <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                <div class="question-inner">
                    <div class="clearfix"></div>
                    <div class="question-desc">
                        <p>{{ $thread->body }}</p>
                        @can('delete', $thread)
                            <form action="{{ route('threads.delete', [$thread->channel->slug, $thread->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="button small red-button">Delete</a>
                            </form>
                        @endcan
                    </div>
                    <div class="question-details">
                        <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                        <span class="question-favorite"><i class="icon-star"></i>5</span>
                    </div>
                    <span class="question-category"><a href="single_question.html#"><i class="icon-folder-close"></i>{{ $thread->channel->id }}</a></span>
                    <span class="question-date"><i class="icon-time"></i>{{ $thread->created_at }}</span>
                    <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{ $thread->replies_count }} Answer</a></span>
                    <span class="question-view"><i class="icon-user"></i>70 views</span>
                    <span class="single-question-vote-result">+22</span>
                    <ul class="single-question-vote">
                        <li><a href="single_question.html#" class="single-question-vote-down" title="Dislike"><i class="icon-thumbs-down"></i></a></li>
                        <li><a href="single_question.html#" class="single-question-vote-up" title="Like"><i class="icon-thumbs-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </article>

            @include('threads.inc.share_tag')
            <!-- End share-tags -->

            @include('threads.inc.about')
            <!-- End about-author -->

            @include('threads.inc.related')
            <!-- End related-posts -->
            <div id="commentlist" class="page-content">
                    <div class="boxedtitle page-title">
                        <h2>Answers ( <span class="color">{{ $thread->replies_count }}</span> )</h2>
                    </div>
                    @if($thread->replies_count > 0)
                        @include('threads.inc.comments.comment_list', ['collection' => $comments['root']])
                    @endif
            </div>
            <!-- End page-content -->
            @guest
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate
            @else
                @include('threads.inc.form')
            @endguest
            <div class="post-next-prev clearfix">
                @if($thread->previous())
                <p class="prev-post">
                    <a href="{{ $previous->path() }}"><i class="icon-double-angle-left"></i>&nbsp;Prev question</a>
                </p>
                @endif
                @if($thread->next())
                <p class="next-post">
                    <a href="{{ $next->path() }}">Next question&nbsp;<i class="icon-double-angle-right"></i></a>
                </p>
                @endif
            </div><!-- End post-next-prev -->
        </div><!-- End main -->
        @include('partials.sidebar')
        <!-- End sidebar -->
    </div><!-- End row -->
</section><!-- End container -->
@stop
