<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Taller </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('/datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        <link rel="stylesheet" href="http://openlayers.org/en/v3.18.2/css/ol.css" type="text/css">
        <script src="http://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
        <script src="http://openlayers.org/en/v3.18.2/build/ol.js"></script>
        <link rel="stylesheet" href="{{ asset('/ol3-layerswitcher-master/src/ol3-layerswitcher.css') }}" />
        <script src="{{ asset('/ol3-layerswitcher-master/src/ol3-layerswitcher.js') }}"></script>

        <style>
            .fullscreen:-moz-full-screen {
                height: 100%;
            }
            .fullscreen:-webkit-full-screen {
                height: 100%;
            }
            .fullscreen:-ms-fullscreen {
                height: 100%;
            }

            .fullscreen:fullscreen {
                height: 100%;
            }

            .fullscreen {
                margin-bottom: 10px;
                width: 100%;
                height: 560px;
            }

            .ol-rotate {
                top: 3em;
            }

            .map {

                width: auto;
                height: 100%;
                margin : auto auto;
            }

            .sidepanel {
                background: #ffffff;
                width: 40%;
                height: 100%;
                float: left;
            }

            .sidepanel-title {
                width: 100%;
                font-size: 3em;
                color: black;
                display: block;
                text-align: center;
            }
        </style>
        <style type='text/css'>
            .dropdown-menu {
                position: absolute;
                top: 100%;
                left: 0;
                z-index: 1000;
                display: none;
                float: left;
                min-width: 16px;
                padding: 5px 0;
                margin: 2px 0 0;
                font-size: 14px;
                text-align: left;
                list-style: none;
                background-color: transparent;
                -webkit-background-clip: padding-box;
                background-clip: padding-box;  
                -webkit-box-shadow: none;
                box-shadow: none;
            }
            .btn-circle {
                width: 30px;
                height: 30px;
                text-align: center;
                padding: 6px 0;
                font-size: 12px;
                line-height: 1.428571429;
                border-radius: 15px;
            }
            .btn-circle.btn-lg {
                width: 50px;
                height: 50px;
                padding: 10px 16px;
                font-size: 18px;
                line-height: 1.33;
                border-radius: 25px;
            }
            .btn-circle.btn-xl {
                width: 70px;
                height: 70px;
                padding: 10px 16px;
                font-size: 24px;
                line-height: 1.33;
                border-radius: 35px;
            }
            .my-legend .legend-title {
                text-align: center;
                margin-bottom: 5px;
                font-weight: bold;
                font-size: 90%;
            }
            .my-legend .legend-scale ul {
                margin: 0;
                margin-bottom: 5px;
                padding: 0;
                float: left;
                list-style: none;
            }
            .my-legend .legend-scale ul li {
                font-size: 80%;
                list-style: none;
                margin-left: 0;
                line-height: 18px;
                margin-bottom: 2px;
            }
            .my-legend ul.legend-labels li span {
                display: block;
                float: left;
                height: 16px;
                width: 30px;
                margin-right: 5px;
                margin-left: 0;
                border: 1px solid #999;
            }
            .my-legend .legend-source {
                font-size: 70%;
                color: #999;
                clear: both;
            }
            .my-legend a {
                color: #777;
            }
            .custom-input-file {
                overflow: hidden;
                position: relative;
                cursor: pointer;
            }
            .custom-input-file .input-file {
                margin: 0;
                padding: 0;
                outline: 0;
                font-size: 10000px;
                border: 10000px solid transparent;
                opacity: 0;
                filter: alpha(opacity=0);
                position: absolute;
                right: -1000px;
                top: -1000px;
                cursor: pointer;
            }
        </style>
    </head>
    <body class="skin-blue">
        <div>
            <div>
                 @include('includes.header')  
                <section id="content_id">
                    <div class="content" >
                      <!-- Content Header (Page header) -->
                    <section class="content-header">
                      <div class="box-body no-padding">
                        <div class="box box-info color-palette-box">
                          <div class="box-header with-border">
                            <h3 class="box-title">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> Importación
                            </h3>
                          </div>
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-12 ">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="box box-success">   
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Datos de: </h3>
                                      </div> 
                                      <div class="box-body">
                                      <table class="table table-bordered" id="tabla">
                                        <tr>
                                          <th>{{$datos['data0']['latitud']}}</th>
                                          <th>{{$datos['data0']['longitud']}}</th>
                                          <th>{{$datos['data0']['comuna']}}</th>
                                          <th width="5%" class="no-sort"><center>Ver</center></th>
                                        </tr>
                                         @for ($i = 1; $i < count($datos)-1; $i++)
                                          <tr>
                                            <td>{{$datos['data'.$i]['latitud']}}</td>
                                            <td><span class="badge bg-blue">{{$datos['data'.$i]['longitud']}}</td>
                                            <td><span class="badge bg-red">{{$datos['data'.$i]['comuna']}}</span></td>
                                            <td align="center">
                                                <a href="" class="btn btn-info btn-xs btn-flat" data-toggle="tooltip" title="Detalle"><i class="fa fa-eye"></i></a>
                                            </td>
                                          </tr>
                                          @endfor
                                      </table>
                                      </div><!-- /.box-body -->
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><!-- /.box-body -->
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-12 ">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="box box-success">   
                                          <div class="box-header with-border">
                                            <h3 class="box-title">Visualización: </h3>
                                          </div> 
                                          <div class="box-body">
                                            
                                          </div><!-- /.box-body -->
                                        </div>
                                      </div>
                                    </div>
                              </div>
                            </div>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                      </div>
                    </section>
                  </div>
                </section>
            </div>
        </div>

        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/dist/js/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/plugins/chartjs/Chart.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/dist/js/pages/dashboard2.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/dist/js/demo.js') }}" type="text/javascript"></script>
    </body>
</html>
