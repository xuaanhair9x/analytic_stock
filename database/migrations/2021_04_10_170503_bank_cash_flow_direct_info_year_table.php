<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BankCashFlowDirectInfoYearTable extends Migration
{
    use \App\Http\Traits\ManageInfoTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableBankCashFlowDirectInfoYear, function (Blueprint $table) {
            $table->id();
            $table->string('company_code');
            $table->integer('company_vs_id');
            $table->integer('income_statement_id');
            $table->integer('report_norm_id');
            $table->integer('year');
            $table->bigInteger('value');
            $table->boolean('is_import')->default(false);
            $table->unique(array('company_code', 'report_norm_id','year'),'company_code_report_norm_id_year_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableBankCashFlowDirectInfoYear);
    }
}
