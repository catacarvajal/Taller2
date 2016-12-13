@extends('layouts.app')

@section('content')
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
 $(function () { 
        var data_variable1 = <?php echo $variable1; ?>;
        var data_variable2 = <?php echo $variable2; ?>;
        var data_variable3 = <?php echo $variable3; ?>;
        var data_variable4 = <?php echo $variable4; ?>;
        var data_variable5 = <?php echo $variable5; ?>;
        var data_variable6 = <?php echo $variable6; ?>;
        var data_variable7 = <?php echo $variable7; ?>;     
    var myChart = Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafico'
        },
        xAxis: {
            categories: ['Enero','Febrero','Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Novienbre','Dieciembre']
        },
        yAxis: {
            title: {
                text: 'Valor'
            }
        },
        plotOptions: {
        series: {
            events: {
                legendItemClick: function(event) {
                    var selected = this.index;
                    var allSeries = this.chart.series;
                    
                    $.each(allSeries, function(index, series) {
                        selected == index ? series.show() : series.hide();
                    });
                    
                    return false;
                }
            }
        }
    },
        series: [{
            name: 'variable1',
            data: data_variable1
        }, {
            name: 'variable2',
            data: data_variable2,
             visible: false
        },{
            name: 'variable3',
            data: data_variable3,
             visible: false
        },{
            name: 'variable4',
            data: data_variable4,
             visible: false
        },{
            name: 'variable5',
            data: data_variable5,
             visible: false
        },{
            name: 'variable6',
            data: data_variable6,
             visible: false
        },{
            name: 'variable7',
            data: data_variable7,
             visible: false
        }]
    });
});
   
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

