<?php


namespace App\Model\Bank;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BankInfoYearModel extends Model
{
    protected $fillable = ['company_code','company_vs_id','income_statement_id','income_statement_id','report_norm_id','year','value'];

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
