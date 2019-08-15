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
        $response = $this->get('/kitsuke/masters?keyword=いし');

        $response->assertViewHas('masters', function($masters) {
            
            // $master_names = ['石橋', '石井'];
            return $masters->contains('name', '石橋');
        });
    }

    // 検索不一致の場合
    public function testNotMatch()
    {
        $response = $this->get('/kitsuke/masters?keyword=あべ');

        $response->assertViewHas('masters', function($masters) {
            return $masters->isEmpty();
        });
    }

    // 検索キーワードがない場合
    public function testNoKeyword()
    {
        $response = $this->get('/kitsuke/masters');

        $response->assertViewHas('masters', function($masters) {
            return $masters->contains('name', '伊藤');
        });
    }

    // public function testPractice()
    // {
        // $collection = collect([
        //     [
        //         'id' => 1,
        //         'name' => 'たろう',
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'じろう',
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'さぶろう',
        //     ],
        // ]);

        //     echo $collection->contains('name','さぶろう');

        // $collection->each(function ($item) {
        //     echo $item['name'];
        // });

        // $this->assertTrue(true);
    // }
}
