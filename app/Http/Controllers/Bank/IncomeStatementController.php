<?php

namespace App\Http\Controllers\Bank;

use App\Model\Bank\IncomeStatementInfoYearModel;
use App\Model\Bank\IncomeStatementModel;
use App\Model\Companies;

class IncomeStatementController extends BankController
{
    protected $type = 'income_statement';
    public function __construct(IncomeStatementModel $bankModel, IncomeStatementInfoYearModel $bankInfoYearModel, Companies $companies)
    {
        parent::__construct($bankModel, $bankInfoYearModel, $companies);
    }
}
