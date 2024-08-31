<?php

namespace App\Model\Bank;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BalanceSheetModel extends BankModel
{
    protected $table = 'bank_balance_sheet';
    protected $tableInfoYear = 'bank_balance_sheet_info_year';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
