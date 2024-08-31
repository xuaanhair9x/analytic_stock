<?php

namespace App\Console\Commands;

use App\Http\Traits\ManageInfoTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class InsertDataStock extends Command
{
    /**
     * @example : php artisan crawler:data:stock VCB KQKD 2017 2020
     **/
    protected $table;
    protected $tableIndicator;
    protected $key;

    const KEY_CDKT = 'CDKT';
    const KEY_KQKD = 'KQKD';
    const KEY_LC = 'LC';

    use ManageInfoTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:data:stock
                            {company_code : Code company}
                            {type}
                            {from_year}
                            {to_year}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $companyCode = $this->argument('company_code');
        $type = $this->argument('type');
        $from = $this->argument('from_year');
        $to = $this->argument('to_year');
        $filename = 'storage/data/stock/'.$companyCode.'/'.$companyCode.'_'.$type.'_year_'.$from.'-'.$to.'.txt';
        try {
            $content = File::get($filename);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return;
        }
        if ($type == self::KEY_CDKT) {
            $this->table = $this->tableBankBalanceSheetInfoYear;
            $this->tableIndicator = $this->tableBankBalanceSheet;
            $this->key = 'Cân đối kế toán';
        }
        else if($type == self::KEY_KQKD) {
            $this->table = $this->tableBankIncomeStatementInfoYear;
            $this->tableIndicator = $this->tableBankIncomeStatement;
            $this->key = 'Kết quả kinh doanh';
        }
        else if($type == self::KEY_LC) {
            $this->table = $this->tableBankCashFlowDirectInfoYear;
            $this->tableIndicator = $this->tableBankCashFlowDirect;
            $this->key = 'Lưu chuyển tiền tệ trực tiếp';
        }
        else {
            echo 'Type is not correct, Please try again.';
        }

        $dataSave = $this->preprocessData($content);
        if ($this->table == $this->tableBankCashFlowDirectInfoYear) {
            DB::table($this->table)->insert($dataSave);
        }
        else {
            DB::table($this->table)->insertOrIgnore($dataSave);
        }
        return 0;
    }

    protected function getCompanyCode($companyVsId)
    {
        $companies = \App\Model\Companies::where('company_vs_id',$companyVsId)->get()->toArray();
        $company = reset($companies);
        return $company['code'];
    }

    protected function getIndicatorId($reportNormID)
    {
        $indicator =
            DB::table($this->tableIndicator)
            ->where('report_norm_id',$reportNormID)
            ->get()
            ->toArray();
        $indicator = reset($indicator);
        return $indicator->id;
    }

    protected function preprocessData($dataString)
    {
        $dataOrigin = json_decode($dataString,true);
        $IncomeStatement = $dataOrigin[1][$this->key];
        $headDatas = $dataOrigin[0];
        $saveData = [];
        $ratioRow = 1;
        foreach ($IncomeStatement as $item)
        {
            foreach ($headDatas as $key  => $headData)
            {
                if ($key == 0) {
                    $ratioRow = (int)$headData["Row"] / 4;
                }
                $data = [];
                $indexRow = (int)$headData["Row"] - 4*($ratioRow-1);
                $data['company_code'] = $this->getCompanyCode($headData['CompanyID']);
                $data['company_vs_id'] = $headData['CompanyID'];
                $data['income_statement_id'] = $this->getIndicatorId($item['ReportNormID']);
                $data['report_norm_id'] = $item['ReportNormID'];
                $data['year'] = $headData['YearPeriod'];
                $value = $item['Value'. (string)$indexRow];
                if($value == null){
                    $value = 0;
                }
                $data['value'] = $value;
                $data['is_import'] = true;
                $saveData[] = $data;

            }
        }
        return $saveData;
    }
}
