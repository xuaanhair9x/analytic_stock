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
