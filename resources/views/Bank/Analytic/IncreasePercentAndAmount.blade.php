<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                title:{
                    text: "{{$dataView['title']}}"
                },
                axisY: {
                    title: "Amount",
                    lineColor: "#4F81BC",
                    tickColor: "#4F81BC",
                    labelFontColor: "#4F81BC"
                },
                axisY2: {
                    title: "Percent",
                    suffix: "%",
                    lineColor: "#C0504E",
                    tickColor: "#C0504E",
                    labelFontColor: "#C0504E"
                },
                data: [{
                    type: "column",
                    dataPoints: [
                        @foreach($dataView['data'] as $data)
                            { label: "{{$data->label}}", y: {{$data->amount}} , percent: {{$data->increase_value}} },
                        @endforeach
                    ]
                }]
            });
            chart.render();
            createPareto();

            function createPareto(){
                var dps = [];
                var yValue, yTotal = 0, yPercent = 0;

                for(var i = 0; i < chart.data[0].dataPoints.length; i++)
                {
                    if(yTotal < chart.data[0].dataPoints[i].y)
                    {
                        yTotal = chart.data[0].dataPoints[i].y;
                    }
                }
                yTotal = yTotal*120/100;
                for(var i = 0; i < chart.data[0].dataPoints.length; i++){
                    yPercent = chart.data[0].dataPoints[i].percent;
                    dps.push({label: chart.data[0].dataPoints[i].label, y: chart.data[0].dataPoints[i].percent});
                }

                chart.addTo("data",{type:"line", yValueFormatString: "0.##'%'", dataPoints: dps});
                chart.data[1].set("axisYType", "secondary", false);
                chart.axisY[0].set("maximum", yTotal);
                chart.axisY2[0].set("maximum", 100);
            }

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="{{ URL::asset('js/canvasjs.min.js') }}"></script>
</body>
</html>
