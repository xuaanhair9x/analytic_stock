<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title:{
                    text: "Composition of Internet Traffic in North America"
                },
                axisX: {
                    interval: 1,
                    intervalType: "year",
                    valueFormatString: "YYYY"
                },
                axisY: {
                    suffix: "%"
                },
                toolTip: {
                    shared: true
                },
                legend: {
                    reversed: true,
                    verticalAlign: "center",
                    horizontalAlign: "right"
                },
                data: [
                    @foreach ($dataView as $key => $data)
                    {
                        type: "stackedColumn100",
                        name: "{{$data['label']}}",
                        showInLegend: true,
                        xValueFormatString: "YYYY",
                        yValueFormatString: "#,##0'%'",
                        dataPoints: [
                            @foreach($data['info_year'] as $year)
                                { x: new Date({{$year->year}},0), y: {{ $year->percen }} },
                            @endforeach
                        ]
                    },
                    @endforeach
                   ]});
            chart.render();

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="{{ URL::asset('js/canvasjs.min.js') }}"></script>
</body>
</html>
