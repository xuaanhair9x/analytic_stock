<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2> Income Statements. </h2>
<a class="btn btn-primary mb-1" href="add_income_statements_info_year" role="button">Add New Income Statements.</a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Company</th>
        <th scope="col">Income statement</th>
        <th scope="col">Year</th>
        <th scope="col">Amount</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($datas as $data)
        <tr>
            <td>{{ $data->company }}</td>
            <td>{{ $data->income_statement }}</td>
            <td>{{ $data->year }}</td>
            <td>{{ $data->amount }}</td>
            <td><a href="edit_income_statements_info_year/{{ $data->id }}">edit</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>

