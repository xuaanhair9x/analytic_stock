<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<form action= "{{route("save_indicator_info")}}" method= "post">
@csrf <!-- {{ csrf_field() }} -->
    @if($dataView['id'])
        <div class="form-row">
            <input type="hidden" name="report_norm_id" value="{{$dataView['indicator']->report_norm_id}}">
            <input type="hidden" name="income_statement_id" value="{{$dataView['indicator']->id}}">
            <input type="hidden" name="company_vs_id" value="{{$dataView['company']->company_vs_id}}">
            <input type="hidden" name="year" value="{{$dataView['indicator_info']->year}}">
            <input type="hidden" name="id" value="{{$dataView['id']}}">
            <div class="form-group col-md-6">
                <label for="indicator">Indicator</label>
                <input type="email" class="form-control" value="{{$dataView['indicator']->name}}" id="indicator" disabled>
            </div>
            <div class="form-group col-md-6">
                <label for="company">Company</label>
                <input type="text" class="form-control" value="{{$dataView['company']->getName()}}" id="company" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="company-code">Company Code</label>
                <input type="text" name="company_code" class="form-control" value="{{$dataView['company']->getCode()}}" id="company-code" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Year</label>
                <select id="inputState" required name="year" class="form-control" disabled>
                    @foreach($dataView['years'] as $year)
                        <option
                            @if($dataView['indicator_info']->year==$year)
                                selected
                            @endIf
                            name="{{$year}}">{{$year}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress">Value</label>
                <input type="text" name="value" value="{{$dataView['indicator_info']->value}}" required class="form-control" id="inputAddress" placeholder="1,222,222">
            </div>
        </div>
    @else
        <div class="form-row">
            <input type="hidden" name="report_norm_id" value="{{$dataView['indicator']->report_norm_id}}">
            <input type="hidden" name="income_statement_id" value="{{$dataView['indicator']->id}}">
            <input type="hidden" name="company_vs_id" value="{{$dataView['company']->company_vs_id}}">
            <div class="form-group col-md-6">
                <label for="indicator">Indicator</label>
                <input type="email" class="form-control" value="{{$dataView['indicator']->name}}" id="indicator" disabled>
            </div>
            <div class="form-group col-md-6">
                <label for="company">Company</label>
                <input type="text" class="form-control" value="{{$dataView['company']->getName()}}" id="company" disabled>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="company-code">Company Code</label>
                <input type="text" name="company_code" class="form-control" value="{{$dataView['company']->getCode()}}" id="company-code" readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Year</label>
                <select id="inputState" required name="year" class="form-control">
                    @foreach($dataView['years'] as $year)
                        <option name="{{$year}}">{{$year}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputAddress">Value</label>
                <input type="text" name="value" required class="form-control" id="inputAddress" placeholder="1,222,222">
            </div>
        </div>
    @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
