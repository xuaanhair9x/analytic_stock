<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ManageInfoTrait;
use Illuminate\Support\Facades\File;

class ImportFinancialIndicators extends Seeder
{
    protected $keyInfo;
    protected $table;
    protected $fileName;
    public $stringValidIndex = 'A B C D E F G H I J K a b c d e f g h j i k1 2 I 3 4 II III IV V 5 6 9 10 11 12 VI VII VIII IX X XI 7 8 XII XIII XIV XV';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!$this->fileName) {
            echo 'Filename is empty.';
            return;
        }
        if (!$this->keyInfo) {
            echo 'KeyInfo is empty.';
            return;
        }
        if (!$this->table) {
           echo "Table is empty.";
           return;
        }

        $data = $this->readData($this->fileName);
        $dataProcess = $this->preprocessData($data,$this->keyInfo);
        DB::table($this->table)->insert($dataProcess);
    }

    /**
     * @param $filename
     * @return mixed
     */
    protected function readData($filename) {
        $content = File::get($filename);
        return json_decode($content,true);
    }

    /**
     * @param $data
     * @return array|false|string[]
     */
    protected function splitValueName($data) {
        $dataSplit = explode(' ', $data, 2);
        if(strpos($this->stringValidIndex, $data[0]) !== false) {
            return $dataSplit;
        }
        return [0,$data];
    }

    /**
     * @param $dataOrigin
     * @param $keyInfo
     * @return array
     */
    public function preprocessData($dataOrigin,$keyInfo)
    {
        $dataByKeyInfo = $dataOrigin[1][$keyInfo];
        $saveData = [];
        foreach ($dataByKeyInfo as $item)
        {
            $data = [];
            $splitValueName = $this->splitValueName($item['Name']);
            $splitValueNameEn = $this->splitValueName($item['NameEn']);
            $index = reset($splitValueName);
            $data['name'] = end($splitValueName);
            $data['name_en'] = end($splitValueNameEn);
            $data['report_norm_id'] = $item['ReportNormID'];
            $data['parent_report_norm_id'] = $item['ParentReportNormID'];
            $data['index'] =str_replace('.','',$index);
            $data['note']='';
            $saveData[] = $data;
        }
        return $saveData;
    }
}
