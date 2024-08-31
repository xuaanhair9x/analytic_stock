<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\String_;

class Companies extends Model
{
    protected $table = 'companies';

    /**
     * @param string $company_code
     * @return \Illuminate\Support\HigherOrderCollectionProxy
     */
    public function getCompanyByCode(string $company_code)
    {
        return $this::query()->where('code','=',$company_code)->get()->first();
    }

    public function getCode()
    {
        return $this->code;
    }
    public function getName()
    {
        return $this->name;
    }
}
