<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
            @include('includes.header')    
            <div>
                <section id="content_id">
                    @yield('content')
                </section>
            </div>
            @include('includes.sidebarrigth')
            <div class="control-sidebar-bg"></div> 
            
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
    

       
        
     <!--     <script type="text/javascript" src="http://cdn.immex1.com/js/jspdf/plugins/jspdf.plugin.from_html.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script> -->
     
       
        <script type="text/javascript">

    $(document).ready(function () {
        $('[data-toggle="control-sidebar"]').tooltip();
        ocultar();
    });
    $(document).ready(function () {
        $('[data-toggle="control-dibujo"]').tooltip();
    });
    function mostrar(id_side) {
        if (id_side == 'side_ir_a') {
            document.getElementById('side_visualizar').style.display = 'none';
            document.getElementById('side_descargar').style.display = 'none';
            document.getElementById('side_capa').style.display = 'none';
        }

        if (id_side == 'side_descargar') {
            document.getElementById('side_ir_a').style.display = 'none';
            document.getElementById('side_visualizar').style.display = 'none';
            document.getElementById('side_capa').style.display = 'none';
        }
        if (id_side == 'side_visualizar') {
            document.getElementById('side_ir_a').style.display = 'none';
            document.getElementById('side_descargar').style.display = 'none';
            document.getElementById('side_capa').style.display = 'none';
        }
        if (id_side == 'side_capa') {
            document.getElementById('side_ir_a').style.display = 'none';
            document.getElementById('side_descargar').style.display = 'none';
            document.getElementById('side_visualizar').style.display = 'none';
        }


        document.getElementById(id_side).style.display = 'block';
    }

    function ocultar() {
        document.getElementById('side_ir_a').style.display = 'none';
        document.getElementById('side_descargar').style.display = 'none';
        document.getElementById('side_visualizar').style.display = 'none';
    }
        </script>
        <script>

            var source = new ol.source.Vector({wrapX: false});

            var vector = new ol.layer.Vector({
                source: source,
                style: new ol.style.Style({
                    fill: new ol.style.Fill({
                        color: 'rgba(255, 255, 255, 0.2)'
                    }),
                    stroke: new ol.style.Stroke({
                        color: '#ffcc33',
                        width: 2
                    }),
                    image: new ol.style.Circle({
                        radius: 7,
                        fill: new ol.style.Fill({
                            color: '#ffcc33'
                        })
                    })
                })
            });

            function cambiarRaster()
            {
                if(document.getElementById('Var').value == 1) 
                {
                    raster.U.layers.a[0].U.visible = true;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 2) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = true;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;;
                }
                else if(document.getElementById('Var').value == 3) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = true;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 4) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = true;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 5) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = true;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 6) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = true;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 7) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = true;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 8) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = true;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 9) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = true;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 10) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = true;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 11) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = true;
                    raster.U.layers.a[11].U.visible = false;
                }
                else if(document.getElementById('Var').value == 12) 
                {
                    raster.U.layers.a[0].U.visible = false;
                    raster.U.layers.a[1].U.visible = false;
                    raster.U.layers.a[2].U.visible = false;
                    raster.U.layers.a[3].U.visible = false;
                    raster.U.layers.a[4].U.visible = false;
                    raster.U.layers.a[5].U.visible = false;
                    raster.U.layers.a[6].U.visible = false;
                    raster.U.layers.a[7].U.visible = false;
                    raster.U.layers.a[8].U.visible = false;
                    raster.U.layers.a[9].U.visible = false;
                    raster.U.layers.a[10].U.visible = false;
                    raster.U.layers.a[11].U.visible = true;
                }
                map.updateSize();
            }

            var mapas = new ol.layer.Group({
                title: 'Mapas',
                layers: [new ol.layer.Tile({
                        title: 'Toner',
                        type: 'base',
                        visible: false,
                        source: new ol.source.Stamen({
                            layer: 'toner'
                        })
                    }),
                    new ol.layer.Tile({
                        title: 'Water color',
                        type: 'base',
                        visible: false,
                        source: new ol.source.Stamen({
                            layer: 'watercolor'
                        })
                    }),
                    new ol.layer.Tile({
                        title: 'DigitalGlobe Maps API: Recent Imagery',
                        type: 'base',
                        visible: false,
                        source: new ol.source.XYZ({
                            url: 'http://api.tiles.mapbox.com/v4/digitalglobe.nal0g75k/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZGlnaXRhbGdsb2JlIiwiYSI6ImNpcGg5dHkzYTAxM290bG1kemJraHU5bmoifQ.CHhq1DFgZPSQQC-DYWpzaQ', // You will need to replace the 'access_token' and 'Map ID' values with your own. http://developer.digitalglobe.com/docs/maps-api
                            attribution: "© DigitalGlobe, Inc"
                        })
                    }),
                    new ol.layer.Tile({
                        title: 'OSM',
                        type: 'base',
                        visible: true,
                        source: new ol.source.OSM()
                    }),
                ]
            });

            var raster = new ol.layer.Group({
                title: 'Categorias',
                layers: [
                new ol.layer.Image({
                    title: 'Tmin1',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_1_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),

                new ol.layer.Image({
                    title: 'Tmin2',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_2_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin3',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_3_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin4',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_4_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin5',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_5_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin6',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_6_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin7',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_7_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin8',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_8_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin9',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_9_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin10',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_10_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin11',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_11_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                new ol.layer.Image({
                    title: 'Tmin12',
                    visible: false,
                    source: new ol.source.ImageWMS({
                        ratio: 1,
                        url: 'http://tomcat7.curi.co.uk:80/geoserver/taller2/wms',
                        params: {'FORMAT': 'image/png',
                        'VERSION': '1.1.1',  
                        LAYERS: 'taller2:tmin_12_Baseline',
                        STYLES: '',
                    },
                    serverType: 'geoserver'
                })
                }),
                ]
            });

            var map = new ol.Map({
                controls: ol.control.defaults().extend([
                    new ol.control.FullScreen({
                        source: 'fullscreen'
                    })
                ]),
                layers:
                        [mapas, raster, vector],
                target: 'map',
                view: new ol.View({
                    center: ol.proj.transform([-71.671667, -35.426667], 'EPSG:4326', 'EPSG:3857'),
                    zoom: 7.5
                })
            });

            map.addControl(new ol.control.OverviewMap({}));

            var typeSelect = document.getElementById('type');

            var draw;
            var geojson;
            function addInteraction() {                
                var value = typeSelect.value;               
                if (value !== 'None') {  
                    var value2 = value;
                    var geometryFunction, maxPoints;
                    if (value === 'Square') {

                        value = 'Circle';
                        geometryFunction = ol.interaction.Draw.createRegularPolygon(4);
                    }
                    draw = new ol.interaction.Draw({
                        source: source,
                        type: /** @type {ol.geom.GeometryType} */ (value),
                        geometryFunction: geometryFunction,
                        maxPoints: maxPoints
                    });
                    draw.on("drawend", function (e) {


                        if (value2 == 'Circle') {
                            var feature = e.feature;
                            var featureClone = feature.clone();                            
                            var circle = featureClone.getGeometry().transform('EPSG:3857', 'EPSG:4326')
                            var radio = circle.getRadius();
                            var centro = circle.getCenter();   
                            var geoj = {
                                "type": "Feature",
                                "geometry": {
                                    "type": "Circle",
                                    "coordinates": [centro],
                                    "radius": radio
                                },
                                "properties": {
                                    "name": "null"
                                }
                            }
                            geojson = JSON.stringify(geoj);  //trasforma a json            
                           removeDraw();
                        }

                        else {
                            var feature = e.feature;
                            var featureClone = feature.clone();
                            var formatGeoJSON = new ol.format.GeoJSON();
                            featureClone.getGeometry().transform('EPSG:3857', 'EPSG:4326');
                            geojson = formatGeoJSON.writeFeature(featureClone);
                            removeDraw();
                        }
                    });
                    removeDraw();
                    map.addInteraction(draw);
                }
            }
            function ajaxButton() {
                $(typeSelect).val('None').trigger("change"); //cambia seleccion para dibujar 
                document.getElementById('inicio').style.display = 'none';
                document.getElementById('grafico_tabla').style.display = 'block';
                
                ajax(geojson);
            }
            function ajax(geojson) {
                console.log(geojson);
                var periodo = $("#Periodo").val();
                var variable = $("#Variable").val();
                var escenario = $("#Escenario").val();
                var tablaDatos = $("#datos");

                $.ajax({
                    type: 'post',
                    url: 'ajax',
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({'periodo': periodo, 'variable': variable, 'escenario': escenario, 'geoj': JSON.parse(geojson)}),
                    success: function (data) {
                        hayDatos = true;
                        for (var i = 0; i < data.rows.length; i++) 
                        {
                            if(data.rows[i].c[1].v == null)
                            {
                                hayDatos = false;
                            }
                        }
                        if(!hayDatos)
                        {
                            $('#modal-error').modal('show');
                            lava.loadData('grafico', data);
                            $("#datos").empty();                            
                        }
                        else
                        {
                            lava.loadData('grafico', data);
                            $("#datos").empty();
                            for (var i = 0; i < data.rows.length; i++) {
                            tablaDatos.append("<tr><td>" + data.rows[i].c[0].v + "</td><td><span class='badge bg-red'>" + data.rows[i].c[1].v + "</span></td></tr>");
                            }
                        }                                            
                    }
                });
            }
            function removeDraw(){

                  source.clear();

            }
         

            typeSelect.onchange = function () {
                map.removeInteraction(draw);
                addInteraction();
            };

            addInteraction();
        </script>
        <script type="text/javascript">

            $(document).ready(function () {
                $('json').click(function(){
                    exportar("json");
                });
                $('xml').click(function(){
                    exportar("xml");
                });
                $('csv').click(function(){
                    exportar("csv");
                });

            });

            function exportar(formato) {
                if(formato=="xml")
                {
                    var datos = obtenerDatos();
                    descargarArchivo(generarXml(datos), 'datos.xml');
                }
                else if(formato=="csv")
                {

                    var datos = obtenerDatos();
                    descargarArchivo(generarCsv(datos), 'datos.csv');
                }
                else 
                {
                    var datos = obtenerDatos();
                    var datosJson = JSON.stringify(datos);
                    descargarArchivo(new Blob([datosJson], {type: 'application/json'}), 'datos.json');
                }
             }
             function obtenerDatos()
             {
                 
                var promediosFinal=[];
                {{$i=0}}
                for (var i = 0; i < {{count($datosTabla)}}; i++) {

                    promediosFinal.push({{ $datosTabla[$i]->promedio }});
                    {{$i++}}
                }
                if(promediosFinal.length!=12)
                {
                    for (var i = 0; i < 12; i++) {
                        promediosFinal.push(-99999);
                    }
                }
                return {    periodo: '', 
                            escenario: '',
                            variable: '',
                            promedio: {
                                enero: promediosFinal[0],
                                febrero: promediosFinal[1],
                                marzo: promediosFinal[2],
                                abril: promediosFinal[3],
                                mayo: promediosFinal[4],
                                junio: promediosFinal[5],
                                julio: promediosFinal[6],
                                agosto: promediosFinal[7],
                                septiembre: promediosFinal[8],
                                octubre: promediosFinal[9],
                                noviembre: promediosFinal[10],
                                diciembre: promediosFinal[11]
                            }
                        };
             }
             function generarXml(datos) {
                var texto = [];
                texto.push('<?xml version="1.0" encoding="UTF-8" ?>\n');
                texto.push('<datos>\n');
                texto.push('\t<periodo>');
                texto.push(escaparXML(datos.periodo));
                texto.push('</periodo>\n');
                texto.push('\t<escenario>');
                texto.push(escaparXML(datos.escenario));
                texto.push('</escenario>\n');
                texto.push('\t<variable>');
                texto.push(escaparXML(datos.variable));
                texto.push('</variable>\n');
                texto.push('\t<promedio>\n');
                texto.push('\t\t<enero>');
                texto.push(escaparXML(datos.promedio.enero+""));
                texto.push('</enero>\n');
                texto.push('\t\t<febrero>');
                texto.push(escaparXML(datos.promedio.febrero+""));
                texto.push('</febrero>\n');
                texto.push('\t\t<marzo>');
                texto.push(escaparXML(datos.promedio.marzo+""));
                texto.push('</marzo>\n');
                texto.push('\t\t<abril>');
                texto.push(escaparXML(datos.promedio.abril+""));
                texto.push('</abril>\n');
                texto.push('\t\t<mayo>');
                texto.push(escaparXML(datos.promedio.mayo+""));
                texto.push('</mayo>\n');
                texto.push('\t\t<junio>');
                texto.push(escaparXML(datos.promedio.junio+""));
                texto.push('</junio>\n');
                texto.push('\t\t<julio>');
                texto.push(escaparXML(datos.promedio.julio+""));
                texto.push('</julio>\n');
                texto.push('\t\t<agosto>');
                texto.push(escaparXML(datos.promedio.agosto+""));
                texto.push('</agosto>\n');
                texto.push('\t\t<septiembre>');
                texto.push(escaparXML(datos.promedio.septiembre+""));
                texto.push('</septiembre>\n');
                texto.push('\t\t<octubre>');
                texto.push(escaparXML(datos.promedio.octubre+""));
                texto.push('</octubre>\n');
                texto.push('\t\t<noviembre>');
                texto.push(escaparXML(datos.promedio.noviembre+""));
                texto.push('</noviembre>\n');
                texto.push('\t\t<diciembre>');
                texto.push(escaparXML(datos.promedio.diciembre+""));
                texto.push('</diciembre>\n');
                texto.push('\t</promedio>\n');
                texto.push('</datos>');
                //No olvidemos especificar el tipo MIME correcto :)
                return new Blob(texto, {
                    type: 'application/xml'
                });
            }

            function generarCsv(datos) {
                var texto = ['"periodo";"escenario";"variable";"enero";"febrero";"marzo";"abril";"mayo";"junio";"julio";"agosto";"septiembre";"octubre";"noviembre";"diciembre"',
                             ''+datos.periodo+";"+datos.escenario+";"+datos.variable+";"+datos.promedio.enero+";"+datos.promedio.febrero+";"+datos.promedio.marzo+";"+
                                datos.promedio.abril+";"+datos.promedio.mayo+";"+datos.promedio.junio+";"+datos.promedio.julio+";"+datos.promedio.agosto+";"+datos.promedio.septiembre+";"+datos.promedio.octubre+";"+datos.promedio.noviembre+";"+datos.promedio.diciembre+''
                          ].join('\n');
                //No olvidemos especificar el tipo MIME correcto :)
                return new Blob([texto], {
                    type: 'application/csv'
                });
            }
            //Función de ayuda: "escapa" las entidades XML necesarias
            //para los valores (y atributos) del archivo XML
            function escaparXML(cadena) {
                if (typeof cadena !== 'string') {
                    return '';
                };
                cadena = cadena.replace('&', '&amp;')
                    .replace('<', '&lt;')
                    .replace('>', '&gt;')
                    .replace('"', '&quot;');
                return cadena;
            };
            function descargarArchivo(contenidoEnBlob, nombreArchivo) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var save = document.createElement('a');
                    save.href = event.target.result;
                    save.target = '_blank';
                    save.download = nombreArchivo || 'archivo.dat';
                    var clicEvent = new MouseEvent('click', {
                        'view': window,
                            'bubbles': true,
                            'cancelable': true
                    });
                    save.dispatchEvent(clicEvent);
                    (window.URL || window.webkitURL).revokeObjectURL(save.href);
                };
                reader.readAsDataURL(contenidoEnBlob);
            }

         </script>
         <script type="text/javascript">
            function exportarPdf() {
                    window.print();
                    /*
                    var doc = new jsPDF();
                    
                    var specialElementHandlers = {
                        '#editor': function(element, renderer){
                            return true;
                        }
                    };

                    doc.fromHTML($("#content_id").html(), 15, 15, {
                        'width': 170,'elementHandlers': specialElementHandlers
                    });
                    doc.save('Datos.pdf');
                    */
            }
            function imprSelec()
            {
                //window.print();
                var doc = new jsPDF();
                    
                var specialElementHandlers = {
                    '#editor': function(element, renderer){
                        return true;
                    }
                };

                doc.fromHTML($('#content_id').html(), 15, 15, {
                    'width': 170,'elementHandlers': specialElementHandlers
                });
                doc.save('Datos.pdf');
            }

            var datosImportacion;
            var reader;
            function readText(filePath) {
                reader = new FileReader();
                reader.addEventListener('load',leer,false);
                var output = ""; //placeholder for text output
                if(filePath.files && filePath.files[0]) {           
                    reader.onload = function (e) {
                        output = e.target.result;
                        //displayContents(output);
                    };//end onload()
                    reader.readAsText(filePath.files[0]);
                }//end if html5 filelist support
                else if(ActiveXObject && filePath) { //fallback to IE 6-8 support via ActiveX
                    try {
                        reader = new ActiveXObject("Scripting.FileSystemObject");
                        var file = reader.OpenTextFile(filePath, 1); //ActiveX File Object
                        output = file.ReadAll(); //text contents of file
                        file.Close(); //close file "input stream"
                        //displayContents(output);
                    } catch (e) {
                        if (e.number == -2146827859) {
                            alert('Unable to access local files due to browser security settings. ' + 
                             'To overcome this, go to Tools->Internet Options->Security->Custom Level. ' + 
                             'Find the setting for "Initialize and script ActiveX controls not marked as safe" and change it to "Enable" or "Prompt"'); 
                        }
                    }       
                }
                else { //this is where you could fallback to Java Applet, Flash or similar
                    return false;
                }       
                return true;
            }   

            function leer(ev)
            {
                datosImportacion = ev.target.result.split("\r\n");
                var jsonImportacion = {};
                var arrayAuxiliar = [];
                for (var i = 0; i < datosImportacion.length ; i++) {
                    arrayAuxiliar = datosImportacion[i].split(";");
                    jsonImportacion['data'+i] = {latitud:arrayAuxiliar[0], longitud: arrayAuxiliar[1], comuna: arrayAuxiliar[2]};
                }
                var jsonFinal = {'datosImportacion':jsonImportacion};
                console.log(jsonImportacion);             

                //Post a un controller
               //window.print();
               //window.open("importacion", "MsgWindow", datosImportacion);
               /*$.post('importacion',datosImportacion,function(data,status){
                    console.log("Data: " + data + "\nStatus: " + status);
                });*/
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: 'importacion',
                    type: 'POST',
                    data: jsonFinal,
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data);
                    }
                }).fail(function (jqXHR, textStatus, error) {
                    console.log(error);
                });
            }
            function importar(ruta)
            {
                
                $.ajax({
                    type: 'post',
                    url: 'importacion',
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({'ruta':ruta}),
                    success: function (data) {
                        console.log(data);
                    }
                }).fail(function (jqXHR, textStatus, error) {
                    console.log(error);
                });
            }
         </script>
    </body>
</html>