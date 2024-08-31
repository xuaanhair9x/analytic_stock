<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme:"light2",
                animationEnabled: true,
                title:{
                    text: "{{ $dataView['title'] }}"
                },
                axisY :{
                    includeZero: false,
                    title: "Ratio",
                    suffix: "%"
                },
                toolTip: {
                    shared: "true"
                },
                legend:{
                    cursor:"pointer",
                    itemclick : toggleDataSeries
                },
                data: [
                        @foreach($dataView['data'] as $key => $items)
                    {
                        type: "spline",
                        visible: true,
                        showInLegend: true,
                        yValueFormatString: "##.00",
                        name: "{{ $key }}",
                        dataPoints: [
                                @foreach($items as $year => $item)
                                @if($item && $item->ratio)
                            { label: "{{$year}}", y: {{$item->ratio}} },
                                @else
                            { label: "{{$year}}", y: null },
                            @endif
                            @endforeach
                        ]
                    },
                    @endforeach
                ],
            });
            chart.render();

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="{{ URL::asset('js/canvasjs.min.js') }}"></script>
</body>
</html>
