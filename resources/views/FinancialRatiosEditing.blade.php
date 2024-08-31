<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2>Add new finance ratios.</h2>
<form action= "{{route("addingfinanceratios")}}" method= "post">
@csrf <!-- {{ csrf_field() }} -->
    @if (!$data['financeratios'])
        <select name="code_type_company" class="form-control form-control-lg">
            @foreach ($data['company'] as $item)
                <option value="{{$item['code']}}">{{$item['name']}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="inputcode">Code</label>
            <input type="text" class="form-control" name="code" id="inputcode" aria-describedby="emailHelp" placeholder="Enter code">
        </div>
        <div class="form-group">
            <label for="inputname">Name</label>
            <input type="text" class="form-control" name="name" id="inputname" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputnamevi">Name VI</label>
            <input type="text" class="form-control" name="namevi" id="inputnamevi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputnote">Note</label>
            <input type="text" class="form-control" name="note" id="inputnote" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
    @else
        <input type="hidden" name="isedit" value="{{$data['id']}}">
        <div class="form-group">
            <label for="inputcode">Code</label>
            <input type="text" value="{{$data['code']}}" class="form-control" name="code" id="inputcode" aria-describedby="emailHelp" placeholder="Enter code">
        </div>
        <div class="form-group">
            <label for="inputname">Name</label>
            <input type="text" value="{{$data['name']}}" class="form-control" name="name" id="inputname" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputnamevi">Name VI</label>
            <input type="text" value="{{$data['name_vi']}}" class="form-control" name="namevi" id="inputnamevi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputdescription">Description</label>
            <input type="text" value="{{$data['description']}}" class="form-control" name="description" id="inputdescription" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputdescriptionvi">Description VI</label>
            <input type="text" value="{{$data['description_vi']}}" class="form-control" name="descriptionvi" id="inputdescriptionvi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
    @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
