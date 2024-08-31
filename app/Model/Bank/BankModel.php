<?php

namespace App\Model\Bank;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BankModel extends Model implements BankModelInterface
{
    protected $tableInfoYear = '';
    protected $fillable = ['report_norm_id','parent_report_norm_id','name','name_en','index','note'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * @param string $companyCode
     * @param array $years
     * @return \Illuminate\Database\Eloquent\Builder[]|Collection
     */
    public function getListChildOfCompanyWithYears(string $companyCode, array $years)
    {
        $yearsString = json_encode($years);
        /**
         * @var \Illuminate\Database\Eloquent\Collection $listChild
         */
        return $this::query()
            ->whereRaw('parent_report_norm_id = ' . $this->getReportNormId()
                . ' and parent_report_norm_id != report_norm_id')
            ->select(
                ['*',
                    DB::raw("'{$companyCode}' as company_code"),
                    DB::raw("'{$yearsString}' as years")
                    ,
                    DB::raw("(SELECT GROUP_CONCAT(value,'-',year,'-',info_year.id) FROM {$this->tableInfoYear} as info_year
                                WHERE info_year.company_code = '{$companyCode}'
                                and info_year.income_statement_id={$this->table}.id
                                and info_year.year in (" . implode(',', $years) . ")
                                group by info_year.income_statement_id
                                ) as json")])
            ->get();
    }

    /**
     * @param string $companyCode
     * @param array $years
     * @return \Illuminate\Database\Eloquent\Builder[]|Collection
     */
    public function getListFirstParentOfCompanyWithYears(string $companyCode, array $years)
    {
        $yearsString = json_encode($years);
        /**
         * @var \Illuminate\Database\Eloquent\Collection $listChild
         */
        return $this::query()->whereRaw('report_norm_id = parent_report_norm_id')
            ->select(
                ['*',
                    DB::raw("'{$companyCode}' as company_code"),
                    DB::raw("'{$yearsString}' as years"),
                    DB::raw("(SELECT GROUP_CONCAT(value,'-',year,'-',info_year.id) FROM {$this->tableInfoYear} as info_year
                                WHERE info_year.company_code = '{$companyCode}'
                                and info_year.income_statement_id={$this->table}.id
                                and info_year.year in (" . implode(',', $years) . ")
                                group by info_year.income_statement_id
                                ) as json")])
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getListChild()
    {
        /**
         * @var \Illuminate\Database\Eloquent\Collection $listChild
         */
        return $this::query()
            ->whereRaw('parent_report_norm_id = ' . $this->getReportNormId()
                . ' and parent_report_norm_id != report_norm_id')->get();
    }

    /**
     * @param $report_norm_id
     * @return $this
     */
    public function loadByReportNormId($report_norm_id)
    {
        return $this->query()
            ->where('report_norm_id', $report_norm_id)
            ->get()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|Collection
     */
    public function getListFirstParent()
    {
        /**
         * @var \Illuminate\Database\Eloquent\Collection $listChild
         */
        return $this::query()->whereRaw('report_norm_id = parent_report_norm_id')->get();
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * @param string|string $nameEn
     * @return mixed
     */
    public function setNameEn(string $nameEn)
    {
        $this->name_en = $nameEn;
    }

    /**
     * @return mixed
     */
    public function getReportNormId()
    {
        return $this->report_norm_id;
    }

    /**
     * @param int|int $reportNormId
     * @return mixed
     */
    public function setReportNormId(int $reportNormId)
    {
        $this->report_norm_id = $reportNormId;
    }

    /**
     * @return mixed
     */
    public function getParentReportNormId()
    {
        return $this->parent_report_norm_id;
    }

    /**
     * @param int|int $parentReportNormId
     * @return mixed
     */
    public function setParentReportNormId(int $parentReportNormId)
    {
        $this->parent_report_norm_id = $parentReportNormId;
    }

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param string|string $index
     * @return mixed
     */
    public function setIndex(string $index)
    {
        $this->index = $index;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string|string $note
     * @return mixed
     */
    public function setNote(string $note)
    {
        $this->note = $note;
    }
}
