<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Master;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MasterTest extends TestCase
{
    use RefreshDatabase;

    // テスト前処理
    public function setUp():void
    {
        parent::setUp();
        $this->seed('MasterTestSeeder');
    }

    // 検索一致の場合
    public function testMatch()
    {
        $response = $this->get('/kitsuke/masters', [
            'keyword' => 'いと',
        ]);

        $response->assertViewHas('name', '石橋');
        // $response->assertSee('石橋');
        // var_dump($response);
    }

    // 検索不一致の場合
    // public function testNotMatch()
    // {
        
    // }

    // 検索キーワードがない場合
    // public function testNoKeyword()
    // {
        
    // }
}
