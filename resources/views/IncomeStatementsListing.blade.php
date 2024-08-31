<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2> Income Statements. </h2>
<a class="btn btn-primary mb-1" href="add_income_statements" role="button">Add New Income Statements.</a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Name vi</th>
        <th scope="col">parent</th>
        <th scope="col">Note</th>
        <th scope="col"></th>

    </tr>
    </thead>
    <tbody>
    @foreach ($datas as $data)
        <tr>
            <th scope="row"> {{ $data['id'] }}</th>
            <td>{{ $data['name'] }}</td>
            <td>{{ $data['name_vi'] }}</td>
            <td>{{ $data['parent'] }}</td>
            <td>{{ $data['note'] }}</td>
            <td><a href="edit_income_statements/{{ $data['id'] }}">edit</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>

