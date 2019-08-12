<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'connector_id' => '1',
                'name' => '伊藤絵里香',
                'furigana' => 'いとうえりか',
                'age' => '20',
                'height' => '160',
                'body_type' => '1',
            ],
            [
                'connector_id' => '1',
                'name' => '伊藤雪',
                'furigana' => 'いとうゆき',
                'age' => '20',
                'height' => '160',
                'body_type' => '1',
            ],
        ]);
    }
}
