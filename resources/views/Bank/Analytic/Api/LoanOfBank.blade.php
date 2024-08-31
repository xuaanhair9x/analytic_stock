window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {
animationEnabled: true,
theme: "light2", //"light1", "dark1", "dark2"
title: {
text: "{{ $dataView['title'] }}"
},
axisY: {
interval: 10,
suffix: "%"
},
toolTip: {
shared: true
},
data: [
@foreach ($dataView['data'] as $key => $data)
    {
    type: "stackedBar100",
    toolTipContent: "<b>{name}:</b> {y} (#percent%)",
    showInLegend: true,
    name: "{{$data['label']}}",
    dataPoints: [
    @foreach($data['info_year'] as $item)
        {
        y: {{ $item->value }}, label: "{{  $item->label }}"
        },
    @endforeach]
    },
@endforeach
],
});
chart.render();

}
