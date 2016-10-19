@extends('layouts.app')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><strong>Mapa</strong></h3>
        <a href="Grafico" class="pull-right glyphicon glyphicon-stats" data-toggle="tooltip" title="Solo graficos"></a>
        <a href="/" class="pull-right glyphicon glyphicon-map-marker" data-toggle="tooltip" title="Solo Mapa"></a>
        <a href="MapaYGrafico" class="pull-right glyphicon glyphicon-retweet" data-toggle="tooltip" title="Mapa y graficos"></a>
    </div>
    <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-12 ">
                <div class="pad">
                    <div id="toolbar" style="display: none;">
                    </div>
                    <div class="col-md-12">
                        <div id="map" class="map"></div>                                        
                    </div>
                </div>
            </div>
        </div>                            
    </div>
</div>
@endsection