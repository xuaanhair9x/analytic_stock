<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BankCashFlowDirect extends Migration
{
    use \App\Http\Traits\ManageInfoTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableBankCashFlowDirect, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en');
            $table->integer('report_norm_id')->unique();
            $table->integer('parent_report_norm_id');
            $table->string('index');
            $table->string('note');
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
        Schema::dropIfExists($this->tableBankCashFlowDirect);
    }
}
