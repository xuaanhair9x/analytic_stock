<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Model\Bank\CashFlowDirectInfoYearModel;
use App\Model\Bank\BankModel;
use App\Model\Companies;
use Illuminate\Http\Request;
use App\Model\Bank\CashFlowDirectModel;
use App\Model\Bank\BalanceSheetInfoYearModel;

class CashFlowDirectController extends BankController
{
    protected $type = 'cash_flow';

    public function __construct(CashFlowDirectModel $bankModel, CashFlowDirectInfoYearModel $bankInfoYearModel, Companies $companies)
    {
        parent::__construct($bankModel, $bankInfoYearModel, $companies);
    }
}
