<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

/**
 * php artisan crawler:data:debit MBB 2020
 * Class InsertDataStockDebit
 * @package App\Console\Commands
 */
class InsertDataStockDebit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:data:debit
                            {company_code}
                            {year}';

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
        $year = $this->argument('year');
        $yearfrom = (int)$year - 3;
        $filename = 'storage/data/stock/'.$companyCode.'/'.$companyCode.'_debit_'.(string)$yearfrom.'-'.$year.'.txt';
        $content = File::get($filename);
        $dataSave = $this->preprocessData($content);
        DB::table('bank_info_debit_year')->insert($dataSave);
        return 0;
    }

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

    protected function preprocessData($dataString)
    {
        $dataOrigin = json_decode($dataString,true);
        $years = $dataOrigin['years'];
        $infos = $dataOrigin['info'];
        $saveData = [];
        $companyCode = $this->argument('company_code');
        foreach ($infos as $info)
        {
            foreach ($info['values'] as $key  => $value)
            {
                if ($this->checkDataExist(
                    $companyCode,self::MAPPING_DEBIT_ID[$info['title']],
                    self::MAPPING_DEBIT_ID[$info['title']],
                    $years[$key])) {
                    continue;
                }

                $data = [];
                $data['company_code'] = $companyCode;
                $data['debit_id'] = self::MAPPING_DEBIT_ID[$info['title']];
                $data['report_norm_id'] = self::MAPPING_DEBIT_ID[$info['title']];
                $data['value'] = $value;
                $data['year'] = $years[$key];
                $saveData[] = $data;
            }
        }
        return $saveData;
    }

    protected function checkDataExist($bankCodes, $debitId, $normId ,$year  )
    {
        $info_debit_year_bank = DB::table('bank_info_debit_year')
            ->where('company_code',$bankCodes)
            ->where('debit_id',$debitId)
            ->where('report_norm_id',$normId)
            ->where('year',$year)
            ->get();
        if(empty($info_debit_year_bank->toArray())) {
            return false;
        }
        return true;
    }
}
