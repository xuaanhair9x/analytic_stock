<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Api\Bank\AnalyticController;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/roa_of_many_bank_on_many_years',[AnalyticController::class,'roaOfManyBankOnManyYears']);
Route::post('/nim_of_many_company_on_many_year',[AnalyticController::class,'nimOfManyBankOnManyYears']);
Route::post('/roe_of_many_bank_on_many_years',[AnalyticController::class,'roeOfManyBankOnManyYears']);
Route::post('/non_interest_income_and_income_from_service',[AnalyticController::class,'NonInterestIncomeAndIncomeFromService']);
Route::post('/net_income_after_tax_many_company_on_one_year',[AnalyticController::class,'netIncomeAfterTaxManyComanyOnOneYear']);
Route::post('/cost_to_income_ratio',[AnalyticController::class,'costToIncomeRatio']);
Route::post('/net_profit_after_tax_and_increasement',[AnalyticController::class,'NetProfitAfterTaxAndIncreasement']);
Route::post('/net_interest_income_and_increasement',[AnalyticController::class,'NetInterestIncomeAndIncreasement']);
Route::post('/loan_to_deposit',[AnalyticController::class,'LoanToDeposit']);
Route::post('/increase_loan_customer',[AnalyticController::class,'increaseLoanCustomer']);
Route::post('/loan_customer',[AnalyticController::class,'LoanCustomer']);
Route::post('/contingency_cost',[AnalyticController::class,'contingencyCost']);
Route::post('/casa_ratio',[AnalyticController::class,'casaRatio']);
Route::post('/deposits_from_customer_ratio',[AnalyticController::class,'depositsFromCustomerRatio']);
Route::post('/deposits_from_customer_and_casa',[AnalyticController::class,'depositsFromCustomerAndCasa']);
Route::post('/contingency_cost_ratio',[AnalyticController::class,'contingencyCostRatio']);
Route::post('/loan_of_bank_by_years',[AnalyticController::class,'LoanOfBankByYears']);
Route::post('/loan_of_bank_by_banks',[AnalyticController::class,'LoanOfBankByBanks']);
Route::post('/bad_debt_bank_ratio',[AnalyticController::class,'badDebtBankRatio']);
