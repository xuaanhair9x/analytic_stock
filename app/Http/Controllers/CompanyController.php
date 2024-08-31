<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function GuzzleHttp\Psr7\str;

class CompanyController extends Controller
{
    protected $dataString = '[[{"ID":4,"Row":4,"CompanyID":1190,"YearPeriod":2017,"TermCode":"N","TermName":"Năm","TermNameEN":"Year","ReportTermID":1,"DisplayOrdering":1,"United":"HN","AuditedStatus":"KT","PeriodBegin":"201701","PeriodEnd":"201712","TotalRow":18,"BusinessType":3,"ReportNote":null,"ReportNoteEn":null},{"ID":3,"Row":3,"CompanyID":1190,"YearPeriod":2018,"TermCode":"N","TermName":"Năm","TermNameEN":"Year","ReportTermID":1,"DisplayOrdering":1,"United":"HN","AuditedStatus":"KT","PeriodBegin":"201801","PeriodEnd":"201812","TotalRow":18,"BusinessType":3,"ReportNote":null,"ReportNoteEn":null},{"ID":2,"Row":2,"CompanyID":1190,"YearPeriod":2019,"TermCode":"N","TermName":"Năm","TermNameEN":"Year","ReportTermID":1,"DisplayOrdering":1,"United":"HN","AuditedStatus":"KT","PeriodBegin":"201901","PeriodEnd":"201912","TotalRow":18,"BusinessType":3,"ReportNote":null,"ReportNoteEn":null},{"ID":1,"Row":1,"CompanyID":1190,"YearPeriod":2020,"TermCode":"N","TermName":"Năm","TermNameEN":"Year","ReportTermID":1,"DisplayOrdering":1,"United":"HN","AuditedStatus":"KT","PeriodBegin":"202001","PeriodEnd":"202112","TotalRow":18,"BusinessType":3,"ReportNote":null,"ReportNoteEn":null}],{"Kết quả kinh doanh":[{"ID":1,"ReportNormID":4399,"Name":"1. Thu nhập lãi và các khoản thu nhập tương tự","NameEn":"1. Interest income and similar income","NameMobile":"1. Thu nhập lãi và các khoản thu nhập tương tự","NameMobileEn":"1. Interest income and similar income","CssStyle":"Normal","Padding":"Padding1","ParentReportNormID":4385,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":32767393.00,"Value2":31196604.00,"Value3":24824365.00,"Value4":19876026.00,"Vl":null,"IsShowData":true},{"ID":2,"ReportNormID":4396,"Name":"2. Chi phí lãi và các chi phí tương tự","NameEn":"2. Interest expense and similar expenses","NameMobile":"2. Chi phí lãi và các chi phí tương tự","NameMobileEn":"2. Interest expense and similar expenses","CssStyle":"Normal","Padding":"Padding1","ParentReportNormID":4385,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":12489598.00,"Value2":13196607.00,"Value3":10240868.00,"Value4":8657074.00,"Vl":null,"IsShowData":true},{"ID":3,"ReportNormID":4385,"Name":"I. Thu nhập lãi thuần","NameEn":"I. Net interest income ","NameMobile":"I. Thu nhập lãi thuần","NameMobileEn":"I. Net interest income ","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4376,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":20277795.00,"Value2":17999997.00,"Value3":14583497.00,"Value4":11218952.00,"Vl":null,"IsShowData":true},{"ID":4,"ReportNormID":4397,"Name":"3. Thu nhập từ hoạt động dịch vụ","NameEn":"3. Fee and commission income","NameMobile":"3. Thu nhập từ hoạt động dịch vụ","NameMobileEn":"3. Fee and commission income","CssStyle":"Normal","Padding":"Padding1","ParentReportNormID":4386,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":8228173.00,"Value2":6420580.00,"Value3":5719062.00,"Value4":3222839.00,"Vl":null,"IsShowData":true},{"ID":5,"ReportNormID":4398,"Name":"4. Chi phí hoạt động dịch vụ","NameEn":"4. Fee and commission expenses","NameMobile":"4. Chi phí hoạt động dịch vụ","NameMobileEn":"4. Fee and commission expenses","CssStyle":"Normal","Padding":"Padding1","ParentReportNormID":4386,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":4652620.00,"Value2":3234743.00,"Value3":3157752.00,"Value4":2092163.00,"Vl":null,"IsShowData":true},{"ID":6,"ReportNormID":4386,"Name":"II. Lãi/lỗ thuần từ hoạt động dịch vụ","NameEn":"II. Net fee and commission income ","NameMobile":"II. Lãi/lỗ thuần từ hoạt động dịch vụ","NameMobileEn":"II. Net fee and commission income ","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4376,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":3575553.00,"Value2":3185837.00,"Value3":2561310.00,"Value4":1130676.00,"Vl":null,"IsShowData":true},{"ID":7,"ReportNormID":4387,"Name":"III. Lãi/lỗ thuần từ hoạt động kinh doanh ngoại hối và vàng","NameEn":"III. Net gain/(loss) from foreign currencies and gold trading","NameMobile":"III. Lãi/lỗ thuần từ hoạt động kinh doanh ngoại hối và vàng","NameMobileEn":"III. Net gain/(loss) from foreign currencies and gold trading","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4376,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":785809.00,"Value2":647478.00,"Value3":444568.00,"Value4":201772.00,"Vl":null,"IsShowData":true},{"ID":8,"ReportNormID":4388,"Name":"IV. Lãi/lỗ thuần từ mua bán chứng khoán kinh doanh","NameEn":"IV. Net gain/(loss) from trading securities","NameMobile":"IV. Lãi/lỗ thuần từ mua bán chứng khoán kinh doanh","NameMobileEn":"IV. Net gain/(loss) from trading securities","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4376,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":85086.00,"Value2":27480.00,"Value3":151928.00,"Value4":144445.00,"Vl":null,"IsShowData":true},{"ID":9,"ReportNormID":4389,"Name":"V. Lãi/lỗ thuần từ mua bán chứng khoán đầu tư","NameEn":"V. Net gain/(loss) from investment securities","NameMobile":"V. Lãi/lỗ thuần từ mua bán chứng khoán đầu tư","NameMobileEn":"V. Net gain/(loss) from investment securities","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4376,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":865869.00,"Value2":612031.00,"Value3":148561.00,"Value4":null,"Vl":null,"IsShowData":true},{"ID":10,"ReportNormID":4394,"Name":"5. Thu nhập từ hoạt động khác","NameEn":"5. Other income","NameMobile":"5. Thu nhập từ hoạt động khác","NameMobileEn":"5. Other income","CssStyle":"Normal","Padding":"Padding1","ParentReportNormID":4390,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":2808825.00,"Value2":2528554.00,"Value3":2421246.00,"Value4":1633022.00,"Vl":null,"IsShowData":true},{"ID":11,"ReportNormID":4395,"Name":"6. Chi phí hoạt động khác","NameEn":"6. Other expenses","NameMobile":"6. Chi phí hoạt động khác","NameMobileEn":"6. Other expenses","CssStyle":"Normal","Padding":"Padding1","ParentReportNormID":4390,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":1129275.00,"Value2":429156.00,"Value3":904167.00,"Value4":523948.00,"Vl":null,"IsShowData":true},{"ID":12,"ReportNormID":4390,"Name":"VI. Lãi/lỗ thuần từ hoạt động khác","NameEn":"VI. Net other income ","NameMobile":"VI. Lãi/lỗ thuần từ hoạt động khác","NameMobileEn":"VI. Net other income ","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4376,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":1679550.00,"Value2":2099398.00,"Value3":1517079.00,"Value4":1109074.00,"Vl":null,"IsShowData":true},{"ID":13,"ReportNormID":4393,"Name":"VII. Thu nhập từ góp vốn, mua cổ phần","NameEn":"VII. Income from capital contribution and long-term investments","NameMobile":"VII. Thu nhập từ góp vốn, mua cổ phần","NameMobileEn":"VII. Income from capital contribution and long-term investments","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4376,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":92511.00,"Value2":78227.00,"Value3":129620.00,"Value4":62157.00,"Vl":null,"IsShowData":true},{"ID":14,"ReportNormID":4391,"Name":"VIII. Chi phí hoạt động","NameEn":"VIII. Operating expenses","NameMobile":"VIII. Chi phí hoạt động","NameMobileEn":"VIII. Operating expenses","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4376,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":10555457.00,"Value2":9723706.00,"Value3":8733802.00,"Value4":5999239.00,"Vl":null,"IsShowData":true},{"ID":15,"ReportNormID":4376,"Name":"IX. Lợi nhuận thuần từ hoạt động kinh doanh trước chi phí dự phòng rủi ro tín dụng (I+II+III+IV+V+VI+VII-VIII)","NameEn":"IX. Operating profit before provision for credit losses","NameMobile":"IX. Lợi nhuận thuần từ hoạt động kinh doanh trước chi phí dự phòng rủi ro tín dụng (I+II+III+IV+V+VI+VII-VIII)","NameMobileEn":"IX. Operating profit before provision for credit losses","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4377,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":16806716.00,"Value2":14926742.00,"Value3":10802761.00,"Value4":7867837.00,"Vl":null,"IsShowData":true},{"ID":16,"ReportNormID":4392,"Name":"X. Chi phí dự phòng rủi ro tín dụng","NameEn":"X. Provision for credit losses","NameMobile":"X. Chi phí dự phòng rủi ro tín dụng","NameMobileEn":"X. Provision for credit losses","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4377,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":6118440.00,"Value2":4890623.00,"Value3":3035388.00,"Value4":3252111.00,"Vl":null,"IsShowData":true},{"ID":17,"ReportNormID":4377,"Name":"XI. Tổng lợi nhuận trước thuế (IX-X)","NameEn":"XI. Profit before tax ","NameMobile":"XI. Tổng lợi nhuận trước thuế (IX-X)","NameMobileEn":"XI. Profit before tax ","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4378,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":10688276.00,"Value2":10036119.00,"Value3":7767373.00,"Value4":4615726.00,"Vl":null,"IsShowData":true},{"ID":18,"ReportNormID":4383,"Name":"7. Chi phí thuế TNDN hiện hành","NameEn":"7. Current corporate income tax expenses","NameMobile":"7. Chi phí thuế TNDN hiện hành","NameMobileEn":"7. Current corporate income tax expenses","CssStyle":"Normal","Padding":"Padding1","ParentReportNormID":4382,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":2089420.00,"Value2":1959995.00,"Value3":1575157.00,"Value4":1125106.00,"Vl":null,"IsShowData":true},{"ID":19,"ReportNormID":4384,"Name":"8. Chi phí thuế TNDN hoãn lại","NameEn":"8. Deferred income tax expenses (*)","NameMobile":"8. Chi phí thuế TNDN hoãn lại","NameMobileEn":"8. Deferred income tax expenses (*)","CssStyle":"Normal","Padding":"Padding1","ParentReportNormID":4382,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":-7183.00,"Value2":7520.00,"Value3":2315.00,"Value4":205.00,"Vl":null,"IsShowData":true},{"ID":20,"ReportNormID":4382,"Name":"XII. Chi phí thuế TNDN","NameEn":"XII. Corporate income tax ","NameMobile":"XII. Chi phí thuế TNDN","NameMobileEn":"XII. Corporate income tax ","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4378,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":2082237.00,"Value2":1967515.00,"Value3":1577472.00,"Value4":1125311.00,"Vl":null,"IsShowData":true},{"ID":21,"ReportNormID":4378,"Name":"XIII. Lợi nhuận sau thuế (XI-XII)","NameEn":"XIII. Net profit after tax","NameMobile":"XIII. Lợi nhuận sau thuế (XI-XII)","NameMobileEn":"XIII. Net profit after tax","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4380,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":8606039.00,"Value2":8068604.00,"Value3":6189901.00,"Value4":3490415.00,"Vl":null,"IsShowData":true},{"ID":22,"ReportNormID":4379,"Name":"XIV. Lợi ích của cổ đông thiểu số","NameEn":"XIV. Minority interest","NameMobile":"XIV. Lợi ích của cổ đông thiểu số","NameMobileEn":"XIV. Minority interest","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4380,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":343380.00,"Value2":245831.00,"Value3":77187.00,"Value4":29212.00,"Vl":null,"IsShowData":true},{"ID":23,"ReportNormID":4380,"Name":"XV. Lợi nhuận sau thuế của cổ đông của Ngân hàng mẹ (XIII-XIV)","NameEn":"XV. Net profit atttributable to the equity holders of the Bank ","NameMobile":"XV. Lợi nhuận sau thuế của cổ đông của Ngân hàng mẹ (XIII-XIV)","NameMobileEn":"XV. Net profit atttributable to the equity holders of the Bank ","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4380,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":8262659.00,"Value2":7822773.00,"Value3":6112714.00,"Value4":3461203.00,"Vl":null,"IsShowData":true},{"ID":24,"ReportNormID":4381,"Name":"Lãi cơ bản trên cổ phiếu (BCTC) (VNÐ)","NameEn":"Earning per share (VND)","NameMobile":"Lãi cơ bản trên cổ phiếu (BCTC) (VNÐ)","NameMobileEn":"Earning per share (VND)","CssStyle":"NormalB","Padding":"Padding1","ParentReportNormID":4381,"ReportComponentName":"Kết quả kinh doanh","ReportComponentNameEn":"Income Statement","Unit":null,"UnitEn":null,"OrderType":null,"OrderingComponent":null,"RowNumber":null,"ReportComponentTypeID":null,"ChildTotal":0,"Levels":0,"Value1":2993.00,"Value2":3596.00,"Value3":2829.00,"Value4":1953.00,"Vl":null,"IsShowData":true}]},[{"AuditedStatusCode":"SX","Description":"Soát xét","DescriptionEn":"Reviewed"},{"AuditedStatusCode":"CKT","Description":"Chưa kiểm toán","DescriptionEn":"Unaudited"},{"AuditedStatusCode":"KT","Description":"Kiểm toán","DescriptionEn":"Audited"}],[{"UnitedCode":"HN","UnitedName":"Hợp nhất","UnitedNameEN":"Consolidated"},{"UnitedCode":"ĐL","UnitedName":"Đơn lẻ","UnitedNameEN":"Stand-alone"},{"UnitedCode":"CTM","UnitedName":"Công ty mẹ","UnitedNameEN":"Parent Company"}]]';
    protected function getCompanyCode($companyVsId)
    {
        $companies = \App\Companies::where('company_vs_id',$companyVsId)->get()->toArray();
        $company = reset($companies);
        return $company['code'];
    }

