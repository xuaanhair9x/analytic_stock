<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "{{$dataView['title']}}"
                },
                subtitles: [{
                    text: "{{$dataView['sub_title']}}",
                    fontSize: 16
                }],
                axisY: {
                    prefix: ""
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.00",
                    dataPoints: [
                        @foreach($dataView['data'] as $data)
                            { label: "{{$data->label}}", y: {{$data->value_display}} },
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
