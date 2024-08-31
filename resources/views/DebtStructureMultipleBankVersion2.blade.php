<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", //"light1", "dark1", "dark2"
                title:{
                    text: "{{ $dataView['title'] }}"
                },
                axisY:{
                    interval: 10,
                    suffix: "%"
                },
                toolTip:{
                    shared: true
                },
                data:[
                    @foreach ($dataView['data'] as $key => $data)
                    {
                        type: "stackedBar100",
                        toolTipContent: "<b>{name}:</b> {y} (#percent%)",
                        showInLegend: true,
                        name: "{{$data['label']}}",
                        dataPoints: [
                                @foreach($data['info_year'] as $year)
                                    { y: {{ $year->value }}, label: "{{  $year->year }}" },
                                @endforeach]
                    },
                    @endforeach
                ],
            });
            chart.render();

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 570px; max-width: 1320px; margin: 0px auto;"></div>
<script src="{{ URL::asset('js/canvasjs.min.js') }}"></script>
</body>
</html>
