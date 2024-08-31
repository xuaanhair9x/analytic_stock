<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Http\Traits\ManageInfoTrait;
use Illuminate\Support\Facades\DB;
use App\Model\Companies;

class AnalyticController extends Controller
{
    use ManageInfoTrait;
    protected $companies;

    const MAPPING_DEBIT_ID =[
        'Nợ đủ tiêu chuẩn' => 1,
        'Nợ cần chú ý' => 2,
        'Nợ dưới tiêu chuẩn' => 3,
        'Nợ nghi ngờ' => 4,
        'Nợ có khả năng mất vốn' => 5,
        'Hợp đồng Repo, hỗ trợ tài chính và ứng trước cho KH của MBS' => 6,
        'Cho vay giao dịch ký quỹ' => 7,
        'Nợ tồn động không có TSĐB và không còn đối tượng thu nợ' => 8
    ];

    public function __construct(
        Companies $companies
    )
    {
        $this->companies = $companies;
    }

    /**
     * Tỷ lệ nợ xấu của ngân hàng qua các năm.
     */
    public function badDebtBankRatio() {
        $companyCodes = ['VCB','MBB','HDB'];
        $years = [2013,2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankInfoDebitYear;
        foreach ($companyCodes as $companyCode)
        {
            foreach ($years as $year)
            {
                $data[$companyCode][$year] = DB::table( $mainTable,'main_table')
                    ->whereIn('debit_id',[1,2,3,4,5,6,7,8,9,10])
                    ->where('company_code','=',$companyCode)
                    ->where('year',$year)
                    ->groupBy('year')
                    ->select(
                        'main_table.year',
                        DB::raw("(SELECT sum(child.value)/sum(main_table.value)*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.year = {$year}
                                and child.debit_id in (4,5)
                                group by year) as ratio"))
                    ->get()->first();
            }
        }

        $dataView['data'] = $data;
        $dataView['title'] = __('Debt bank ratio.');
        return view('bank/Analytic/ContingencyCostRatio',['dataView' => $dataView]);
    }


    /**
     * Cho vay của nhiều ngân hàng trong 1 năm.
     */
    public function LoanOfBankByBanks()
    {
        $year = 2021;
        $bankCodes = ['VCB','HDB','MBB','ACB'];
        $newMapping = array_flip(self::MAPPING_DEBIT_ID);
        foreach ($newMapping as $key => $mapping) {
            $data['label'] = $mapping;
            $info_debit_year_bank = [];
            foreach ($bankCodes as $code) {
                $info_one_bank = DB::table($this->tableBankInfoDebitYear)
                    ->where('company_code',$code)
                    ->where('debit_id','=',$key)
                    ->where('year','=',$year)
                    ->select(['*',
                        DB::raw('company_code as label')
                    ])
                    ->get();
                if(empty($info_one_bank->toArray())) {
                    $info_one_bank = new \stdClass();
                    $info_one_bank->company_code = $code;
                    $info_one_bank->label = $code;
                    $info_one_bank->value = 0;
                }
                else {
                    $info_one_bank = $info_one_bank[0];
                }
                $info_debit_year_bank[] = $info_one_bank;
            }
            /**
            $info_debit_year_bank = DB::table($this->tableBankInfoDebitYear)
                ->whereIn('company_code',$bankCodes)
                ->where('debit_id','=',$key)
                ->where('year','=',$year)
                ->select(['*',
                    DB::raw('company_code as label')
                ])
                ->orderBy('year')
                ->get();
            if(empty($info_debit_year_bank->toArray())) {
                continue;
            }
             * */
            $data['info_year'] = $info_debit_year_bank;
            $dataView['data'][] = $data;
        }
        $dataView['title'] = "Phân tích nhóm nợ ngân hàng ".$year;
        return view('bank/Analytic/LoanOfBank',['dataView' => $dataView]);
    }

    /**
     * Cho vay của của 1 ngân hàng qua các năm.
     */
    public function LoanOfBankByYears()
    {
        $years = [2013,2014,2015,2016,2017,2018,2019,2020,2021];
        $bankCode = 'CTG';
        $newMapping = array_flip(self::MAPPING_DEBIT_ID);
        foreach ($newMapping as $key => $mapping) {
            $data['label'] = $mapping;
            $info_debit_year_bank = DB::table($this->tableBankInfoDebitYear)
                ->whereIn('year',$years)
                ->where('debit_id','=',$key)
                ->where('company_code','=',$bankCode)
                ->select(['*',
                    DB::raw('year as label')
                    ])
                ->orderBy('year')
                ->get();
            // process data.
            if(empty($info_debit_year_bank->toArray())) {
                continue;
            }
            $data['info_year'] = $info_debit_year_bank;
            $dataView['data'][] = $data;
        }
        $dataView['title'] = "Phân tích nhóm nợ ngân hàng ".$bankCode;
        return view('bank/Analytic/LoanOfBank',['dataView' => $dataView]);
    }

    /**
     * Tỉ lệ chi phí dự phòng.
     */
    public function contingencyCostRatio()
    {
        $companyCodes = ['VCB','MBB','HDB','TCB'];
        $years = [2016,2017,2018,2019,2020];
        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicator = 14;
        foreach ($companyCodes as $code) {
            foreach ($years as $year) {
                $data[$code][$year] = DB::table( $mainTable,'main_table')
                    ->where('income_statement_id','=',$indicator)
                    ->where('company_code','=',$code)
                    ->where('year',$year)
                    ->orderBy('year')
                    ->select(
                        'main_table.year',
                        'main_table.value',
                        DB::raw("(SELECT (-1)*1000*main_table.value/sum(bidy.value)*100  FROM bank_info_debit_year as bidy
                                WHERE bidy.company_code = '{$code}'
                                and bidy.year={$year}
                                and debit_id in (3,4,5) group by bidy.company_code) as ratio"))->get()->first();
            }
        }
        $dataView['data'] = $data;
        $dataView['title'] = __('Tỉ lệ chi phí dự phòng rủi ro tín dụng.');
        return view('bank/Analytic/ContingencyCostRatio',['dataView' => $dataView]);
    }

    /**
     * Tiền gửi khách hàng và tỷ lệ casa
     */
    public function depositsFromCustomerAndCasa()
    {
        $companyCode = 'VCB';
        $years = [2018,2019,2020];
        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicator = 53; // Tiền gửi khách hàng.
        $indicatorCasa = 84; // Tiền gửi khách hàng không kỳ hạn.
        foreach ($years as $year) {
            $data[$year] = DB::table( $mainTable,'main_table')
                ->where('income_statement_id','=',$indicator)
                ->where('company_code','=',$companyCode)
                ->where('year',$year)
                ->select(
                    'main_table.year',
                    'main_table.value as deposit_customer',
                    DB::raw("(SELECT (child.value)/main_table.value*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.year = {$year}
                                and child.income_statement_id={$indicatorCasa}) as percent_casa"))
                ->get()->first();
        }
        $dataView['data'] = $data;
        return view('bank/Analytic/DepositsFromCustomersAndCasa',['dataView' => $dataView]);

    }

    /**
     * Tăng trưởng huy động tiền gửi khách hàng
     */
    public function depositsFromCustomerRatio()
    {
        $companyCodes = ['VCB','MBB','HDB'];
        $years = [2013,2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicator = 53;
        foreach ($companyCodes as $code)
        {
            foreach ($years as $year)
            {
                $data[$code][$year] = DB::table( $mainTable,'main_table')
                    ->where('income_statement_id','=',$indicator)
                    ->where('company_code','=',$code)
                    ->where('year',$year)
                    ->orderBy('year')
                    ->select(
                        'main_table.year',
                        'main_table.value',
                        DB::raw("(SELECT (main_table.value - child.value)/child.value*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$code}'
                                and child.income_statement_id={$indicator}
                                and child.year = (main_table.year-1)) as value_perious"))->get()->first();
            }
        };
        $dataView['title'] = 'Tăng trưởng huy động tiền gửi khách hàng';
        $dataView['data'] = $data;
        return view('bank/Analytic/IncreaseLoanCustomer',['dataView' => $dataView]);
    }

    /**
     * Tỷ lệ casa của các ngân hàng qua các năm của các ngân hàng.
     */
    public function casaRatio()
    {
        $companyCodes = ['VCB','MBB','HDB'];
        $years = [2018,2019,2020];
        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicator = 53; // Tiền gửi khách hàng.
        $indicatorCasa = 84; // Tiền gửi khách hàng không kỳ hạn.
        foreach ($companyCodes as $companyCode) {
            foreach ($years as $year) {
                $data[$companyCode][$year] = DB::table( $mainTable,'main_table')
                    ->where('income_statement_id','=',$indicator)
                    ->where('company_code','=',$companyCode)
                    ->where('year',$year)
                    ->select(
                        'main_table.year',
                        'main_table.value as deposit_customer',
                        DB::raw("(SELECT (child.value)/main_table.value*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.year = {$year}
                                and child.income_statement_id={$indicatorCasa}) as ratio"))
                    ->get()->first();
            }
        }
        $dataView['data'] = $data;
        $dataView['title'] = __('Tỉ lệ casa.');
        return view('bank/Analytic/ContingencyCostRatio',['dataView' => $dataView]);
    }

    /**
     * Chi phí dự phòng rủi ro tín dụng.
     */
    public function contingencyCost()
    {
        $companyCode = 'MBB';
        $years = [2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicator = 14;
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicator)
            ->where('company_code','=',$companyCode)
            ->whereIn('year',$years)
            ->orderBy('year')->get();
        $dataView['data'] = $data;
        $dataView['title'] = 'Ngân hàng '. $companyCode ;
        $dataView['legendText'] = 'Chi phí dự phòng rủi ro tín dụng';
        return view('bank/Analytic/LoanCustomer',['dataView' => $dataView]);
    }

    /**
     * Cho vay khách hàng qua các năm của 1 ngân hàng.
     */
    public function LoanCustomer()
    {
        $companyCode = 'MBB';
        $years = [2013,2014,2015,2016,2017,2018,2019,2020,2021];

        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicator = 12;
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicator)
            ->where('company_code','=',$companyCode)
            ->whereIn('year',$years)
            ->orderBy('year')->get();
        $dataView['data'] = $data;
        $dataView['title'] = 'Ngân hàng '. $companyCode ;
        $dataView['legendText'] = 'Loans, advances and finance leases to customers';
        return view('bank/Analytic/LoanCustomer',['dataView' => $dataView]);
    }

    /**
     * Tăng trưởng cho vay khách hàng.
     * = (Cho vay khách hàng năm n - Cho vay khách hàng năm n-1)/Cho vay khách hàng năm n-1
     */
    public function increaseLoanCustomer()
    {
        $companyCodes = ['VCB','MBB','HDB','ACB','TCB','BID'];
        $years = [2013,2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicator = 12;
        foreach ($companyCodes as $code)
        {
            foreach ($years as $year)
            {
                $data[$code][$year] = DB::table( $mainTable,'main_table')
                    ->where('income_statement_id','=',$indicator)
                    ->where('company_code','=',$code)
                    ->where('year',$year)
                    ->orderBy('year')
                    ->select(
                        'main_table.year',
                        'main_table.value',
                        DB::raw("(SELECT (main_table.value - child.value)/child.value*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$code}'
                                and child.income_statement_id={$indicator}
                                and child.year = (main_table.year-1)) as value_perious"))->get()->first();
            }
        };
        $dataView['data'] = $data;
        $dataView['title'] = 'Tăng trưởng cho vay khách hàng';
        return view('bank/Analytic/IncreaseLoanCustomer',['dataView' => $dataView]);
    }

    /**
     * LDR
     * Tỷ lệ dư nợ tín dụng trên vốn huy động của các ngân hàng qua các năm.
     * Cho vay và cho thuê tài chính khách hàng / Tiền gửi của khách hàng
     */
    public function LoanToDeposit()
    {
        $companyCodes = ['VCB','MBB','HDB','TCB','ACB'];
        $years = [2013,2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankBalanceSheetInfoYear;
        $indicatorLoan = 13;
        $indicatorDeposit = 53;
        foreach ($companyCodes as $companyCode) {
            foreach ($years as $year) {
                $data[$companyCode][$year] = DB::table( $mainTable,'main_table')
                    ->where('income_statement_id','=',$indicatorDeposit)
                    ->where('company_code','=',$companyCode)
                    ->where('year',$year)
                    ->select(
                        'main_table.year',
                        'main_table.value as deposit_customer',
                        DB::raw("(SELECT (child.value)/main_table.value*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.year = {$year}
                                and child.income_statement_id={$indicatorLoan}) as ratio"))
                    ->get()->first();
            }
        }
        $dataView['data'] = $data;
        $dataView['title'] = __('Tỉ lệ LDR.');
        return view('bank/Analytic/ContingencyCostRatio',['dataView' => $dataView]);
    }

    /**
     * Doanh thu thuần và tăng trưởng doanh thu thuần.
     */
    public function NetInterestIncomeAndIncreasement()
    {
        $companyCode = 'VCB';
        $years = [2013,2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankIncomeStatementInfoYear;
        $indicator = 3;
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicator)
            ->where('company_code','=',$companyCode)
            ->whereIn('year',$years)
            ->orderBy('year')
            ->select(
                'main_table.year as label',
                'main_table.value as amount',
                DB::raw("(SELECT (main_table.value - child.value)/child.value*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id={$indicator}
                                and child.year = (main_table.year-1)) as increase_value"))->get();
        $dataView['data'] = $data;
        $dataView['title'] = __('Doanh thu thuần và tăng trưởng doanh thu thuần.');
        return view('bank/Analytic/IncreasePercentAndAmount',['dataView' => $dataView]);
    }

    /**
     * Lợi nhuận sau thuế và tăng trưởng Lợi nhuận sau thuế.
     */
    public function NetProfitAfterTaxAndIncreasement()
    {
        $companyCode = 'VCB';
        $years = [2013,2014,2015,2016,2017,2018,2019,2020];
        $mainTable = $this->tableBankIncomeStatementInfoYear;
        $indicator = 21;
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicator)
            ->where('company_code','=',$companyCode)
            ->whereIn('year',$years)
            ->orderBy('year')
            ->select(
                'main_table.year as label',
                'main_table.value as amount',
                DB::raw("(SELECT (main_table.value - child.value)/child.value*100  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id={$indicator}
                                and child.year = (main_table.year-1)) as increase_value"))->get();
        $dataView['data'] = $data;
        $dataView['title'] = __('Lợi nhuận sau thuế và tăng trưởng Lợi nhuận sau thuế.');
        return view('bank/Analytic/IncreasePercentAndAmount',['dataView' => $dataView]);
    }

    /**
     * Thu nhập ngoài lãi và tỷ lệ thu nhập từ hoạt động dịch vụ
     */
    public function NonInterestIncomeAndIncomeFromService()
    {
        $companyCode = 'VCB';
        $years = [2013,2014,2015,2016,2017,2018,2019,2020];
        $mainTable = $this->tableBankIncomeStatementInfoYear;
        $indicatorNonInterestIncome = [6,7,8,9];
        $indicatorIncomeFromService = 6;
        $indicatorOtherIncome = 12;

        $data = DB::table( $mainTable,'main_table')
            ->whereIn('income_statement_id',$indicatorNonInterestIncome )
            ->where('company_code','=',$companyCode)
            ->whereIn('year',$years)
            ->groupBy('year')
            ->select(
                'main_table.year as label',
                DB::raw('sum(main_table.value) as amount_one'),
                DB::raw("(SELECT child.value  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id={$indicatorIncomeFromService}
                                and child.year = main_table.year) as amount_two"),
                DB::raw("(SELECT child.value  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id={$indicatorOtherIncome}
                                and child.year = main_table.year) as amount_three"))->get();
        $dataView['main_label'] = ['Bank for Foreign Trade of Vietnam (VCB)', 'Non-Interest Income', 'Income From Service', 'Other Income'];
        $dataView['title'] = __('Income structure');
        $dataView['sub_title'] = __('Analysis results of a bank over the years');
        $dataView['data'] = $data;
        return view('bank/Analytic/NonInterestIncomeAndIncomeFromService',['dataView' => $dataView]);
    }

    public function nimOfOneBankOnYears($companyCode)
    {
        $years = [2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankIncomeStatementInfoYear;
        $indicatorNetIncome = 3;
        $indicatorInterestEarningAssetsSql = '(3,4,8,12,18)';
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicatorNetIncome)
            ->where('company_code','=',$companyCode)
            ->whereIn('year',$years)
            ->orderBy('year')
            ->select(
                'main_table.year as label',
                'main_table.value as value_net_income',
                DB::raw("(SELECT sum(child.value)
                                FROM {$this->tableBankBalanceSheetInfoYear} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id in {$indicatorInterestEarningAssetsSql}
                                and child.year = main_table.year
                                group by company_code) as current_year"),
                DB::raw("(SELECT sum(child.value)
                                FROM {$this->tableBankBalanceSheetInfoYear} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id in {$indicatorInterestEarningAssetsSql}
                                and child.year = (main_table.year-1)
                                group by company_code) as previous_year"))->get();
        for ($i = 0 ; $i < count($data) ; $i++)
        {
            if(!$data[$i]->current_year || !$data[$i]->previous_year) {
                $data[$i]->value_display = 0;
                continue;
            }
            $average = ($data[$i]->current_year + $data[$i]->previous_year)/2;
            $data[$i]->value_display = $data[$i]->value_net_income/($average)*100;
            if(!$data[$i]->previous_year)
            {
                $data[$i]->value_display = 0;
            }
        }
        return $data;
    }

    public function nimOfManyBankOnManyYears()
    {
        $banks = ['VCB','ACB','HDB','VPB','MBB'];
        $data = [];
        foreach ($banks as $bank)
        {
            $data[$bank] = $this->nimOfOneBankOnYears($bank);
        }
        $dataView['title'] = __("Chỉ số nim của các ngân hàng qua các năm");
        $dataView['data'] = $data;
        $dataView['axis_y'] = __('Tỷ lệ chỉ số NIM');
        $dataView['suffix'] = __('%');
        return view('bank/Analytic/ChartLineManyCompanyOnManyYears',['dataView' => $dataView]);
    }

    public function costToIncomeRatio()
    {
        $companyCodes = ['MSB','VCB','MBB','TCB','ACB','TPB','CTG','BID','OCB'];
        $years = [2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankIncomeStatementInfoYear;
        $indicatorCostOperating = 14;
        $indicatorIncomeOperating = '(3,6,7,8,9,12,13)';
        foreach ($companyCodes as $companyCode)
        {
            $data[$companyCode] = DB::table( $mainTable,'main_table')
                ->where('income_statement_id','=',$indicatorCostOperating)
                ->where('company_code','=',$companyCode)
                ->whereIn('year',$years)
                ->orderBy('year')
                ->select(
                    'main_table.year as label',
                    'main_table.value as amount',
                    DB::raw("(SELECT main_table.value*100/SUM(child.value)  FROM {$mainTable} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id in {$indicatorIncomeOperating}
                                and child.year = main_table.year
                                group by child.year) as value_display"))->get();

        }
        $dataView['title'] = __("Chỉ số cir của các ngân hàng qua các năm");
        $dataView['data'] = $data;
        $dataView['axis_y'] = __('Tỷ lệ chỉ số cir');
        $dataView['suffix'] = __('%');
        return view('bank/Analytic/ChartLineManyCompanyOnManyYears',['dataView' => $dataView]);
    }

    public function netIncomeAfterTaxManyComanyOnOneYear()
    {
        $companyCodes = ['VCB','MBB','HDB','TCB'];
        $year = 2021;
        $mainTable = $this->tableBankIncomeStatementInfoYear;
        $indicatorNetIncomeAfterTax = 21;
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicatorNetIncomeAfterTax)
            ->where('year','=',$year)
            ->whereIn('company_code',$companyCodes)
            ->select(
                DB::raw('main_table.company_code as label'),
                DB::raw('main_table.value as value_display')
            )->get();
        $dataView['title'] = __("Lợi nhuận sau thuế của các ngân hàng trong năm ".$year);
        $dataView['data'] = $data;
        $dataView['sub_title'] = __('');
        return view('bank/Analytic/AmountOfManyCompanyOnOneYear',['dataView' => $dataView]);
    }

    public function roeOfOneBankOnYears($companyCode)
    {
        $years = [2012,2013,2014,2015,2016,2017,2018,2019,2020,2021];
        $mainTable = $this->tableBankIncomeStatementInfoYear;
        $indicatorNetIncomeAfterTax = 21;
        $indicatorCapitalAndReserves = 63;
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicatorNetIncomeAfterTax)
            ->where('company_code','=',$companyCode)
            ->whereIn('year',$years)
            ->orderBy('year')
            ->select(
                'main_table.year as label',
                'main_table.value as value_net_income_after_tax',
                DB::raw("(SELECT sum(child.value)
                                FROM {$this->tableBankBalanceSheetInfoYear} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id = {$indicatorCapitalAndReserves}
                                and child.year = main_table.year) as current_year"),
                DB::raw("(SELECT sum(child.value)
                                FROM {$this->tableBankBalanceSheetInfoYear} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id = {$indicatorCapitalAndReserves}
                                and child.year = (main_table.year-1)) as previous_year"))->get();
        for ($i = 0 ; $i < count($data) ; $i++)
        {
            if(!$data[$i]->current_year || !$data[$i]->previous_year) {
                $data[$i]->value_display = 0;
                continue;
            }
            $average = ($data[$i]->current_year + $data[$i]->previous_year)/2;
            $data[$i]->value_display = $data[$i]->value_net_income_after_tax/($average)*100;
            if(!$data[$i]->previous_year)
            {
                $data[$i]->value_display = 0;
            }
        }
        return $data;
    }
    public function roeOfManyBankOnManyYears()
    {
        $banks = ['VCB','VPB'];
        $data = [];
        foreach ($banks as $bank)
        {
            $data[$bank] = $this->roeOfOneBankOnYears($bank);
        }
        $dataView['title'] = __("Chỉ số ROE của các ngân hàng qua các năm");
        $dataView['data'] = $data;
        $dataView['axis_y'] = __('Tỷ lệ chỉ số ROE');
        $dataView['suffix'] = __('%');
        return view('bank/Analytic/ChartLineManyCompanyOnManyYears',['dataView' => $dataView]);
    }

    public function roaOfOneBankOnYears($companyCode)
    {
        $years = [2013,2014,2015,2016,2017,2018,2019,2020];
        $mainTable = $this->tableBankIncomeStatementInfoYear;
        $indicatorNetIncomeAfterTax = 21;
        $indicatorTotalAssets = 47;
        $data = DB::table( $mainTable,'main_table')
            ->where('income_statement_id','=',$indicatorNetIncomeAfterTax)
            ->where('company_code','=',$companyCode)
            ->whereIn('year',$years)
            ->orderBy('year')
            ->select(
                'main_table.year as label',
                'main_table.value as value_net_income_after_tax',
                DB::raw("(SELECT sum(child.value)
                                FROM {$this->tableBankBalanceSheetInfoYear} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id = {$indicatorTotalAssets}
                                and child.year = main_table.year) as current_year"),
                DB::raw("(SELECT sum(child.value)
                                FROM {$this->tableBankBalanceSheetInfoYear} as child
                                WHERE child.company_code = '{$companyCode}'
                                and child.income_statement_id = {$indicatorTotalAssets}
                                and child.year = (main_table.year-1)) as previous_year"))->get();
        for ($i = 0 ; $i < count($data) ; $i++)
        {
            if(!$data[$i]->current_year || !$data[$i]->previous_year) {
                $data[$i]->value_display = 0;
                continue;
            }
            $average = ($data[$i]->current_year + $data[$i]->previous_year)/2;
            $data[$i]->value_display = $data[$i]->value_net_income_after_tax/($average)*100;
            if(!$data[$i]->previous_year)
            {
                $data[$i]->value_display = 0;
            }
        }
        return $data;
    }
    public function roaOfManyBankOnManyYears()
    {
        $banks = ['VCB','MBB','HDB','ACB'];
        $data = [];
        foreach ($banks as $bank)
        {
            $data[$bank] = $this->roaOfOneBankOnYears($bank);
        }
        $dataView['title'] = __("Chỉ số ROA của các ngân hàng qua các năm");
        $dataView['data'] = $data;
        $dataView['axis_y'] = __('Tỷ lệ chỉ số ROA');
        $dataView['suffix'] = __('%');
        return view('bank/Analytic/ChartLineManyCompanyOnManyYears',['dataView' => $dataView]);
    }
}
