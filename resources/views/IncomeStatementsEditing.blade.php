<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2>Add new info.</h2>
<form action= "{{route("save_data_income_statements")}}" method= "post">
@csrf <!-- {{ csrf_field() }} -->
    @if (!$data['data_edit'])
        <select name="parent" class="mb-3 form-control form-control-lg">
            @foreach ($data['parent'] as $item)
                <option value="0">No parent</option>
                <option value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
        </select>
        <div class="form-group mb-3">
            <label for="inputname">Name</label>
            <input type="text" class="form-control" name="name" id="inputname" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group mb-3">
            <label for="inputnamevi">Name VI</label>
            <input type="text" class="form-control" name="name_vi" id="inputnamevi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group mb-3">
            <label for="inputdescription">Note</label>
            <input type="text" class="form-control" name="note" id="inputdescription" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
    @else
        <input type="hidden" name="isedit" value="{{$data['data_edit']['id']}}">
        <div class="form-group mb-3">
            <label for="inputname">Name</label>
            <input type="text" value="{{$data['data_edit']['name']}}" class="form-control" name="name" id="inputname" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group mb-3">
            <label for="inputnamevi">Name VI</label>
            <input type="text" value="{{$data['data_edit']['name_vi']}}" class="form-control" name="name_vi" id="inputnamevi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group mb-3">
            <label for="inputdescription">Description</label>
            <input type="text" value="{{$data['data_edit']['note']}}" class="form-control" name="note" id="inputdescription" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
    @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
