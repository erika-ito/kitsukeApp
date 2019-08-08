<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MasterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    // テスト前処理
    public function setUp()
    {
        parent::setUp();
        $this->seed('MasterTestSeeder');
    }

    // 検索一致の場合
    public function testMatch()
    {
        $keyword = 'いし';

        $response = 

        $response->assertViewIs('masters.index');
        $response->assertViewHas('いしばし');
    }

    // 検索不一致の場合
    public function testNotMatch()
    {
        
    }

    // 検索キーワードがない場合
    public function testNoKeyword()
    {
        
    }
}
