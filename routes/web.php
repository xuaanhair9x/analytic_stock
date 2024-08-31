<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('HomePage');
});

Route::get('/bank/analytic/loan_customer',
[
    'as' => 'loan_customer',
    'uses' => 'Bank\AnalyticController@LoanCustomer'
]);
Route::get('/bank/analytic/net_income_after_tax_many_company_on_one_year',
[
    'as' => 'net_income_after_tax_many_company_on_one_year',
    'uses' => 'Bank\AnalyticController@netIncomeAfterTaxManyComanyOnOneYear'
]);
Route::get('/bank/analytic/non_interest_income_and_income_from_service',
[
    'as' => 'non_interest_income_and_income_from_service',
    'uses' => 'Bank\AnalyticController@NonInterestIncomeAndIncomeFromService'
]);
Route::get('/bank/analytic/nim_of_many_company_on_many_year',
[
    'as' => 'nim_of_many_company_on_many_year',
    'uses' => 'Bank\AnalyticController@nimOfManyBankOnManyYears'
]);
Route::get('/bank/analytic/roe_of_many_company_on_many_year',
    [
        'as' => 'roe_of_many_company_on_many_year',
        'uses' => 'Bank\AnalyticController@roeOfManyBankOnManyYears'
    ]);
Route::get('/bank/analytic/roa_of_many_company_on_many_year',
    [
        'as' => 'roa_of_many_company_on_many_year',
        'uses' => 'Bank\AnalyticController@roaOfManyBankOnManyYears'
    ]);

Route::get('/bank/analytic/cost_to_income_ratio',
[
    'as' => 'cost_to_income_ratio',
    'uses' => 'Bank\AnalyticController@costToIncomeRatio'
]);
Route::get('/bank/analytic/net_interest_income_and_increasement',
[
    'as' => 'net_interest_income_and_increasement',
    'uses' => 'Bank\AnalyticController@NetInterestIncomeAndIncreasement'
]);
Route::get('/bank/analytic/net_profit_after_tax_and_increasement',
[
    'as' => 'net_profit_after_tax_and_increasement',
    'uses' => 'Bank\AnalyticController@NetProfitAfterTaxAndIncreasement'
]);
Route::get('/bank/analytic/increase_loan_customer',
[
    'as' => 'increase_loan_customer',
    'uses' => 'Bank\AnalyticController@increaseLoanCustomer'
]);
Route::get('/bank/analytic/contingency_cost_ratio',
    [
        'as' => 'contingency_cost_ratio',
        'uses' => 'Bank\AnalyticController@contingencyCostRatio'
    ]);
Route::get('/bank/analytic/contingency_cost',
    [
        'as' => 'contingency_cost',
        'uses' => 'Bank\AnalyticController@contingencyCost'
    ]);
Route::get('/bank/analytic/deposits_from_customer_and_casa',
    [
        'as' => 'deposits_from_customer_and_casa',
        'uses' => 'Bank\AnalyticController@depositsFromCustomerAndCasa'
    ]);

Route::get('/bank/analytic/casa_ratio',
    [
        'as' => 'casa_ratio',
        'uses' => 'Bank\AnalyticController@casaRatio'
    ]);
Route::get('/bank/analytic/loan_to_deposit',
    [
        'as' => 'loan_to_deposit',
        'uses' => 'Bank\AnalyticController@LoanToDeposit'
    ]);
Route::get('/bank/analytic/bad_debt_bank_ratio',
    [
        'as' => 'bad_debt_bank_ratio',
        'uses' => 'Bank\AnalyticController@badDebtBankRatio'
    ]);

Route::get('/bank/analytic/deposits_from_customer_ratio',
    [
        'as' => 'deposits_from_customer_ratio',
        'uses' => 'Bank\AnalyticController@depositsFromCustomerRatio'
    ]);

Route::get('/bank/analytic/loan_of_bank_by_years',
    [
        'as' => 'loan_of_bank_by_years',
        'uses' =>  'Bank\AnalyticController@LoanOfBankByYears'
    ]);
Route::get('/bank/analytic/loan_of_bank_by_banks',
    [
        'as' => 'loan_of_bank_by_banks',
        'uses' =>  'Bank\AnalyticController@LoanOfBankByBanks'
    ]);


Route::get('/bank/balancesheet',
    [
        'as' => 'balance_sheet',
        'uses' =>  'Bank\BalanceSheetController@showAllIndicator'
    ]);
Route::get('/bank/cashflow',
    [
        'as' => 'cash_flow',
        'uses' => 'Bank\CashFlowDirectController@showAllIndicator'
    ]);
Route::get('/bank/incomestatement',
    [
        'as' => 'income_statement',
        'uses' => 'Bank\IncomeStatementController@showAllIndicator'
    ]);


