<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                [
                    @foreach($dataView['main_label'] as $label)
                        '{{$label}}',
                    @endforeach
                ],
                    @foreach($dataView['data'] as $data)
                ['{{$data->label}}',{{$data->amount_one}},{{$data->amount_two}},{{$data->amount_three}}],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: '{{$dataView['title']}}',
                    subtitle: '{{$dataView['sub_title']}}',
                },
                bars: 'vertical',
                vAxis: {format: 'decimal'},
            };

            var chart = new google.charts.Bar(document.getElementById('chartContainer'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</head>
<body>
<div id="chartContainer" style="width: 800px; height: 500px;"></div>
</body>
</html>
