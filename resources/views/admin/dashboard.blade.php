@extends('adminlte::page') @section('title', trans('admin.dashboard')) @section('content_header')
<div class="box-header">
  {{ Breadcrumbs::view('admin.partials.breadcrumbs', 'admin.dashboard') }}
</div>
@stop @section('content')
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua">
        <i class="icon ion-compose"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">@lang('admin.threads')</span>
        <span class="info-box-number" id="thread">90</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red">
        <i class="fa fa-thumbs-o-up "></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">@lang('admin.like')</span>
        <span class="info-box-number" id="favorite">0</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green">
        <i class="fa fa-fw fa-commenting-o"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">@lang('admin.replies')</span>
        <span class="info-box-number" id="reply">760</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow">
        <i class="ion ion-ios-people-outline"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">@lang('admin.new_member')</span>
        <span class="info-box-number" id="user">2,000</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


</div>
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">@lang('admin.question_per_month')</a></li>
              <li><a href="#tab_2" data-toggle="tab">@lang('admin.question_this_month')</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.question_chart')</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="myQuestion" style="height:250px"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">@lang('admin.question_chart')</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="myQuestionDay" style="height:250px"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">@lang('admin.reply_chart')</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove">
            <i class="fa fa-times"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="myReply" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">

    <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('admin.latest_reply')</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>ID</th>
                <th>@lang('admin.message')</th>
                <th>@lang('admin.creator')</th>
                <th>@lang('admin.favorite')</th>
              </tr>
              </thead>
              <tbody>
              @foreach($latestReplies as $reply)
                <tr>
                  <td><a href="{{ $reply->path() }}">{{ $reply->id }}</a></td>
                  <td><a href="{{ $reply->path() }}" data-toggle="tooltip" title="{{ $reply->message }}">{{ $reply->short_message }}</a></td>
                  <td><span class="label label-success">{{ $reply->owner->name }}</span></td>
                  <td><span class="label label-info">{{ $reply->favorites->count() }}</span></td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="{{ url('/admin/replies') }}" class="btn btn-sm btn-default btn-flat pull-right">@lang('admin.view_all_reply')</a>
        </div>
        <!-- /.box-footer -->
    </div>

  </div>
  <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('admin.latest_question')</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>ID</th>
                <th>@lang('admin.title')</th>
                <th>@lang('admin.view_count')</th>
                <th>@lang('admin.reply_count')</th>
              </tr>
              </thead>
              <tbody>
              @foreach($latestQuestions as $question)
                <tr>
                  <td><a href="{{ $question->path() }}">{{ $question->id }}</a></td>
                  <td>{{ $question->title }}</td>
                  <td><span class="label label-success">{{ $question->view_count }}</span></td>
                  <td><span class="label label-info">{{ $question->replies_count }}</span></td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="{{ route('admin.threads.index') }}" class="btn btn-sm btn-default btn-flat pull-right">@lang('admin.view_all_question')</a>
        </div>
        <!-- /.box-footer -->
    </div>
  </div>
</div>


@stop
@section('css')
@stop
@section('js')
<script src="{{ asset('js/countUp.js') }}"></script>
<script>
  $(document).ready(function () {
    var thread = new CountUp('thread', 0, {{ $threadCount }}, 0, 2.5);
    if (!thread.error) {
      thread.start();
    } else {}
    var favorite = new CountUp('favorite', 0, {{$favoriteCount}}, 0, 2.5);
    if (!favorite.error) {
      favorite.start();
    } else {}
    var reply = new CountUp('reply', 0, {{$replyCount}}, 0, 2.5);
    if (!reply.error) {
      reply.start();
    } else {}
    var user = new CountUp('user', 0, {{$userCount}}, 0, 2.5);
    if (!user.error) {
      user.start();
    } else {}

    //chart
    var ctx = document.getElementById("myQuestion").getContext('2d');
    var reply = document.getElementById("myReply").getContext('2d');
    var questionDay = document.getElementById("myQuestionDay").getContext('2d');
    var myQuestion = new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($threads->keys()),
        datasets: [{
          label: '@lang('admin.question_per_month')',
          borderColor: "#3e95cd",
          backgroundColor: "#3e95cd",
          fill: false,
          data: @json($threads->values()),

        }, ]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
    var myQuestionDay = new Chart(questionDay, {
      type: 'line',
      data: {
        labels: @json($threadDay->keys()),
        datasets: [{
          label: '@lang('admin.question_this_month')',
          borderColor: "#3e95cd",
          backgroundColor: "#3e95cd",
          fill: false,
          data: @json($threadDay->values()),

        }, ]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
    var myReply = new Chart(reply, {
      type: 'bar',
      data: {
        labels: @json($replies->keys()),
        datasets: [{
          label: 'Reply per Month',
          borderColor: "#c45850",
          backgroundColor: "#c45850",
          fill: false,
          data: @json($replies->values()),

        }, ]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  });
</script>
@stop
