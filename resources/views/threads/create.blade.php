@extends('layouts.master')
@section('breadcrumbs', Breadcrumbs::render('create'))
@section('content')
<section class="container main-content">
    <div class="row">
        <div class="col-md-9">

            <div class="page-content ask-question">
                <div class="boxedtitle page-title"><h2>Ask Question</h2></div>

                <p>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque.</p>

                <div class="form-style form-style-3" id="question-submit">
                    <form method="POST" action="{{ route('threads.store') }}">
                        @csrf
                        <div class="form-inputs clearfix">
                            <p>
                                <label class="required">Question Title<span>*</span></label>
                            <input name="title" type="text" id="question-title" value="{{ old('title') }}" required>
                            @if($errors->has('title'))
                                <span class="form-description text-danger">{{ $errors->first('title')}}</span>
                            @endif
                            </p>
                            <p>
                                <label>Tags</label>
                                <input type="text" class="input" name="tags" id="question_tags" data-seperator=",">
                                <span class="form-description">Please choose  suitable Keywords Ex : <span class="color">question , poll</span> .</span>
                            </p>
                            <p>
                                <label class="required">Channel<span>*</span></label>
                                <span class="styled-select">
                                    <select name="channel_id">
                                        <option value="">Select a Channel</option>
                                        @foreach ($channels as $channel)
                                            <option {{ old('channel_id') == $channel->id ? 'selected' : '' }} value="{{ $channel->id }}">{{ $channel->name }}</option>
                                        @endforeach
                                    </select>
                                </span>
                                @if($errors->has('channel_id'))
                                    <span class="form-description text-danger">{{ $errors->first('channel_id')}}</span>
                                @else
                                <span class="form-description">Please choose the appropriate section so easily search for your question .</span>
                                @endif

                            </p>
                            <!-- <p class="question_poll_p">
                                <label for="question_poll">Poll</label>
                                <input type="checkbox" id="question_poll" value="1" name="question_poll">
                                <span class="question_poll">This question is a poll ?</span>
                                <span class="poll-description">If you want to be doing a poll click here .</span>
                            </p>
                            <div class="clearfix"></div>
                            <div class="poll_options">
                                <p class="form-submit add_poll">
                                    <button id="add_poll" type="button" class="button color small submit"><i class="icon-plus"></i>Add Field</button>
                                </p>
                                <ul id="question_poll_item">
                                    <li id="poll_li_1">
                                        <div class="poll-li">
                                            <p><input id="ask[1][title]" class="ask" name="ask[1][title]" value="" type="text"></p>
                                            <input id="ask[1][value]" name="ask[1][value]" value="" type="hidden">
                                            <input id="ask[1][id]" name="ask[1][id]" value="1" type="hidden">
                                            <div class="del-poll-li"><i class="icon-remove"></i></div>
                                            <div class="move-poll-li"><i class="icon-fullscreen"></i></div>
                                        </div>
                                    </li>
                                </ul>
                                <script> var nextli = 2;</script>
                                <div class="clearfix"></div>
                            </div> -->

                            <label>Attachment</label>
                            <div class="fileinputs">
                                <input name="attachment" type="file" class="file">
                                <div class="fakefile">
                                    <button type="button" class="button small margin_0">Select file</button>
                                    <span><i class="icon-arrow-up"></i>Browse</span>
                                </div>
                            </div>

                        </div>
                        <div id="form-textarea">
                            <p>
                                <label class="required">Details<span>*</span></label>
                            <wysiwyg name="body"></wysiwyg>
                                @if($errors->has('body'))
                                    <span class="form-description text-danger">{{ $errors->first('body')}}</span>
                                @else
                                    <span class="form-description">Type the description thoroughly and in detail .</span>
                                @endif
                            </p>
                        </div>
                        <p class="form-submit">
                            <input type="submit" id="publish-question" value="Publish Your Question" class="button color small submit">
                        </p>
                    </form>
                </div>
            </div><!-- End page-content -->
        </div><!-- End main -->
        @include('partials.sidebar')
    </div><!-- End row -->
</section><!-- End container -->
@stop