    protected function getIncomeStatementId($reportNormID)
    {
        $incomeStatements = \App\IncomeStatement::where('report_norm_id',$reportNormID)->get()->toArray();
        $incomeStatement = reset($incomeStatements);
        return $incomeStatement['id'];
    }

    protected function preprocessData()
    {
        $dataOrigin = json_decode($this->dataString,true);
        $IncomeStatement = $dataOrigin[1]['Kết quả kinh doanh'];
        $headDatas = $dataOrigin[0];
        $saveData = [];
        foreach ($IncomeStatement as $item)
        {
            foreach ($headDatas as $key  => $headData)
            {
                $data = [];
                $data['company_code'] = $this->getCompanyCode($headData['CompanyID']);
                $data['company_vs_id'] = $headData['CompanyID'];
                $data['income_statement_id'] = $this->getIncomeStatementId($item['ReportNormID']);
                $data['report_norm_id'] = $item['ReportNormID'];
                $data['year'] = $headData['YearPeriod'];
                $data['value'] = $item['Value'.(string)($key+1)];
                $saveData[] = $data;

            }
        }
        return $saveData;
    }

    public function CompanyListing() {
        $this->preprocessData();
        $datas = \App\Companies::all()->toArray();
        return view('CompanyListing',['datas' => $datas]);
    }

