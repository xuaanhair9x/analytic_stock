<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IncomeStatementsInfoYearController extends Controller
{
    public $year = [2016,2017,2018,2019,2020,2021];

    public function IncomeStatementsInfoYearListing() {
        $datas = \App\IncomeStatementInfoYear::all()->toArray();
        $datas = DB::table('income_statement_info_years as isiy')
            ->leftJoin('income_statements as is','isiy.income_statement_id','=','is.id')
            ->leftJoin('companies as c','isiy.company_code','=','c.code')
            ->select(
                'c.name as company',
                'is.name as income_statement',
                'isiy.*')
            ->get()->toArray();
        return view('IncomeStatementsInfoYearListing',['datas' => $datas]);
    }

    public function addIncomeStatementsInfoYear()
    {
        $company = \App\Companies::all()->toArray();
        $incomeStatement = \App\IncomeStatement::all()->toArray();
        $data['company'] = $company;
        $data['income_statement'] = $incomeStatement;
        $data['year'] = $this->year;
        $data['data_edit'] = null;
        return view('IncomeStatementsInfoYearEditing',['data' => $data]);
    }

    public function editIncomeStatementsInfoYear($id)
    {
        $company = \App\Companies::all()->toArray();
        $incomeStatement = \App\IncomeStatement::all()->toArray();
        $data['company'] = $company;
        $data['income_statement'] = $incomeStatement;
        $data['year'] = $this->year;
        $incomeStatementsInfoYear = new \App\IncomeStatementInfoYear();
        $data['data_edit'] = $incomeStatementsInfoYear->find($id)->toArray();
        return view('IncomeStatementsInfoYearEditing',['data' => $data]);
    }

    public function saveData(Request $request)
    {
        if ($request->isedit) {
            $typeCompany = \App\IncomeStatementInfoYear::find($request->isedit);
            $typeCompany->company_code = $request->company_code;
            $typeCompany->income_statement_id = $request->income_statement_id;
            $typeCompany->year = $request->year;
            $typeCompany->amount = $request->amount;
            $typeCompany->save();
        }
        else {
            $typeCompany = new \App\IncomeStatementInfoYear();
            $typeCompany->company_code = $request->company_code;
            $typeCompany->income_statement_id = $request->income_statement_id;
            $typeCompany->year = $request->year;
            $typeCompany->amount = $request->amount;
            $typeCompany->save();
        }
            return redirect('income_statements_info_year_listing');
    }
}