Route::get('/bank/balancesheetinfoyear',
    [
        'as' => 'balance_sheet_info_year',
        'uses' =>  'Bank\BalanceSheetController@showAllIndicatorIncludeInfo'
    ]);
Route::get('/bank/cashflowinfoyear',
    [
        'as' => 'cash_flow_info_year',
        'uses' =>  'Bank\CashFlowDirectController@showAllIndicatorIncludeInfo'
    ]);
Route::get('/bank/incomestatementinfoyear',
    [
        'as' => 'income_statement_info_year',
        'uses' =>  'Bank\IncomeStatementController@showAllIndicatorIncludeInfo'
    ]);

Route::get('/bank/balance_sheet/add/child_indicator/{id}','Bank\BalanceSheetController@addChildIndicator');
Route::get('/bank/cash_flow/add/child_indicator/{id}','Bank\CashFlowDirectController@addChildIndicator');
Route::get('/bank/income_statement/add/child_indicator/{id}','Bank\IncomeStatementController@addChildIndicator');


Route::get('/bank/balance_sheet/edit/indicator/{id}','Bank\BalanceSheetController@editChildIndicator');
Route::get('/bank/cash_flow/edit/indicator/{id}','Bank\CashFlowDirectController@editChildIndicator');
Route::get('/bank/income_statement/edit/indicator/{id}','Bank\IncomeStatementController@editChildIndicator');


Route::post('/bank/balance_sheet/save/child_indicator',[
    'as'=>'save_child_indicator_balance_sheet',
    'uses'=>'Bank\BalanceSheetController@saveIndicator'
]);
Route::post('/bank/cash_flow/save/child_indicator',[
    'as'=>'save_child_indicator_cash_flow',
    'uses'=>'Bank\CashFlowDirectController@saveIndicator'
]);
Route::post('/bank/income_statement/save/child_indicator',[
    'as'=>'save_child_indicator_income_statement',
    'uses'=>'Bank\IncomeStatementController@saveIndicator'
]);



Route::get('/bank/add/indicator_info/{code}/{id}',
    [
        'as' => 'add_indicator_info',
        'uses' => 'Bank\BalanceSheetController@addIndicatorInfo'
    ]);
Route::get('/bank/add/indicator_info/{id_indicator_info}',
    [
        'as' => 'edit_indicator_info',
        'uses' => 'Bank\BalanceSheetController@editIndicatorInfo'
    ]);
Route::post('/bank/save/indicator_info',[
    'as'=>'save_indicator_info',
    'uses'=>'Bank\BalanceSheetController@saveIndicatorInfo'
]);



/**
 * Debt structure.
 */
Route::get('debt_structure_main_page', function () {
    return view('DebtStructure');
});




Route::get('debt_structure_for_each_bank','DebtStructure@EachBank');
Route::get('debt_structure_for_multiple_bank','DebtStructure@MultipleBank');
Route::get('increase_debit_customer','DebtStructure@IncreaseDebitCustomer');
Route::get('ratio_increase_debt_for_each_bank','DebtStructure@ratioIncreaseDebtForEachBank');

/**
 * Router type company.
 */
Route::get('list_type_company', 'TypeCompanyController@TypeCompanyListing');
Route::get('add_type_company', 'TypeCompanyController@addTypeCompany');
Route::get('edit_type_company/{id}', 'TypeCompanyController@EditTypeCompany');
Route::post('save_type_company',[
    'as'=>'save_type_company',
    'uses'=>'TypeCompanyController@submitForm'
]);

/**
 * Router company.
 */
Route::get('list_company', 'CompanyController@CompanyListing');
Route::get('add_company', 'CompanyController@addCompany');
Route::get('edit_company/{id}',    'CompanyController@editCompany');
Route::post('save_company',[
    'as'=>'save_company',
    'uses'=>'CompanyController@saveData'
]);

/**
 * Router income statement.
 */
Route::get('income_statements_listing', 'IncomeStatementsController@IncomeStatementsListing');
Route::get('add_income_statements', 'IncomeStatementsController@addIncomeStatements');
Route::get('edit_income_statements/{id}', 'IncomeStatementsController@editIncomeStatements');
Route::post('save_data_income_statements',[
    'as'=>'save_data_income_statements',
    'uses'=>'IncomeStatementsController@saveData'
]);

/**
 * Router income statement info year.
 */
Route::get('income_statements_info_year_listing', 'IncomeStatementsInfoYearController@IncomeStatementsInfoYearListing');
Route::get('add_income_statements_info_year', 'IncomeStatementsInfoYearController@addIncomeStatementsInfoYear');
Route::get('edit_income_statements_info_year/{id}', 'IncomeStatementsInfoYearController@editIncomeStatementsInfoYear');
Route::post('save_data_income_statements_info_year',[
    'as'=>'save_data_income_statements_info_year',
    'uses'=>'IncomeStatementsInfoYearController@saveData'
]);
