<?php

namespace App\Console\Commands;

use App\Http\Traits\ManageInfoTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ConvertDataCSV extends Command
{
    /**
     * @example : php artisan convertdata:data:stock PNJ CDKT 2017 2020
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
    protected $signature = 'convertdata:data:stock
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

        $content = $this->preprocessData($content);
        $filename = 'storage/data/csv/'.$companyCode.'_'.$type.'_year_'.$from.'-'.$to.'.csv';
        $fp = fopen($filename,"wb");
        fwrite($fp,$content);
        fclose($fp);

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
        $headline = ',,,,';
        for ($i = 0; $i < count($headDatas); $i ++) {
            $headline .= ',';
            $headline .= (string)$headDatas[count($headDatas) - $i - 1]["YearPeriod"];
        }
        $headline .= PHP_EOL;
        foreach ($IncomeStatement as $item)
        {
            $lineValue = '';
            $lineName = '';
            for ($i = 0; $i < count($headDatas); $i ++) {
                $value = $item['Value'. (string)($i+1)];
                if ($value == null){
                    $value = 0;
                }
                $lineValue .= (string)$value . ',';
            }
            $item['NameVN'] = str_replace(',','.',$item['Name']);
            $item['NameEN'] = str_replace(',','.',$item['NameEn']);
            $item['Name'] = $item['NameVN'] . '('.$item['NameEN'].')';
            if ((int)$item['Levels'] == 0)
            {
                $lineName .= $item['Name'] . ',,,,,';
            }
            if ((int)$item['Levels'] == 1)
            {
                $lineName .= ',' . $item['Name'] . ',,,,';
            }
            if ((int)$item['Levels'] == 2)
            {
                $lineName .= ',,' . $item['Name'] . ',,,';
            }
            if ((int)$item['Levels'] == 3)
            {
                $lineName .= ',,,' . $item['Name'] . ',,';
            }
            if ((int)$item['Levels'] == 4)
            {
                $lineName .= ',,,,' . $item['Name'] . ',';
            }
            if ((int)$item['Levels'] == 5)
            {
                $lineName .= ',,,,' . $item['Name'] . '';
            }
            $headline .= $lineName.$lineValue.PHP_EOL;
        }
        return $headline;
    }
}
