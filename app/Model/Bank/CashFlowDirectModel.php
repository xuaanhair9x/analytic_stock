<?php

namespace App\Model\Bank;

use Illuminate\Database\Eloquent\Model;

class CashFlowDirectModel extends BankModel
{
    protected $table = 'bank_cash_flow_direct';
    protected $tableInfoYear = 'bank_balance_sheet_info_year';

}
