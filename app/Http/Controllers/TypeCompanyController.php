<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeCompanyController extends Controller
{
    public function TypeCompanyListing() {
        $typeCompany = new \App\TypeCompany();
        $datas = $typeCompany::all()->toArray();
        return view('TypeCompanyListing',['datas' => $datas]);
    }

    public function addTypeCompany()
    {
        return view('TypeCompanyEditing',['data' => null]);
    }

    public function editTypeCompany($id)
    {
        $typeCompany = new \App\TypeCompany();
        $data = $typeCompany->find($id)->toArray();
        return view('TypeCompanyEditing',['data' => $data]);
    }

    protected function validateData(Request $request) {
        $valid = true;
        if (!$request->name) {
            $valid = false;
        }
        if (!$request->code) {
            $valid = false;
        }
        if (!$request->namevi) {
            $valid = false;
        }
        if (!$request->description) {
            $valid = false;
        }
        if (!$request->descriptionvi) {
            $valid = false;
        }
        return $valid;
    }
    public function submitForm(Request $request)
    {
        if ($this->validateData($request)) {
            if ($request->isedit) {
                $typeCompany = \App\TypeCompany::find($request->isedit);
                $typeCompany->code = $request->code;
                $typeCompany->name = $request->name;
                $typeCompany->name_vi = $request->namevi;
                $typeCompany->description = $request->description;
                $typeCompany->description_vi = $request->descriptionvi;
                $typeCompany->save();
            }
            else {
                $typeCompany = new \App\TypeCompany();
                $typeCompany->code = $request->code;
                $typeCompany->name = $request->name;
                $typeCompany->name_vi = $request->namevi;
                $typeCompany->description = $request->description;
                $typeCompany->description_vi = $request->descriptionvi;
                $typeCompany->save();
            }
        }
        return redirect('listtypecompany');
    }
}
