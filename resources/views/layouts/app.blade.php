<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Taller </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->

	<style type='text/css'>
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

    .map:-moz-full-screen {
    height: 100%;
    }
    .map:-webkit-full-screen {
      height: 100%;
    }
    .map:-ms-fullscreen {
      height: 100%;
    }
    .map:fullscreen {
      height: 100%;
    }
    .ol-rotate {
      top: 3em;
    }
  </style>

  <style>
    .ol-popup {
      position: absolute;
      background-color: white;
      -webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
      filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
      padding: 15px;
      border-radius: 10px;
      border: 1px solid #cccccc;
      bottom: 12px;
      left: -50px;
    }
    .ol-popup:after, .ol-popup:before {
      top: 100%;
      border: solid transparent;
      content: " ";
      height: 0;
      width: 0;
      position: absolute;
      pointer-events: none;
    }
    .ol-popup:after {
      border-top-color: white;
      border-width: 10px;
      left: 48px;
      margin-left: -10px;
    }
    .ol-popup:before {
      border-top-color: #cccccc;
      border-width: 11px;
      left: 48px;
      margin-left: -11px;
    }
    .ol-popup-closer {
      text-decoration: none;
      position: absolute;
      top: 2px;
      right: 8px;
    }
    .ol-popup-closer:after {
      content: "✖";
    }

  </style>
</head>
<body class="skin-blue">
    <div class="wrapper">
        	@include('includes.header')    
            @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
            	@yield('content')
                
			</section>
		</div>
<!-- Control Sidebar -->
<aside id="aside" class="control-sidebar control-sidebar-light hidden" style="border-left-width: 0px;">
    <div class="tab-content">
        <div class="row">
            <div class="col-xs-6">
                <h3 class="control-sidebar-heading pm-0">Opciones</h3> 
            </div>
            <div class="col-xs-6">
                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat pull-right btn-xs"><i class="fa fa-sign-out"></i><span> Cerrar sesión</span></a>
            </div>
        </div>
    </div>
</aside>
<div class="control-sidebar-bg"></div>

</div><!-- ./wrapper -->

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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<script type="text/javascript">
$("#datepicker").datepicker( {
    format: " yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
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
var categorias = new ol.layer.Group({
    title: 'Categorias',
    layers: [
    new ol.layer.Image({
        title: 'Estaciones',
        visible: false,
        source: new ol.source.ImageWMS({
            ratio: 1,
            url: 'http://tomcat7.curi.co.uk:80/geoserver/gis4/wms',
            params: {'FORMAT': 'image/png',
            'VERSION': '1.1.1',  
            LAYERS: 'gis4:gis4',
            STYLES: '',
        },
        serverType: 'geoserver'
    })
    }),   
    new ol.layer.Tile({    
        title: 'Centrales ',
        visible: false,
        source: new ol.source.TileWMS({
            url: 'http://sig.minenergia.cl/geoserver/men/wms',
            params: {"LAYERS": 'men:Proyectos_SEA'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Tile({    
        title: 'Biomasa',
        visible: false,
        source: new ol.source.TileWMS({
            url: 'http://sig.minenergia.cl/geoserver/men/wms',
            params: {"LAYERS": 'men:biomasa_1d78990f_2d5a_4506_befa_04a30c925640'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Tile({    
        title: 'Solares',
        visible: false,
        source: new ol.source.TileWMS({
            url: 'http://sig.minenergia.cl/geoserver/men/wms',
            params: {"LAYERS": 'men:solares_fd0779de_0870_4194_b962_83a842d8c316'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Tile({    
        title: 'Lluvias',
        visible: false,
        source: new ol.source.TileWMS({
            url: 'http://demo.opengeo.org/geoserver/wms',
            params: {'LAYERS': 'ne:ne_10m_admin_1_states_provinces_lines_shp'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Tile({
        title: 'Temperatura Máxima',
        visible: false,
        source: new ol.source.TileWMS({
            url: 'http://demo.opengeo.org/geoserver/wms',
            params: {'LAYERS': 'ne:ne_10m_admin_1_states_provinces_lines_shp'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Tile({
        title: 'Temperatura Mínima',
        visible: false,
        source: new ol.source.TileWMS({
            url: 'http://demo.opengeo.org/geoserver/wms',
            params: {'LAYERS': 'ne:ne_10m_admin_1_states_provinces_lines_shp'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Tile({
        title: 'UV',
        visible: false,
        source: new ol.source.TileWMS({
            url: 'http://demo.opengeo.org/geoserver/wms',
            params: {'LAYERS': 'ne:ne_10m_admin_1_states_provinces_lines_shp'},
            serverType: 'geoserver'
        })
    })

    ]
});

var map = new ol.Map({
    layers: 
    [ mapas,categorias,vector],  
    target: 'map',
    view: new ol.View({
        center: ol.proj.transform([-72, -38], 'EPSG:4326', 'EPSG:3857'),
        zoom:4
    })
});
 map.addControl(new ol.control.FullScreen());
 map.addControl(new ol.control.OverviewMap({}));

var typeSelect = document.getElementById('type');

var draw; 
function addInteraction() {
    var value = typeSelect.value;
    if (value !== 'None') {
        var geometryFunction, maxPoints;
        if (value === 'Square') {
            value = 'Circle';
            geometryFunction = ol.interaction.Draw.createRegularPolygon(4);
        } 
        else if (value === 'Box') {
            value = 'LineString';
            maxPoints = 2;
            geometryFunction = function(coordinates, geometry) {
                if (!geometry) {
                    geometry = new ol.geom.Polygon(null);
                }
                var start = coordinates[0];
                var end = coordinates[1];
                geometry.setCoordinates([
                    [start, [start[0], end[1]], end, [end[0], start[1]], start]
                    ]);
                return geometry;
            };
        }
        draw = new ol.interaction.Draw({
            source: source,
            type: /** @type {ol.geom.GeometryType} */ (value),
            geometryFunction: geometryFunction,
            maxPoints: maxPoints
        });
        map.addInteraction(draw);
    }
}
var layerSwitcher = new ol.control.LayerSwitcher({
    tipLabel: 'Leyenda'
});
map.addControl(layerSwitcher);
layerSwitcher.showPanel();

typeSelect.onchange = function() {
    map.removeInteraction(draw);
    addInteraction();
};

addInteraction();
</script>


</body>
</html>