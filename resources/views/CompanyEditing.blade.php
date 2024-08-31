<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2>Add new type company.</h2>
<form action= "{{route("save_company")}}" method= "post">
@csrf <!-- {{ csrf_field() }} -->
    @if (!$data['company'])
        <select name="code_type_company" class="form-control form-control-lg">
            @foreach ($data['type_company'] as $item)
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
            <input type="text" class="form-control" name="name_vi" id="inputnamevi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputdescription">Description</label>
            <input type="text" class="form-control" name="description" id="inputdescription" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputdescriptionvi">Description VI</label>
            <input type="text" class="form-control" name="description_vi" id="inputdescriptionvi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
    @else
        <input type="hidden" name="isedit" value="{{$data['company']['id']}}">
        <select name="code_type_company" class="form-control form-control-lg">
            @foreach ($data['type_company'] as $item)
                <option @if ($data['company']['code_type_company'] == $item['code'])
                        selected
                        @endif
                        value="{{$item['code']}}">{{$item['name']}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="inputcode">Code</label>
            <input type="text" value="{{$data['company']['code']}}" class="form-control" name="code" id="inputcode" aria-describedby="emailHelp" placeholder="Enter code">
        </div>
        <div class="form-group">
            <label for="inputname">Name</label>
            <input type="text" value="{{$data['company']['name']}}" class="form-control" name="name" id="inputname" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputnamevi">Name VI</label>
            <input type="text" value="{{$data['company']['name_vi']}}" class="form-control" name="name_vi" id="inputnamevi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputdescription">Description</label>
            <input type="text" value="{{$data['company']['description']}}" class="form-control" name="description" id="inputdescription" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="inputdescriptionvi">Description VI</label>
            <input type="text" value="{{$data['company']['description_vi']}}" class="form-control" name="description_vi" id="inputdescriptionvi" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
    @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
