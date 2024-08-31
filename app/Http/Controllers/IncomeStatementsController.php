<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomeStatementsController extends Controller
{
    public function IncomeStatementsListing() {
        $datas = \App\IncomeStatement::all()->toArray();
        return view('IncomeStatementsListing',['datas' => $datas]);
    }

    public function addIncomeStatements()
    {
        $parent = \App\IncomeStatement::all()->toArray();
        $data['parent'] = $parent;
        $data['data_edit'] = null;
        return view('IncomeStatementsEditing',['data' => $data]);
    }

    public function editIncomeStatements($id)
    {
        $parent = \App\IncomeStatement::all()->toArray();
        $data['parent'] = $parent;
        $incomeStatements = new \App\IncomeStatement();
        $data['data_edit'] = $incomeStatements->find($id)->toArray();
        return view('IncomeStatementsEditing',['data' => $data]);
    }

    protected function validateData(Request $request) {
        $valid = true;
        if (!$request->name) {
            $valid = false;
        }
        if (!$request->note) {
            $valid = false;
        }
        return $valid;
    }
    public function saveData(Request $request)
    {
        if ($this->validateData($request)) {
            if ($request->isedit) {
                $typeCompany = \App\IncomeStatement::find($request->isedit);
                $typeCompany->name = $request->name;
                $typeCompany->name_vi = $request->name_vi;
                $typeCompany->note = $request->note;
                $typeCompany->parent = $request->parent;
                $typeCompany->save();
            }
            else {
                $typeCompany = new \App\IncomeStatement();
                $typeCompany->name = $request->name;
                $typeCompany->name_vi = $request->name_vi;
                $typeCompany->note = $request->note;
                $typeCompany->parent = $request->parent;
                $typeCompany->save();
            }
        }
        return redirect('income_statements_listing');
    }
}
