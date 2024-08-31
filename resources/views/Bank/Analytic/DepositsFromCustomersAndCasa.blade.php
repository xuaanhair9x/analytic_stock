<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function() {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

// Add data
        chart.data = [
        @foreach($dataView['data'] as $year => $data)
            {
                "country": "{{$year}}",
                "visits": {{$data->deposit_customer}},
                "casa": {{$data->percent_casa}}
            },
        @endforeach
            ];
// Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 60;
        categoryAxis.tooltip.disabled = true;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;
        valueAxis.min = 0;
        valueAxis.cursorTooltipEnabled = false;

// Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function(fill, target) {
            return chart.colors.getIndex(target.dataItem.index);
        })


        var casaValueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        casaValueAxis.renderer.opposite = true;
        casaValueAxis.min = 0;
        casaValueAxis.max = 100;
        casaValueAxis.strictMinMax = true;
        casaValueAxis.renderer.grid.template.disabled = true;
        casaValueAxis.numberFormatter = new am4core.NumberFormatter();
        casaValueAxis.numberFormatter.numberFormat = "#'%'"
        casaValueAxis.cursorTooltipEnabled = false;

        var casaSeries = chart.series.push(new am4charts.LineSeries())
        casaSeries.dataFields.valueY = "casa";
        casaSeries.dataFields.categoryX = "country";
        casaSeries.yAxis = casaValueAxis;
        casaSeries.tooltipText = "casa: {valueY.formatNumber('#.0')}%[/]";
        casaSeries.bullets.push(new am4charts.CircleBullet());
        casaSeries.strokeWidth = 2;
        casaSeries.stroke = new am4core.InterfaceColorSet().getFor("alternativeBackground");
        casaSeries.strokeOpacity = 0.5;


// Cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "panX";

    }); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>
