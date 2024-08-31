<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Model\Bank\BalanceSheetModel;
use App\Model\Bank\BankInfoYearModel;
use App\Model\Companies;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Model\Bank\BankModel;

class BankController extends Controller
{

    /**
     * @var BankModel
     */
    protected $bankModel;

    protected $bankInfoYearModel;

    protected $companies;

    const YEARS = [2016,2017,2018,2019,2020];

    protected $type = '';

    const MAPPING_NAME = [
        'balance_sheet' => "Cân đối kế toán",
        'cash_flow' => "Lưu chuyển tiền tệ",
        'income_statement' => 'Kết quả kinh doanh'
    ];

    public function __construct(
        BankModel $bankModel,
        BankInfoYearModel $bankInfoYearModel,
        Companies $companies

    )
    {
        $this->companies = $companies;
        $this->bankInfoYearModel = $bankInfoYearModel;
        $this->bankModel = $bankModel;
    }
    public function showAllIndicatorIncludeInfo()
    {
        $bankCode = 'CTB';
        $listYear = [2017,2018,2019,2020];

        $listroot = $this->bankModel->getListFirstParentOfCompanyWithYears($bankCode,$listYear);
        $renderData = '';
        foreach ($listroot as $item) {
            /**
             * @var BalanceSheetModel $item
             */
            $renderData = $renderData. $this->getRowInfo($item,0);
            if ($item->getListChild() instanceof Collection) {
                $this->getTemplateShowAllIndicatorIncludeInfo($item->getListChildOfCompanyWithYears('VCB',[2017,2018,2019,2020]),1,$renderData);
            }
        }
        $dataView = [];
        $dataView['years'] = $listYear;
        $dataView['renderData'] = $renderData;
        $dataView['name'] = self::MAPPING_NAME[$this->type];
        return view('Bank/IndicatorInfo',['dataView' => $dataView]);
    }

    /**
     * @param Collection $listroot
     * @param int $level
     * @param $renderData
     */
    public function getTemplateShowAllIndicatorIncludeInfo(Collection $listroot, int $level, &$renderData)
    {
        foreach ($listroot as $item) {
            /**
             * @var BankModel $item
             */
            $listYear = json_decode($item->years);
            $renderData = $renderData. $this->getRowInfo($item,$level);
            $this->getTemplateShowAllIndicatorIncludeInfo($item->getListChildOfCompanyWithYears($item->company_code,$listYear),$level+1,$renderData);
        }
    }

    /**
     * @param Collection $listroot
     * @param int $level
     */
    public function getTemplateShowAllIndicator(Collection $listroot, int $level, &$renderData)
    {
        foreach ($listroot as $item) {
            /**
             * @var BankModel $item
             */
            $renderData = $renderData. $this->getRow($item,$level);
            $this->getTemplateShowAllIndicator($item->getListChild(),$level+1,$renderData);
        }
    }

    /**
     * @param BankModel $item
     * @param int $level
     * @return string
     */
    protected function getRow($item,$level)
    {
        $string = '';
        $string = $string . '<tr>';
        $string = $string . '<td class="level_'.(string)$level.'">'.$item->getIndex().'. '. $item->getName().'</td>';
        $string = $string . '<td><a href="/bank/'.$this->type.'/edit/indicator/'.(string)$item->id.'">edit</a></td>';
        $string = $string . '<td><a href="/bank/'.$this->type.'/add/child_indicator/'.(string)$item->id.'">add Child</a></td>';
        $string = $string . '</tr>';
        return $string;
    }

    /**
     * @param int $level
     * @param BankModel $item
     * @return string
     */
    protected function getRowInfo($item,$level)
    {
        $infoYear = $item->json;
        $infoYear = explode(',',$infoYear);
        $dataProcess = [];
        foreach ($infoYear as $data)
        {
            if($data == '') {
                continue;
            }
            $data = explode('-',$data)  ;
            $dataProcess[$data[1]] = ['value'=>$data[0],'id_indicator_info'=>$data[2]];
        }
        $listYear = json_decode($item->years);
        $string = '';
        $string = $string . '<tr>';
        $string = $string . '<td class="level_'.(string)$level.'">'. $item->getName().'</td>';
        foreach ($listYear as $year) {
            if(isset($dataProcess[$year])) {
                $linkEdit = route('edit_indicator_info',[$dataProcess[$year]['id_indicator_info']]);
                $string = $string . '<td> <a href="'.$linkEdit.'">'.(string)$dataProcess[$year]['value'].'</a></td>';
            }
            else {
                $string = $string . '<td>0</td>';
            }
        }
        $string = $string . '<td><a href="'.route('add_indicator_info',[$item->company_code,$item->id]).'">add info</a></td>';
        $string = $string . '</tr>';
        return $string;
    }

