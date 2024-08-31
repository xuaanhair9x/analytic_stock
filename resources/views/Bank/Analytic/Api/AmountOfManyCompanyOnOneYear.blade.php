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
