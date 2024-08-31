<?php

use App\Http\Traits\ManageInfoTrait;

class BankCashFlowDirectSeeder extends ImportFinancialIndicators
{
    use ManageInfoTrait;
    const KEY_INFO = 'Lưu chuyển tiền tệ trực tiếp';
    protected $fileName = 'storage/data/stock/VCB/VCB_LC_year_2017-2020.txt';

    /**
     * BankBalanceSheetSeeder constructor.
     */
    public function __construct()
    {
        $this->table = $this->tableBankCashFlowDirect;
        $this->keyInfo = self::KEY_INFO;
    }
}
