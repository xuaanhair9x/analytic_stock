<?php

use App\Http\Traits\ManageInfoTrait;

class BankIncomeStatementSeeder extends ImportFinancialIndicators
{
    use ManageInfoTrait;
    const KEY_INFO = 'Kết quả kinh doanh';
    protected $fileName = 'storage/data/stock/HDB/HDB_KQKD_year_2017-2020.txt';

    public function __construct()
    {
        $this->table = $this->tableBankIncomeStatement;
        $this->keyInfo = self::KEY_INFO;
    }
}
