<?php

namespace App\Model\Bank;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;

class BalanceSheetInfoYearModel extends BankInfoYearModel
{
    protected $table = 'bank_balance_sheet_info_year';

    public function getNonPerformingLoan($companyCode,$year)
    {
        return 111;
    }
    public function getPerformingLoan($companyCode,$year)
    {
        return 111;
    }
}
