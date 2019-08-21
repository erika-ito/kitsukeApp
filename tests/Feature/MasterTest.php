<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Master;
use Carbon\Carbon;
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
        $keyword = urlencode('いし');

        $expected = [
            [
                'rank' => '5',
                'name' => '石橋',
                'furigana' => 'いしばし',
                'zip_code' => '111-1111',
                'address' => '東京都新宿区111-111',
                'home_phone' => '03-0000-0000',
                'mail' => 'abc@gmail.com',
                // 'created_at' => Carbon::now(),
                // 'updated_at' => Carbon::now(),
            ],
            [
                'rank' => '5',
                'name' => '石井',
                'furigana' => 'いしい',
                'zip_code' => '111-1111',
                'address' => '東京都新宿区111-111',
                'home_phone' => '03-0000-0000',
                'mail' => 'abc@gmail.com',
                // 'created_at' => Carbon::now(),
                // 'updated_at' => Carbon::now(),
            ],
        ];
        
        $response = $this->get('/kitsuke/masters?keyword=$keyword');

        $response->assertStatus(200);
        $response->assertViewIs('masters.index');
        $response->assertViewHas('masters', $expected);
    }

    // 検索不一致の場合
    // public function testNotMatch()
    // {
    //     $response = $this->get('/kitsuke/masters?keyword=あべ');

    //     $response->assertViewHas('masters', function($masters) {
    //         return $masters->isEmpty();
    //     });
    // }

    // 検索キーワードがない場合
    // public function testNoKeyword()
    // {
    //     $response = $this->get('/kitsuke/masters');

    //     $response->assertViewHas('masters', function($masters) {
    //         return $masters->contains('name', '伊藤');
    //     });
    // }

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
