<?php

use App\Http\Traits\ManageInfoTrait;

class BankBalanceSheetSeeder extends ImportFinancialIndicators
{
    use ManageInfoTrait;
    const KEY_INFO = 'Cân đối kế toán';
    protected $fileName = 'storage/data/stock/VCB/VCB_CDKT_year_2017-2020.txt';

    /**
     * BankBalanceSheetSeeder constructor.
     */
    public function __construct()
    {
        $this->table = $this->tableBankBalanceSheet;
        $this->keyInfo = self::KEY_INFO;
    }
}
