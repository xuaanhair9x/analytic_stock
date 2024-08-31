<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Model\Bank\BankInfoYearModel;
use App\Model\Bank\BankModel;
use Illuminate\Http\Request;
use App\Model\Companies;
use App\Model\Bank\BalanceSheetModel;
use App\Model\Bank\BalanceSheetInfoYearModel;
use Illuminate\Database\Eloquent\Collection;
/**
 * Class BalanceSheetController
 * @package App\Http\Controllers\Bank
 */
class BalanceSheetController extends BankController
{

    protected $type = 'balance_sheet';

    public function __construct(
        BalanceSheetModel $bankModel,
        BalanceSheetInfoYearModel $bankInfoYearModel,
        Companies $companies
    )
    {
        parent::__construct($bankModel, $bankInfoYearModel, $companies);
    }
}
