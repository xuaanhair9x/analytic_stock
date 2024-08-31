window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        theme:"light2",
        animationEnabled: true,
        title:{
            text: "{{$dataView['title']}}"
        },
        axisY :{
            includeZero: false,
            title: "{{$dataView['axis_y']}}",
            suffix: "{{$dataView['suffix']}}"
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
                    @foreach($items as $item)
                        @if($item && $item->value_display)
                            { label: "{{$item->label}}", y: {{$item->value_display}} },
                        @else
                            { label: "{{$item->label}}", y: null },
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