    /**
     * @param Request $request
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function saveIndicator(Request $request)
    {
        try {
            $dataSubmit = $request->all();
            if (!$dataSubmit['indicator_id']) {
                $dataSubmit['report_norm_id'] = $this->bankModel->max('report_norm_id') + 1;
            }
            $this->bankModel->updateOrCreate(
                [
                    'report_norm_id' => $dataSubmit['report_norm_id'],
                    'parent_report_norm_id' => $dataSubmit['parent_report_norm_id']
                ],
                [
                    'name' => $dataSubmit['name'],
                    'name_en' => $dataSubmit['name_en'],
                    'index' => $dataSubmit['index'],
                    'note' => $dataSubmit['note']
                ]
            );
        } catch (\Exception $exception)
        {
            var_dump($exception->getMessage());
            return false;
        }
        return redirect()->route($this->type);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllIndicator()
    {
        $listroot = $this->bankModel->getListFirstParent();
        $renderData = '';
        $dataView = [];
        foreach ($listroot as $item) {
            /**
             * @var BankModel $item
             */
            $renderData = $renderData. $this->getRow($item,0);
            if ($item->getListChild() instanceof Collection) {
                $this->getTemplateShowAllIndicator($item->getListChild(),1,$renderData);
            }
        }
        $dataView['renderData'] = $renderData;
        $dataView['name'] = self::MAPPING_NAME[$this->type];
        return view('Bank/Indicator',['dataView' => $dataView]);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function saveIndicatorInfo(Request $request)
    {
        $dataIndicatorInfo = $request->all();
        try {
            $this->bankInfoYearModel->updateOrCreate(
                [
                    'company_code' => $dataIndicatorInfo['company_code'],
                    'company_vs_id' => $dataIndicatorInfo['company_vs_id'],
                    'income_statement_id' => $dataIndicatorInfo['income_statement_id'],
                    'report_norm_id' => $dataIndicatorInfo['report_norm_id'],
                    'year' => $dataIndicatorInfo['year']
                ],
                [
                    'value' => $dataIndicatorInfo['value'],
                ]
            );
        } catch (\Exception $exception)
        {
            echo $exception->getMessage();
            return FALSE;
        }
        return redirect()->route($this->type.'_info_year');
    }

    /**
     * @param $idInfoYear
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function editIndicatorInfo($idInfoYear)
    {
        $dataView = [];
        $indicatorInfo = $this->bankInfoYearModel->find($idInfoYear);
        $company = $this->companies->getCompanyByCode($indicatorInfo->company_code);
        $dataView['company'] = $company;
        $indicator = $this->bankModel->loadByReportNormId($indicatorInfo->report_norm_id);
        $dataView['indicator'] = $indicator;
        $dataView['indicator_info'] = $indicatorInfo;
        $dataView['years'] = self::YEARS;
        $dataView['id'] = $idInfoYear;
        return view('Bank/EditIndicatorInfo',['dataView' => $dataView]);
    }

    /**
     * @param $codeCompany
     * @param $idIndicator
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function addIndicatorInfo($codeCompany,$idIndicator)
    {
        $dataView = [];
        $company = $this->companies->getCompanyByCode($codeCompany);
        $dataView['company'] = $company;
        $indicator = $this->bankModel->find($idIndicator);
        $dataView['indicator'] = $indicator;
        $dataView['id'] = null;
        $dataView['years'] = self::YEARS;
        return view('Bank/EditIndicatorInfo',['dataView' => $dataView]);
    }

    /**
     * @param $idParent
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addChildIndicator($idParent)
    {
        $parentModel = $this->bankModel->find($idParent);
        /**
         * @var BalanceSheetModel $parentModel
         */

        if($parentModel->id) {
            $parentModel->editable = 0;
            $parentModel->action_form = 'save_child_indicator_'.$this->type;
            return view('Bank/editIndicator',['dataView' => $parentModel]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editChildIndicator($id)
    {
        $bankModel = $this->bankModel->find($id);
        /**
         * @var BalanceSheetModel $parentModel
         */
        if($bankModel->id) {
            $bankModel->editable = 1;
            $bankModel->action_form = 'save_child_indicator_'.$this->type;
            return view('Bank/editIndicator',['dataView' => $bankModel]);
        }
    }
}
