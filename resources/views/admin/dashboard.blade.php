  @extends('admin_layout')

  @section('admin_content')

      <div class="row">
          <div class="panel-body">
              <div class="col-md-12 w3ls-graph">
                  <div class="agileinfo-grap">
                      <div class="agileits-box">
                          <header class="agileits-box-header clearfix">
                              <h3>Thống kê doanh số</h3>
                              <div class="toolbar"></div>
                          </header>
                          <div class="agileits-box-body clearfix">
                              <form autocomplete="off">
                                  @csrf
                                  <div class="col-md-2">
                                      <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                                      <input type="button" class="btn btn-primary btn-sm" id="btn-filter-dashboard"
                                          value="Lọc kết quả">
                                  </div>
                                  <div class="col-md-2">
                                      <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                                  </div>

                                  <div class="col-md-2">
                                      <p>Lọc theo:
                                          <select name="dashboard-filter" class="form-control dashboard-filter">
                                              <option value="none">---Chon---</option>
                                              <option value="7days">7 ngày qua</option>
                                              <option value="lastmonth">Tháng trước</option>
                                              <option value="thismonth">Tháng này</option>
                                              <option value="365days">365 ngày qua</option>
                                          </select>
                                      </p>
                                  </div>

                                  <div class="col-md-12">
                                      <div id="chart" style="height: 250px;"></div>
                                  </div>

                              </form>

                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>

      <!-- //market-->
      <div class="market-updates">
          <div class="col-md-3 market-update-gd">
              <div class="market-update-block clr-block-2">
                  <div class="col-md-4 market-update-right">
                      <i class="fa fa-eye"> </i>
                  </div>
                  <div class="col-md-8 market-update-left">
                      <h4>Visitors</h4>
                      <h3>13,500</h3>
                      <p>Other hand, we denounce</p>
                  </div>
                  <div class="clearfix"> </div>
              </div>
          </div>
          <div class="col-md-3 market-update-gd">
              <div class="market-update-block clr-block-1">
                  <div class="col-md-4 market-update-right">
                      <i class="fa fa-users"></i>
                  </div>
                  <div class="col-md-8 market-update-left">
                      <h4>Users</h4>
                      <h3>1,250</h3>
                      <p>Other hand, we denounce</p>
                  </div>
                  <div class="clearfix"> </div>
              </div>
          </div>
          <div class="col-md-3 market-update-gd">
              <div class="market-update-block clr-block-3">
                  <div class="col-md-4 market-update-right">
                      <i class="fa fa-usd"></i>
                  </div>
                  <div class="col-md-8 market-update-left">
                      <h4>Sales</h4>
                      <h3>1,500</h3>
                      <p>Other hand, we denounce</p>
                  </div>
                  <div class="clearfix"> </div>
              </div>
          </div>
          <div class="col-md-3 market-update-gd">
              <div class="market-update-block clr-block-4">
                  <div class="col-md-4 market-update-right">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-8 market-update-left">
                      <h4>Orders</h4>
                      <h3>1,500</h3>
                      <p>Other hand, we denounce</p>
                  </div>
                  <div class="clearfix"> </div>
              </div>
          </div>
          <div class="clearfix"> </div>
      </div>
      <!-- //market-->
      <div class="row">
          <div class="panel-body">
              <div class="col-md-12 w3ls-graph">
                  <!--agileinfo-grap-->
                  <div class="agileinfo-grap">
                      <div class="agileits-box">
                          <header class="agileits-box-header clearfix">
                              <h3>Visitor Statistics</h3>
                              <div class="toolbar">

                              </div>
                          </header>
                          <div class="agileits-box-body clearfix">
                              <div class="col-md-12">

                                  <table class="table table-bordered border-primary table-success">
                                      <thead>
                                          <tr>
                                              <th scope="col">Đang online</th>
                                              <th scope="col">Tổng tháng trước</th>
                                              <th scope="col">Tổng tháng này</th>
                                              <th scope="col">Tổng một năm</th>
                                              <th scope="col">Tổng truy cập</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>{{ $visitor_count }}</td>
                                              <td>{{ $visitor_last_month_count }}</td>
                                              <td>{{ $visitor_this_month_count }}</td>
                                              <td>{{ $visitor_year_count }}</td>
                                              <td>{{ $visitors_total }}</td>
                                          </tr>

                                      </tbody>
                                  </table>

                              </div>
                              <div class="col-md-4 col-xs-12">
                                  <div id="donut"></div>
                              </div>
                              <div class="col-md-4 col-xs-12">
                                  <div>
                                      <h6>Bài viết xem nhiều</h6>
                                      <ol class="list_views">
                                          @foreach ($post_views as $key => $v_post_views)
                                              <li><a target="_blank"
                                                      href="{{ url('details-post/' . $v_post_views->post_slug) }}">{{ $v_post_views->post_title }}</a> | ({{$v_post_views->post_views}})
                                              </li>
                                          @endforeach
                                      </ol>
                                  </div>
                              </div>

                              <div class="col-md-4 col-xs-12">
                                <div>
                                    <h6>Sản phẩm xem nhiều</h6>
                                    <ol class="list_views">
                                        @foreach ($product_views as $key => $v_product_views)
                                            <li><a target="_blank"
                                                    href="{{ url('details-product/' . $v_product_views->product_slug) }}">{{ $v_product_views->product_name }}</a> | ({{$v_product_views->product_views}})
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>

                          </div>
                          <div id="hero-area"></div>
                      </div>
                  </div>
                  <!--//agileinfo-grap-->

              </div>
          </div>
      </div>
      <div class="agil-info-calendar">
          <!-- calendar -->
          <div class="col-md-6 agile-calendar">
              <div class="calendar-widget">
                  <div class="panel-heading ui-sortable-handle">
                      <span class="panel-icon">
                          <i class="fa fa-calendar-o"></i>
                      </span>
                      <span class="panel-title"> Calendar Widget</span>
                  </div>
                  <!-- grids -->
                  <div class="agile-calendar-grid">
                      <div class="page">

                          <div class="w3l-calendar-left">
                              <div class="calendar-heading">

                              </div>
                              <div class="monthly" id="mycalendar"></div>
                          </div>

                          <div class="clearfix"> </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- //calendar -->
          <div class="col-md-6 w3agile-notifications">
              <div class="notifications">
                  <!--notification start-->

                  <header class="panel-heading">
                      Notification
                  </header>
                  <div class="notify-w3ls">
                      <div class="alert alert-info clearfix">
                          <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                          <div class="notification-info">
                              <ul class="clearfix notification-meta">
                                  <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> send
                                      you a mail </li>
                                  <li class="pull-right notification-time">1 min ago</li>
                              </ul>
                              <p>
                                  Urgent meeting for next proposal
                              </p>
                          </div>
                      </div>
                      <div class="alert alert-danger">
                          <span class="alert-icon"><i class="fa fa-facebook"></i></span>
                          <div class="notification-info">
                              <ul class="clearfix notification-meta">
                                  <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span>
                                      mentioned you in a post </li>
                                  <li class="pull-right notification-time">7 Hours Ago</li>
                              </ul>
                              <p>
                                  Very cool photo jack
                              </p>
                          </div>
                      </div>
                      <div class="alert alert-success ">
                          <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                          <div class="notification-info">
                              <ul class="clearfix notification-meta">
                                  <li class="pull-left notification-sender">You have 5 message unread</li>
                                  <li class="pull-right notification-time">1 min ago</li>
                              </ul>
                              <p>
                                  <a href="#">Anjelina Mewlo, Jack Flip</a> and <a href="#">3 others</a>
                              </p>
                          </div>
                      </div>
                      <div class="alert alert-warning ">
                          <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
                          <div class="notification-info">
                              <ul class="clearfix notification-meta">
                                  <li class="pull-left notification-sender">Domain Renew Deadline 7 days ahead</li>
                                  <li class="pull-right notification-time">5 Days Ago</li>
                              </ul>
                              <p>
                                  Next 5 July Thursday is the last day
                              </p>
                          </div>
                      </div>
                      <div class="alert alert-info clearfix">
                          <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                          <div class="notification-info">
                              <ul class="clearfix notification-meta">
                                  <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> send
                                      you a mail </li>
                                  <li class="pull-right notification-time">1 min ago</li>
                              </ul>
                              <p>
                                  Urgent meeting for next proposal
                              </p>
                          </div>
                      </div>

                  </div>

                  <!--notification end-->
              </div>
          </div>
          <div class="clearfix"> </div>
      </div>
      <!-- tasks -->
      <div class="agile-last-grids">
          <div class="col-md-4 agile-last-left">
              <div class="agile-last-grid">
                  <div class="area-grids-heading">
                      <h3>Monthly</h3>
                  </div>
                  <div id="graph7"></div>
                  <script>
                      // This crosses a DST boundary in the UK.
                      Morris.Area({
                          element: 'graph7',
                          data: [{
                                  x: '2013-03-30 22:00:00',
                                  y: 3,
                                  z: 3
                              },
                              {
                                  x: '2013-03-31 00:00:00',
                                  y: 2,
                                  z: 0
                              },
                              {
                                  x: '2013-03-31 02:00:00',
                                  y: 0,
                                  z: 2
                              },
                              {
                                  x: '2013-03-31 04:00:00',
                                  y: 4,
                                  z: 4
                              }
                          ],
                          xkey: 'x',
                          ykeys: ['y', 'z'],
                          labels: ['Y', 'Z']
                      });
                  </script>

              </div>
          </div>
          <div class="col-md-4 agile-last-left agile-last-middle">
              <div class="agile-last-grid">
                  <div class="area-grids-heading">
                      <h3>Daily</h3>
                  </div>
                  <div id="graph8"></div>
                  <script>
                      /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
                      var day_data = [{
                              "period": "2016-10-01",
                              "licensed": 3407,
                              "sorned": 660
                          },
                          {
                              "period": "2016-09-30",
                              "licensed": 3351,
                              "sorned": 629
                          },
                          {
                              "period": "2016-09-29",
                              "licensed": 3269,
                              "sorned": 618
                          },
                          {
                              "period": "2016-09-20",
                              "licensed": 3246,
                              "sorned": 661
                          },
                          {
                              "period": "2016-09-19",
                              "licensed": 3257,
                              "sorned": 667
                          },
                          {
                              "period": "2016-09-18",
                              "licensed": 3248,
                              "sorned": 627
                          },
                          {
                              "period": "2016-09-17",
                              "licensed": 3171,
                              "sorned": 660
                          },
                          {
                              "period": "2016-09-16",
                              "licensed": 3171,
                              "sorned": 676
                          },
                          {
                              "period": "2016-09-15",
                              "licensed": 3201,
                              "sorned": 656
                          },
                          {
                              "period": "2016-09-10",
                              "licensed": 3215,
                              "sorned": 622
                          }
                      ];
                      Morris.Bar({
                          element: 'graph8',
                          data: day_data,
                          xkey: 'period',
                          ykeys: ['licensed', 'sorned'],
                          labels: ['Licensed', 'SORN'],
                          xLabelAngle: 60
                      });
                  </script>
              </div>
          </div>
          <div class="col-md-4 agile-last-left agile-last-right">
              <div class="agile-last-grid">
                  <div class="area-grids-heading">
                      <h3>Yearly</h3>
                  </div>
                  <div id="graph9"></div>
                  <script>
                      var day_data = [{
                              "elapsed": "I",
                              "value": 34
                          },
                          {
                              "elapsed": "II",
                              "value": 24
                          },
                          {
                              "elapsed": "III",
                              "value": 3
                          },
                          {
                              "elapsed": "IV",
                              "value": 12
                          },
                          {
                              "elapsed": "V",
                              "value": 13
                          },
                          {
                              "elapsed": "VI",
                              "value": 22
                          },
                          {
                              "elapsed": "VII",
                              "value": 5
                          },
                          {
                              "elapsed": "VIII",
                              "value": 26
                          },
                          {
                              "elapsed": "IX",
                              "value": 12
                          },
                          {
                              "elapsed": "X",
                              "value": 19
                          }
                      ];
                      Morris.Line({
                          element: 'graph9',
                          data: day_data,
                          xkey: 'elapsed',
                          ykeys: ['value'],
                          labels: ['value'],
                          parseTime: false
                      });
                  </script>

              </div>
          </div>
          <div class="clearfix"> </div>
      </div>
      <!-- //tasks -->
      <div class="agileits-w3layouts-stats">
          <div class="col-md-4 stats-info widget">
              <div class="stats-info-agileits">
                  <div class="stats-title">
                      <h4 class="title">Browser Stats</h4>
                  </div>
                  <div class="stats-body">
                      <ul class="list-unstyled">
                          <li>GoogleChrome <span class="pull-right">85%</span>
                              <div class="progress progress-striped active progress-right">
                                  <div class="bar green" style="width:85%;"></div>
                              </div>
                          </li>
                          <li>Firefox <span class="pull-right">35%</span>
                              <div class="progress progress-striped active progress-right">
                                  <div class="bar yellow" style="width:35%;"></div>
                              </div>
                          </li>
                          <li>Internet Explorer <span class="pull-right">78%</span>
                              <div class="progress progress-striped active progress-right">
                                  <div class="bar red" style="width:78%;"></div>
                              </div>
                          </li>
                          <li>Safari <span class="pull-right">50%</span>
                              <div class="progress progress-striped active progress-right">
                                  <div class="bar blue" style="width:50%;"></div>
                              </div>
                          </li>
                          <li>Opera <span class="pull-right">80%</span>
                              <div class="progress progress-striped active progress-right">
                                  <div class="bar light-blue" style="width:80%;"></div>
                              </div>
                          </li>
                          <li class="last">Others <span class="pull-right">60%</span>
                              <div class="progress progress-striped active progress-right">
                                  <div class="bar orange" style="width:60%;"></div>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="col-md-8 stats-info stats-last widget-shadow">
              <div class="stats-last-agile">
                  <table class="table stats-table ">
                      <thead>
                          <tr>
                              <th>S.NO</th>
                              <th>PRODUCT</th>
                              <th>STATUS</th>
                              <th>PROGRESS</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <th scope="row">1</th>
                              <td>Lorem ipsum</td>
                              <td><span class="label label-success">In progress</span></td>
                              <td>
                                  <h5>85% <i class="fa fa-level-up"></i></h5>
                              </td>
                          </tr>
                          <tr>
                              <th scope="row">2</th>
                              <td>Aliquam</td>
                              <td><span class="label label-warning">New</span></td>
                              <td>
                                  <h5>35% <i class="fa fa-level-up"></i></h5>
                              </td>
                          </tr>
                          <tr>
                              <th scope="row">3</th>
                              <td>Lorem ipsum</td>
                              <td><span class="label label-danger">Overdue</span></td>
                              <td>
                                  <h5 class="down">40% <i class="fa fa-level-down"></i></h5>
                              </td>
                          </tr>
                          <tr>
                              <th scope="row">4</th>
                              <td>Aliquam</td>
                              <td><span class="label label-info">Out of stock</span></td>
                              <td>
                                  <h5>100% <i class="fa fa-level-up"></i></h5>
                              </td>
                          </tr>
                          <tr>
                              <th scope="row">5</th>
                              <td>Lorem ipsum</td>
                              <td><span class="label label-success">In progress</span></td>
                              <td>
                                  <h5 class="down">10% <i class="fa fa-level-down"></i></h5>
                              </td>
                          </tr>
                          <tr>
                              <th scope="row">6</th>
                              <td>Aliquam</td>
                              <td><span class="label label-warning">New</span></td>
                              <td>
                                  <h5>38% <i class="fa fa-level-up"></i></h5>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div class="clearfix"> </div>
      </div>

  @endsection
