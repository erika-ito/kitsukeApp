<?php

use App\Connector;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConnectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Connector::class, 10)->create();
    }
}
