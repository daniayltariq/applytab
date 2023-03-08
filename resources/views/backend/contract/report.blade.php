<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

   <style>
      .bg-white {
          background: white;
      }
  
      .p-0 {
          padding: 0 !important;
      }
  
      .reports-info img {
          height: 20px;
      }
  
      .reports-info td {
          padding: 17px 5px 17px 35px;
          line-height: 20px;
          width: 25%;
          vertical-align: top;
      }
  
      .reports-info td .icon {
          float: left;
          margin-left: -33px;
          height: 24px;
          max-width: 24px;
          margin-top: 1px;
          font-size: 25px;
          color: #ffb2b2;
      }
  
      .reports-info td p {
          color: #7b8397;
          margin: 0;
          font-size: 14px;
          font-weight: 400;
      }
  
      .reports-info td h6 {
          color: #5a6480;
          margin: 0;
          font-size: 16px;
          font-weight: 700;
      }
  
      .reports-info td h2 {
          color: #5a6480;
          margin: 0;
          /* font-size: 16px; */
          font-weight: 700;
      }
  
      .table_heading {
          background: #f5f6f8;
          padding: 10px;
          font-size: 28px;
          font-weight: 700;
          color: #5a6480;
          text-transform: uppercase;
      }
  
      .doughnutText {
          position: absolute;
          top: 38;
          left: 50%;
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
      }
  
      .reports-info2 img {
          height: 20px;
      }
  
      .reports-info2 td {
          line-height: 20px;
          vertical-align: top;
      }
  
      .reports-info2 td .icon {
          float: left;
          margin-left: 0px;
          height: 24px;
          max-width: 24px;
          margin-left: -33px;
          margin-top: 1px;
          font-size: 25px;
          color: #c9cbd2;
      }
  
      .reports-info2 td p {
          color: #7b8397;
          margin: 0;
          font-size: 14px;
          font-weight: 400;
      }
  
      .reports-info2 td h6 {
          color: #5a6480;
          margin: 0;
          font-size: 16px;
          font-weight: 700;
      }
  
      .reports-info2 td h2 {
          color: #5a6480;
          margin: 0;
          /* font-size: 16px; */
          font-weight: 700;
      }
  
      @media print {
          #printToPDF {
              position: absolute;
              left: 0;
              top: 0;
          }
      }
  
      .logo-report{
          font-size: 3rem;
      }
  
      .bg__border{
        background: #5661b3;
    color: white;
          border-bottom: 2px solid grey;
      }
  
      .b_bottom_light{
          border-bottom: 2px solid rgb(199, 199, 199);
      }
  
      .tags span{
          font-size: 13px;
          margin: 4px 0px;
          white-space: nowrap;
      }
  
      .p-rel{
          position: relative;
      }
  
      .p-rel img{
          position: absolute;
          top: 20px;
          left: 5px;
          opacity: 0.6;
      }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
  integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
  crossorigin="anonymous"></script>
</head>
<body>
   <div class="main-content">
      <div class="row">
          <div class="col-md-10 mx-auto p-3">
              <a href="javascript:void(0)" class="btn btn-primary print__btn"><i class="fas fa-file-pdf"></i> Download report</a>
          </div>
      </div>
      <div class="section blog picklist mb-5" id="print_div">
          <div class="container-fluid mt-3 bg-white pb-5">
              <div class="row">
                  <div class="blog__posts col-md-12">
                      <div class="blog__list mt-5">
                          <div class="row">
                              <div class="col-sm-10 mx-auto col-centered">
                                  {{-- < class="single-talent mb-5" style="font-size: 1.6rem;"> --}}
                                  <div class="row">
                                      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                          {{-- <img src="{{ asset('images/flt-logo.png') }}" style="width: 25%;"> --}}
                                          <h2 class="logo-report"><b class="text-color1">Apply</b><b class="text-color2"> Tab</b></h2>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                              border="0">
                                              <tbody>
                                                  <tr class="bg__border">
                                                      <td class="pt-0 pb-2 pl-1" colspan="2">
                                                          <h3 class="mb-0">Basic Info</h3>
                                                      </td>
                                                      
                                                   </tr>
                                                   <tr>
                                                      <td class="pt-5" colspan="2">
                                                         <i class="pe-7s-ticket icon fa fa-tag"></i>
                                                         <h4>Job Title</h4>
                                                         <p>{{$job->job_title}}</p>
                                                     </td>
                                                   </tr>
                                                   <tr>
                                                      
                                                      <td>
                                                         <i class="pe-7s-date icon fa fa-user"></i>
                                                         <h4>Institute</h4>
                                                         <p>{{$job->institution_name}}</p>
                                                      </td>
                                                      <td>
                                                         <i class="pe-7s-date icon fa fa-calendar"></i>
                                                         <h4>Post Date</h4>
                                                         <p>{{$job->post_date}}</p>
                                                     </td>
                                                   </tr>
                                                  
                                                  <tr>
                                                      <td>
                                                          <i class="pe-7s-date icon fa fa-calendar"></i>
                                                          <h4>Post Date</h4>
                                                          <p>{{$job->post_date}}</p>
                                                      </td>
                                                      <td>
                                                          <i class="pe-7s-date icon fa fa-calendar"></i>
                                                          <h4>Deadline Date</h4>
                                                          <p>{{$job->app_deadline}}</p>
                                                      </td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                      
                                  </div>
                                 
                                    <div class="row mt-5">
                                       <div class="col-md-12">
                                             <h3 class="pl-1 bg__border">Additional Info</h3>
                                             <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                                border="0">
                                                <tbody>
                                                   <tr>
                                                         <td>
                                                            <i class="pe-7s-date icon fa fa-eye"></i>
                                                            <p>Total Views</p>
                                                            <h6>
                                                               3143
                                                            </h6>
                                                         </td>
                                                         <td>
                                                            <i class="pe-7s-date icon fa fa-bullseye"></i>
                                                            <p>Total Clicks</p>
                                                            <h6>
                                                               656
                                                            </h6>
                                                         </td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                       </div>
                                       <div class="col-md-12 mt-5">
                                            <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                                border="0">
                                                <thead class="b_bottom_light">
                                                    <th>
                                                        <h5>Site</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Clicks</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Views</h5>
                                                    </th>
                                                    <th>
                                                        <h5>Cost per click</h5>
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($stats as $key => $stat)
                                                        <tr>
                                                            <td class="pl-0">
                                                                <p>{{$key}}</p>
                                                            </td>
                                                            <td>
                                                                <h6>{{$stat->where('type','click')->count() ?? ''}}</h6>
                                                            </td>
                                                            
                                                            <td>
                                                                <h6>{{$stat->where('type','view')->count() ?? ''}}</h6>
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $site_budget = $job->getSiteBudget($key);
                                                                    $cost = $site_budget && $stat->where('type','click')->count() 
                                                                                ? '$'.number_format($site_budget/$stat->where('type','click')->count(), 2, '.', '')
                                                                                : ($site_budget ?? 0);
                                                                @endphp
                                                                {{$cost}}
                                                            </td>
                                                    </tr>
                                                    @endforeach
                                                   
                                                </tbody>
                                            </table>
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
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
        integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg=="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('.print__btn').click(function(){
            $('#print_div').printThis({
                importCSS: true,            // import parent page css
                importStyle: true,          // import style tags
                printContainer: true,       // print outer container/$.selector
                printDelay: 1000           
            });
        })
    })
</script>
</html>
