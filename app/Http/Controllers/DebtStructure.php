<?php

namespace App\Http\Controllers;

use App\Http\Traits\ManageInfoTrait;
use Illuminate\Http\Request;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\DB;


class DebtStructure extends Controller
{
    use ManageInfoTrait;
    const MAPPING_DEBIT_ID =[
        'Nợ đủ tiêu chuẩn' => 1,
        'Nợ cần chú ý' => 2,
        'Nợ dưới tiêu chuẩn' => 3,
        'Nợ nghi ngờ' => 4,
        'Nợ có khả năng mất vốn' => 5,
        'Hợp đồng Repo, hỗ trợ tài chính và ứng trước cho KH của MBS' => 6,
        'Cho vay giao dịch ký quỹ' => 7,
        'Nợ tồn động không có TSĐB và không còn đối tượng thu nợ' => 8
    ];

    public function EachBank()
    {
        $bankCode = 'HDB';
        $year = 2014;
        $newMapping = array_flip(self::MAPPING_DEBIT_ID);
        $info_debit_year_bank = DB::table($this->tableBankInfoDebitYear)
            ->where('year','=',$year)
            ->where('company_code','=',$bankCode)->get();
        $total = 0;
        foreach ($info_debit_year_bank as $item) {
            $total = $total + $item->value;
        }
        $newData = [];
        foreach ($info_debit_year_bank as $item) {
            $item->label = $newMapping[$item->debit_id];
            $item->percen = round($item->value/$total*100,2);
            $newData[] = $item;
        }
        $label = $bankCode.' - '.$year;
        $dataView['datas'] = $newData;
        $dataView['label'] = $label;
        return view('DebtStructureEachBank',['dataView' => $dataView]);
    }
    public function MultipleBank() {
        $years = [2013,2014,2015,2016,2017,2018,2019,2020];
        $bankCode = 'VCB';
        $newMapping = array_flip(self::MAPPING_DEBIT_ID);
        $dataView = [];
        foreach ($newMapping as $key => $mapping) {
            $totalByYear = DB::table($this->tableBankInfoDebitYear)
                ->select('year',DB::raw("SUM(value) as total"))
                ->where('company_code','=',$bankCode)
                ->whereIn('year',$years)
                ->groupBy('year')
                ->orderBy('year')
                ->get();
            $data = [];
            $data['label'] = $mapping;

            $info_debit_year_bank = DB::table($this->tableBankInfoDebitYear)
                ->whereIn('year',$years)
                ->where('debit_id','=',$key)
                ->where('company_code','=',$bankCode)
                ->orderBy('year')
                ->get();
            // process data.
            if(empty($info_debit_year_bank->toArray())) {
                continue;
            }
            foreach ($totalByYear as $key => $value ) {
                $info_debit_year_bank[$key]->percen = round($info_debit_year_bank[$key]->value/$totalByYear[$key]->total*100,2);
            }
            $data['info_year'] = $info_debit_year_bank;
            $dataView['data'][] = $data;
        }
        $dataView['title'] = "Phân tích nhóm nợ ngân hàng ".$bankCode;
        return view('DebtStructureMultipleBankVersion2',['dataView' => $dataView]);
    }

    public function IncreaseDebitCustomer()
    {
        $companyCode = 'VCB';
        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicator = 12;
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicator)
            ->where('company_code','=',$companyCode)
            ->orderBy('year')
            ->select(
                'main_table.year',
                'main_table.value',
                DB::raw("(SELECT (main_table.value - child.value)/child.value*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id={$indicator}
                                and child.year = (main_table.year-1)) as value_perious"))->get()
            ;

        foreach ($data as $item) {
            echo $item->year. ' ';
            echo $item->value. ' ';
            echo $item->value_perious. '---------';
        }die;
        var_dump($data);
    }

    public function ratioIncreaseDebtForEachBank()
    {
        $listBanks = ['MBB','HDB','VCB'];
        $year = 2018;
        $data = DB::table($this->tableBankBalanceSheetInfoYear .' as main_table')
            ->whereIn('company_code', $listBanks)
            ->where('year','=',$year)
            ->where('income_statement_id','=',12)
            ->select(
                'main_table.company_code',
                'main_table.year',
                DB::raw("(SELECT (main_table.value - child.value)/child.value*100  FROM ".$this->tableBankBalanceSheetInfoYear." as child
                                WHERE child.company_code = main_table.company_code
                                and child.income_statement_id=12
                                and child.year = (main_table.year-1)) as value_perious"))->get();
        var_dump($data);die;
    }

    public function ratioProvision()
    {

        #Dự phòng rủi ro cho vay và cho thuê tài chính khách hàng/ no xau
        # 4349/
    }

    # tang truong huy dong von = tien gui khach hang
    # % casa = tienguikhong ky han / tien gui khach hang
}
