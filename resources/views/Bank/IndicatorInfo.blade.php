<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<h3>{{ $dataView['name'] }}</h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Indicators</th>
        @foreach ($dataView['years'] as $year)
            <th>{{ $year }}</th>
        @endforeach
        <th></th>

    </tr>
    </thead>
    <tbody>
    {!! $dataView['renderData']  !!}
    </tbody>
</table>
<style>
    td.level_1 {
        padding-left: 50px;
    }
    td.level_2 {
        padding-left: 100px;
    }
    td.level_3 {
        padding-left: 150px;
    }
</style>
