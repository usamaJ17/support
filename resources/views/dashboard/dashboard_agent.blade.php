  @extends('layout.main')
  @section('content')
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Dashboard</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                          <!-- <li class="breadcrumb-item active">Starter Page</li> -->
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                      <!-- Widget: user widget style 1 -->
                      <div class="card card-widget widget-user shadow-lg">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header text-white" style="background: url('{{$user->getMedia()[1]->getFullUrl()}}') ; background-repeat: no-repeat ; background-size: cover">
                            <h3 class="widget-user-username text-right">{{$user->name}}</h3>
                            <h5 class="widget-user-desc text-right">{{$user->email}}</h5>
                          </div>
                          <div class="widget-user-image">
                            <img class="img-circle" src="{{$user->getMedia()[0]->getFullUrl()}}" style="height: 128px ;width: 128px " alt="User Avatar">
                          </div>
                          <div class="card-footer">
                              <div class="row">
                                  <div class="col-sm-3 border-right">
                                      <div class="description-block">
                                          <h5 class="description-header">3</h5>
                                          <span class="description-text">free agents</span>
                                      </div>
                                      <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-3 border-right">
                                      <div class="description-block">
                                          <h5 class="description-header">9</h5>
                                          <span class="description-text">agents engaged</span>
                                      </div>
                                      <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-3">
                                      <div class="description-block border-right">
                                          <h5 class="description-header">3</h5>
                                          <span class="description-text">Tickets Pending</span>
                                      </div>
                                      <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-3">
                                      <div class="description-block">
                                          <h5 class="description-header">2</h5>
                                          <span class="description-text">Chat Request</span>

                                      </div>
                                      <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                              </div>
                              <!-- /.row -->
                          </div>
                      </div>
                      <!-- /.widget-user -->
                  </div>
              </div>
              <!-- board -->
              <div class="row">
                  <div class="col-md-12">
                      <!-- Line chart -->
                      <div class="card card-primary card-outline">
                          <div class="card-header">
                              <h3 class="card-title">
                                  <i class="far fa-chart-bar"></i>
                                  Stats (user and agents)
                              </h3>

                              <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="card-body">
                              <div id="line-chart" style="height: 300px;"></div>
                          </div>
                          <!-- /.card-body-->
                      </div>
                  </div><!-- /.container-fluid -->
              </div>
              <!-- /.content -->
          </div>
      </div>
  @endsection
  <!-- page specific -->
  @section('scripts')
  <script src="{{url('/plugins/flot/jquery.flot.js')}}"></script>
    <script>
        $(function () {
          /*
           * LINE CHART
           * ----------
           */
          //LINE randomly generated data
          var time = 1;
          var sin = [],
              cos = []
          var interval = setInterval(function() { 
           if (time<35){
              time++;
                sin.push([time, Math.sin(time)])
                cos.push([time, Math.cos(time)])
              var line_data1 = {
                data : sin,
                color: '#9fe205'
              }
              var line_data2 = {
                data : cos,
                color: '#00c0ef'
              }
              $.plot('#line-chart', [line_data1, line_data2], {
                grid  : {
                  hoverable  : true,
                  borderColor: '#f3f3f3',
                  borderWidth: 1,
                  tickColor  : '#f3f3f3'
                },
                series: {
                  shadowSize: 0,
                  lines     : {
                    show: true
                  },
                  points    : {
                    show: true
                  }
                },
                lines : {
                  fill : false,
                  color: ['#3c8dbc', '#f56954']
                },
                yaxis : {
                  show: true
                },
                xaxis : {
                  show: true
                }
              })
              //Initialize tooltip on hover
              $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
                position: 'absolute',
                display : 'none',
                opacity : 0.8
              }).appendTo('body')
              $('#line-chart').bind('plothover', function (event, pos, item) {
      
                if (item) {
                  var x = item.datapoint[0].toFixed(2),
                      y = item.datapoint[1].toFixed(2)
      
                  $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
                    .css({
                      top : item.pageY + 5,
                      left: item.pageX + 5
                    })
                    .fadeIn(200)
                } else {
                  $('#line-chart-tooltip').hide()
                }
      
              })
              /* END LINE CHART */
            }
            else{
              clearInterval(interval);
            }
          }, 3000);
        })
      
        /*
         * Custom Label formatter
         * ----------------------
         */
        function labelFormatter(label, series) {
          return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
            + label
            + '<br>'
            + Math.round(series.percent) + '%</div>'
        }
      </script>
  @endsection


