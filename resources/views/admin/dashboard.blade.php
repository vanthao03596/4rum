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
        <span class="info-box-text">Questions</span>
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
        <span class="info-box-text">Likes</span>
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
        <span class="info-box-text">Comments</span>
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
        <span class="info-box-text">New Members</span>
        <span class="info-box-number" id="user">2,000</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


</div>
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Question Chart</h3>

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
    <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Questions</h3>

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
                <th>Title</th>
                <th>View</th>
                <th>Total Reply</th>
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
          <a href="{{ route('admin.threads.index') }}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
        </div>
        <!-- /.box-footer -->
    </div>
  </div>
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Reply Chart</h3>

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
    <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Reply</h3>

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
                <th>Message</th>
                <th>Owner</th>
                <th>Favorite</th>
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
          <a href="{{ url('/admin/replies') }}" class="btn btn-sm btn-default btn-flat pull-right">View All Reply</a>
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
    var myQuestion = new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($threads->keys()),
        datasets: [{
          label: 'Question per Month',
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
