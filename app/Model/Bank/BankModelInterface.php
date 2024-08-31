<?php

namespace App\Model\Bank;

interface BankModelInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getNameEn();

    /**
     * @param string $nameEn
     * @return void
     */
    public function setNameEn(string $nameEn);

    /**
     * @return integer
     */
    public function getReportNormId();

    /**
     * @param int $reportNormId
     * @return void
     */
    public function setReportNormId(int $reportNormId);

    /**
     * @return integer
     */
    public function getParentReportNormId();

    /**
     * @param int $parentReportNormId
     * @return void
     */
    public function setParentReportNormId(int $parentReportNormId);

    /**
     * @return string
     */
    public function getIndex();

    /**
     * @param string $index
     * @return void
     */
    public function setIndex(string $index);

    /**
     * @return string
     */
    public function getNote();

    /**
     * @param string $note
     * @return void
     */
    public function setNote(string $note);

}
