<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title:{
                    text: "{{$dataView['title']}}"
                },
                axisY: {
                    title: "Đơn vị triệu đồng"
                },
                data: [{
                    type: "column",
                    showInLegend: true,
                    legendMarkerColor: "grey",
                    legendText: "{{$dataView['legendText']}}",
                    dataPoints: [
                        @foreach($dataView['data'] as $item)
                        { y: {{$item->value}}, label: {{$item->year}} },
                        @endforeach
                    ]
                }]
            });
            chart.render();

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="{{ URL::asset('js/canvasjs.min.js') }}"></script>
</body>
</html>
