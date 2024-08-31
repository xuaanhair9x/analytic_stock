<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<form action= "{{route($dataView->action_form)}}" method= "post">
@csrf <!-- {{ csrf_field() }} -->
    @if($dataView->editable)
        <input type="hidden" name="parent_report_norm_id" value="{{$dataView->parent_report_norm_id}}">
        <input type="hidden" name="report_norm_id" value="{{$dataView->report_norm_id}}">
        <input type="hidden" name="indicator_id" value="{{$dataView->id}}">
        <div class="form-group">
            <label for="inputAddress">Name Indicator</label>
            <input type="text" name="name" class="form-control" value="{{$dataView->name}}" required id="inputAddress" placeholder="{{$dataView->name}}">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Name Indicator En</label>
            <input type="text" name="name_en" value="{{$dataView->name_en}}" class="form-control" required id="inputAddress2" placeholder="{{$dataView->name_en}}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Index</label>
                <input type="text" class="form-control" id="index" value="{{$dataView->index}}" name="index">
            </div>
        </div>
        <div class="form-group">
            <label for="inputNode">Note</label>
            <textarea type="text" name="note" class="form-control" id="inputNode">{{$dataView->note}}</textarea>
        </div>
    @else
        <input type="hidden" name="parent_report_norm_id" value="{{$dataView->report_norm_id}}">
        <input type="hidden" name="indicator_id" value="0">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Parent Indicator</label>
                <input type="text" name="name_parent" class="form-control" id="inputEmail4" placeholder="Email" value="{{$dataView->name}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Parent Indicator En</label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="Password" value="{{$dataView->name_en}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Name Indicator</label>
            <input type="text" name="name" class="form-control" required id="inputAddress" placeholder="{{$dataView->name}}">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Name Indicator En</label>
            <input type="text" name="name_en"class="form-control" required id="inputAddress2" placeholder="{{$dataView->name_en}}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Index</label>
                <input type="text" class="form-control" id="index" name="index">
            </div>
        </div>
        <div class="form-group">
            <label for="inputNode">Note</label>
            <textarea type="text" name="note" class="form-control" id="inputNode"></textarea>
        </div>
    @endif
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>
