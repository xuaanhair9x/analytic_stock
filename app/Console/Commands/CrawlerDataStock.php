<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CrawlerDataStock extends Command
{

    const API_ENDPOINT = "https://finance.vietstock.vn/data/financeinfo";
    protected $headerRequest = array(
    "User-Agent"=> "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.3");

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:data:stock
                            {company_code : Code company}
                            {period_time}
                            {report_type}
                            {page}
                            {page_size}
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
        $period = $this->argument('period_time');
        $this->getDataFromWebsite();
        return 0;
    }

    protected function getDataFromWebsite()
    {
        $reportTermType = 1;
        if($this->argument('period_time') != 'year') {
            $reportTermType = 2;
        }
        $page = (int)$this->argument('page');
        $pageSize = (int)$this->argument('page_size');
         $datarequest = array(
            "Code"=> $this->argument('company_code'),
            "Page"=> $page,
            "PageSize"=>$pageSize,
            "ReportTermType"=>$reportTermType,
            "ReportType"=>(int)$this->argument('report_type'),
            "Unit"=> 1000000);
        $currentYear = date("Y");
        $toYear = $currentYear-($page-1)*$pageSize;
        $fromYear = $currentYear-$page*$pageSize;
        $fileName=$this->argument('company_code').'_'.$this->argument('report_type').'_'.$this->argument('period_time').'_'.$fromYear.'_'.$toYear.'.txt';
        $result = $this->curl_get_contents(self::API_ENDPOINT,http_build_query($datarequest));
        echo $result;die;
        Storage::put($fileName, $result);
    }
    protected function curl_get_contents($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.3');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
