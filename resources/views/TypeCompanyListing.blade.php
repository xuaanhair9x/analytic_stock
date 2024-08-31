<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2> List type company. </h2>
<a class="btn btn-primary mb-1" href="addtypecompany" role="button">Add new type company</a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Code</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col"></th>

    </tr>
    </thead>
    <tbody>
    @foreach ($datas as $data)
        <tr>
            <th scope="row"> {{ $data['id'] }}</th>
            <td>{{ $data['code'] }}</td>
            <td>{{ $data['name'] }}</td>
            <td>{{ $data['description'] }}</td>
            <td><a href="edittypecompany/{{ $data['id'] }}">edit</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>

