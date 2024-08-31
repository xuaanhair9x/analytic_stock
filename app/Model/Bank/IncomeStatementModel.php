<?php

namespace App\Model\Bank;

use Illuminate\Database\Eloquent\Model;

class IncomeStatementModel extends BankModel
{
    protected $table = 'bank_income_statement';
    protected $tableInfoYear = 'bank_balance_sheet_info_year';

}