    public function addCompany()
    {
        $typeCompany = \App\TypeCompany::all()->toArray();
        $data['company'] = null;
        $data['type_company'] = $typeCompany;
        return view('CompanyEditing',['data' => $data]);
    }

    public function editCompany($id)
    {
        $data['type_company'] = \App\TypeCompany::all()->toArray();
        $data['company'] = \App\Companies::find($id)->toArray();
        return view('CompanyEditing',['data' => $data]);
    }

    protected function validateData(Request $request) {
        $valid = true;
        if (!$request->name) {
            $valid = false;
        }
        if (!$request->code) {
            $valid = false;
        }
        if (!$request->name_vi) {
            $valid = false;
        }
        if (!$request->description) {
            $valid = false;
        }
        if (!$request->description_vi) {
            $valid = false;
        }
        return $valid;
    }
    public function saveData(Request $request)
    {
        if ($this->validateData($request)) {
            if ($request->isedit) {
                $typeCompany = \App\Companies::find($request->isedit);
                $typeCompany->code = $request->code;
                $typeCompany->code_type_company = $request->code_type_company;
                $typeCompany->name = $request->name;
                $typeCompany->name_vi = $request->name_vi;
                $typeCompany->description = $request->description;
                $typeCompany->description_vi = $request->description_vi;
                $typeCompany->save();
            }
            else {
                $typeCompany = new \App\Companies();
                $typeCompany->code = $request->code;
                $typeCompany->code_type_company = $request->code_type_company;
                $typeCompany->name = $request->name;
                $typeCompany->name_vi = $request->name_vi;
                $typeCompany->description = $request->description;
                $typeCompany->description_vi = $request->description_vi;
                $typeCompany->save();
            }
        }
        return redirect('listcompany');
    }
}
