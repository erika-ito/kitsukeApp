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

    // 氏名（漢字）で検索した場合、条件に部分一致する講師データが取得できること
    public function testSearchKanjiGetPartialMatchMasters()
    {
        $keyword = urlencode('石');
        
        $response = $this->get("/kitsuke/masters?keyword=$keyword");

        $response->assertStatus(200);
        $response->assertViewIs('masters.index');
        $response->assertViewHas('masters', function($masters) {
            // ページネーション
            $this->assertEquals(2, $masters->total());
            $this->assertEquals(1, $masters->currentPage());
            $this->assertEquals(1, $masters->lastPage());
            $this->assertCount(2, $masters);

            // データ検証
            $actual1 = $masters->get(0);
            $this->assertEquals('5', $actual1->rank);
            $this->assertEquals('石井', $actual1->name);
            $this->assertEquals('いしい', $actual1->furigana);
            $this->assertEquals('111-1111', $actual1->zip_code);
            $this->assertEquals('東京都新宿区111-111', $actual1->address);
            $this->assertEquals('03-0000-0000', $actual1->home_phone);
            $this->assertEquals('abc@gmail.com', $actual1->mail);

            $actual2 = $masters->get(1);
            $this->assertEquals('5', $actual2->rank);
            $this->assertEquals('石橋', $actual2->name);
            $this->assertEquals('いしばし', $actual2->furigana);
            $this->assertEquals('111-1111', $actual2->zip_code);
            $this->assertEquals('東京都新宿区111-111', $actual2->address);
            $this->assertEquals('03-0000-0000', $actual2->home_phone);
            $this->assertEquals('abc@gmail.com', $actual2->mail);
            
            return true;
        });
    }
    
    // ふりがなで検索した場合、条件に部分一致する講師データが取得できること
    public function testSearchFuriganaGetPartialMatchMasters()
    {
        $keyword = urlencode('いし');
        
        $response = $this->get("/kitsuke/masters?keyword=$keyword");

        $response->assertStatus(200);
        $response->assertViewIs('masters.index');
        $response->assertViewHas('masters', function($masters) {
            // ページネーション
            $this->assertEquals(2, $masters->total());
            $this->assertEquals(1, $masters->currentPage());
            $this->assertEquals(1, $masters->lastPage());
            $this->assertCount(2, $masters);

            // データ検証
            $actual1 = $masters->get(0);
            $this->assertEquals('5', $actual1->rank);
            $this->assertEquals('石井', $actual1->name);
            $this->assertEquals('いしい', $actual1->furigana);
            $this->assertEquals('111-1111', $actual1->zip_code);
            $this->assertEquals('東京都新宿区111-111', $actual1->address);
            $this->assertEquals('03-0000-0000', $actual1->home_phone);
            $this->assertEquals('abc@gmail.com', $actual1->mail);

            $actual2 = $masters->get(1);
            $this->assertEquals('5', $actual2->rank);
            $this->assertEquals('石橋', $actual2->name);
            $this->assertEquals('いしばし', $actual2->furigana);
            $this->assertEquals('111-1111', $actual2->zip_code);
            $this->assertEquals('東京都新宿区111-111', $actual2->address);
            $this->assertEquals('03-0000-0000', $actual2->home_phone);
            $this->assertEquals('abc@gmail.com', $actual2->mail);
            
            return true;
        });
    }

    // 検索条件と合致するデータにない場合、講師データの取得がないこと
    public function testSearchNotMatchKeywordGetNoMasters()
    {
        $keyword = urlencode('あべ');
        
        $response = $this->get("/kitsuke/masters?keyword=$keyword");

        $response->assertStatus(200);
        $response->assertViewIs('masters.index');
        $response->assertViewHas('masters', function($masters) {
            // ページネーション
            $this->assertEquals(0, $masters->total());
            $this->assertEquals(1, $masters->currentPage());
            $this->assertEquals(1, $masters->lastPage());
            $this->assertCount(0, $masters);
            
            return true;
        });
    }
    
    // 検索条件がない場合、講師データが全件取得されること
    public function testSearchNoKeywordGetPartialMatchMasters()
    {
        $keyword = urlencode('');
        
        $response = $this->get("/kitsuke/masters?keyword=$keyword");

        $response->assertStatus(200);
        $response->assertViewIs('masters.index');
        $response->assertViewHas('masters', function($masters) {
            // ページネーション
            $this->assertEquals(3, $masters->total());
            $this->assertEquals(1, $masters->currentPage());
            $this->assertEquals(1, $masters->lastPage());
            $this->assertCount(3, $masters);

            // データ検証
            $actual1 = $masters->get(0);
            $this->assertEquals('5', $actual1->rank);
            $this->assertEquals('石井', $actual1->name);
            $this->assertEquals('いしい', $actual1->furigana);
            $this->assertEquals('111-1111', $actual1->zip_code);
            $this->assertEquals('東京都新宿区111-111', $actual1->address);
            $this->assertEquals('03-0000-0000', $actual1->home_phone);
            $this->assertEquals('abc@gmail.com', $actual1->mail);

            $actual2 = $masters->get(1);
            $this->assertEquals('5', $actual2->rank);
            $this->assertEquals('石橋', $actual2->name);
            $this->assertEquals('いしばし', $actual2->furigana);
            $this->assertEquals('111-1111', $actual2->zip_code);
            $this->assertEquals('東京都新宿区111-111', $actual2->address);
            $this->assertEquals('03-0000-0000', $actual2->home_phone);
            $this->assertEquals('abc@gmail.com', $actual2->mail);

            $actual3 = $masters->get(2);
            $this->assertEquals('5', $actual3->rank);
            $this->assertEquals('伊藤', $actual3->name);
            $this->assertEquals('いとう', $actual3->furigana);
            $this->assertEquals('111-1111', $actual3->zip_code);
            $this->assertEquals('東京都新宿区111-111', $actual3->address);
            $this->assertEquals('03-0000-0000', $actual3->home_phone);
            $this->assertEquals('abc@gmail.com', $actual3->mail);
            
            return true;
        });
    }

    // 新規登録が成功した場合、講師一覧画面へリダイレクトすること
    public function testCreateMasterSuccess()
    {
        // パラメータ
        $params = [
            'rank' => '5',
            'name' => '佐藤絵里香',
            'furigana' => 'さとうえりか',
            'zip_code' => '111-1111',
            'address' => '東京都新宿区111-111',
            'home_phone' => '03-0000-0000',
            'mail' => 'abc@gmail.com',
        ];

        $response = $this->post(route('masters.create'), $params);

        // 検証
        $response->assertStatus(302);
        $response->assertRedirect(route('masters.index'));
        $this->assertDatabaseHas('masters', [
            // 'id' => '4',
            'rank' => '5',
            'name' => '佐藤絵里香',
            'furigana' => 'さとうえりか',
            'zip_code' => '111-1111',
            'address' => '東京都新宿区111-111',
            'home_phone' => '03-0000-0000',
            'cell_phone' => null,
            'mail' => 'abc@gmail.com',
        ]);
    }
}
