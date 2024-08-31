<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InfoDebitYearBank extends Migration
{
    use \App\Http\Traits\ManageInfoTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableBankInfoDebitYear, function (Blueprint $table) {
            $table->id();
            $table->string('company_code');
            $table->integer('debit_id');
            $table->integer('report_norm_id');
            $table->integer('year');
            $table->bigInteger('value');
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
        Schema::dropIfExists($this->tableBankInfoDebitYear);
    }
}
