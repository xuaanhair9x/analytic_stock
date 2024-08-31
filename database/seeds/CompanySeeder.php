<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert($this->dataCompany);
    }
    protected $dataCompany = array(
        array(
            'code' => 'MBB',
            'code_type_company' => 'bank',
            'name' => 'Ngân hàng TMCP Quân Đội',
            'name_en' => 'Military Commercial Joint Stock Bank',
            'company_vs_id' => 1190,
            'description' => ''
        ),
        array(
            'code' => 'HDB',
            'code_type_company' => 'bank',
            'name' => 'Ngân hàng TMCP Phát triển TPHCM',
            'name_en' => 'Ho Chi Minh City Development Joint Stock Commercial Bank',
            'company_vs_id' => 1195,
            'description' => ''
        ),
        array(
            'code' => 'VCB',
            'code_type_company' => 'bank',
            'name' => 'Ngân hàng TMCP Ngoại thương Việt Nam',
            'name_en' => 'Bank for Foreign Trade of Vietnam',
            'company_vs_id' => 1167,
            'description' => ''
        )
    );
}
