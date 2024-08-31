<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2>Add new info.</h2>
<form class="w-50" action= "{{route("save_data_income_statements_info_year")}}" method= "post">
@csrf <!-- {{ csrf_field() }} -->
    @if (!$data['data_edit'])
        <select name="company_code" class="mb-3 form-control form-control-lg">
            @foreach ($data['company'] as $item)
                <option value="{{$item['code']}}">{{$item['name']}}</option>
            @endforeach
        </select>
        <select name="income_statement_id" class="mb-3 form-control form-control-lg">
            @foreach ($data['income_statement'] as $item)
                <option value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
        </select>
        <select name="year" class="mb-3 form-control form-control-lg">
            @foreach ($data['year'] as $item)
                <option value="{{$item}}">{{$item}}</option>
            @endforeach
        </select>
        <div class="mb-3 form-group">
            <input type="text" class="form-control" name="amount" id="inputname" aria-describedby="emailHelp" placeholder="Enter Amount">
        </div>
    @else
        <input type="hidden" name="isedit" value="{{$data['data_edit']['id']}}">
        <select name="company_code" class="mb-3 form-control form-control-lg">
            @foreach ($data['company'] as $item)
                <option @if ($data['data_edit']['company_code'] == $item['code'])
                            selected
                        @endif
                        value="{{$item['code']}}">{{$item['name']}}</option>
            @endforeach
        </select>
        <select name="income_statement_id" class="mb-3 form-control form-control-lg">
            @foreach ($data['income_statement'] as $item)
                <option @if ($data['data_edit']['income_statement_id'] == $item['id'])
                            selected
                        @endif
                        value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
        </select>
        <select name="year" class="mb-3 form-control form-control-lg">
            @foreach ($data['year'] as $item)
                <option @if ($data['data_edit']['year'] == $item)
                        selected
                        @endif
                        value="{{$item}}">{{$item}}</option>
            @endforeach
        </select>
        <div class="mb-3 form-group">
            <input value="{{$data['data_edit']['amount']}}" type="text" class="form-control" name="amount" id="inputname" aria-describedby="emailHelp" placeholder="Enter Amount">
        </div>
    @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
