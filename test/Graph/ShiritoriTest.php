<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Algorithm\Graph\Node;
use Algorithm\Graph\Edge;
use Algorithm\Shiritori\ShiritoriGraph;
use Algorithm\Shitiroti\Word;

class ShiritoriTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function しりとりができる() {
        $words = [
            "イアラ","ウェイト","オメガロ","ガルヒ","ガングリオンズ","クリオ",
            "ジェノバ","スノウガ","ズビズバ","スペシウム","タグアズ","ドドンパ",
            "トルネ","ネメシス","バイナリル","ハザード","パリピファイア","バルース",
            "ヒラケゴマ","フェイク","プリズマ","ホルーガ","マッハ","マホマホ","ムート",
            "ラリホフ","ランス","ループ","ロールウェイブ","ワロス"
        ];

        $shiritoriGraph = new ShiritoriGraph();
        foreach ($words as $word) {
            $shiritoriGraph->addWord($word);
        }
        $this->assertSame(
            'イアラ ランス スペシウム ムート トルネ ネメシス スノウガ ガルヒ ' .
            'ヒラケゴマ マホマホ ホルーガ ガングリオンズ ズビズバ バイナリル ' .
            'ループ プリズマ マッハ ハザード ドドンパ パリピファイア',
            $this->joinWords($shiritoriGraph->start()));
    }

    /**
     * @test
     */
    public function 長いしりとりができる() {
        $words = [
            "アークイース","アツモリ","アミュレ","イトゥルフ","イプス","エグゼ",
            "エンコーダ","カオマンガオ","カポテイ","ガリレア","ガルヒ","クーラ",
            "クサハエタ","グタカ","クリティカ","ケフィア","ザビエ","ジャグリ",
            "ズーバ","スーパーレイジ","スノウビーム","ズビズバ","スリッポン",
            "ダークレイ","タアモジヤ","チレイズ","ドドンパ","トマール","ドリオーレ",
            "ドルーグ","ドレインズ","ナディア","バイナリル","ハザード","バジリスク",
            "パブロイン","パラスク","バリーケ","パリピファイア","ヒラケゴマ","フィーバ",
            "プリズマ","ボムボム","ホルーガ","マッハ","マッハサンダ","マホマホ",
            "ムーブハンド","ムジュラック","メガテーン","ユバーガ","ラプソデイ",
            "ラプラスマ","リグレット","リフレム","ルービック","ループ","ルカナ",
            "レインボ","レルリ"];
        $shiritoriGraph = new ShiritoriGraph();
        foreach ($words as $word) {
            $shiritoriGraph->addWord($word);
        }
        $result = $shiritoriGraph->start();
        echo 'length: ' . count($result) . PHP_EOL;
        echo $this->joinWords($result);
    }

    public function joinWords($words) {
        $str = '';
        foreach($words as $word) {
            $str .= strval($word) . ' ';
        }
        return trim($str);
    }
}
