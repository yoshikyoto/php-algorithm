<?php

/**
 * 入力された文字列を標準出力に出力する
 * @param string $str
 */
function println($str) {
    echo $str . PHP_EOL;
}

$field = [
    [-1,1,-1,1,1,-1,-1,1,-1,1],
    [-1,0,-1,-1,-1,1,1,1,-1,-1],
    [1,-1,-1,-1,1,-1,-1,-1,-1,-1],
    [-1,1,1,-1,-1,-1,1,1,-1,1],
    [-1,1,-1,1,1,-1,-1,-1,-1,1],
    [-1,-1,1,-1,-1,-1,1,1,-1,-1],
    [1,-1,1,-1,-1,-1,-1,1,-1,-1],
    [1,-1,-1,-1,1,1,-1,-1,1,1],
    [-1,1,1,-1,-1,1,-1,-1,0,1],
    [-1,-1,-1,-1,1,-1,1,-1,1,-1]
];

/** 今の状態を表すクラス */
class State {
    public $x, $y, $life, $field, $history;
    public function __construct($x, $y, $life, $field, $history) {
        $this->x = $x;
        $this->y = $y;
        $this->life = $life;
        $this->field = $field;
        $this->history = $history;
    }
}

$q = new SplPriorityQueue();
/** priority queue に $state を挿入する */
function insert($state) {
    if($state->life < 35) return;
    if((35 + (count($state->history) / 5)) > $state->life) return;
    global $q;
    $q->insert($state, $state->life);
}

// 初期状態を挿入
insert(new State(1, 1, 36, $field, []));

// 探索
while($q->count() > 0) {
    $state = $q->extract();
    $x = $state->x;
    $y = $state->y;
    $field = $state->field;
    $history = $state->history;
    $life = $state->life;
    /** @var 今のフィールドが何か */
    $now = $field[$y][$x];

    // ゴールだったら終了
    if($now === "G") {
        if($life >= 50) {
            // クリアなので結果を出力
            var_dump($history);
            exit;
        }
        if($life >= 48) {
            // 惜しい！一応結果を出力しておく
            // 探索がちゃんと動いているっぽいことの目安
            echo 'goal life: ' . $life . PHP_EOL;
        }
        continue;
    }

    // 既に通った場所、あるいは幽霊の場合はNG
    if($now === "#" || $now === "L") {
        continue;
    }

    // ゴール、幽霊、既に通った後、スタート以外のマスは数字マス
    if($now !== "S") {
        $life += $now;
    }

    // デバッグ出力
    echo count($history) . "\t(" . $x . ',' . $y . ")\t" . $life . "\n";

    // 通ったことにする
    $field[$y][$x] = "#";

    // 右に進むケース
    if($x < 9) {
        $history[] = '右';
        insert(new State($x+1, $y, $life, $field, $history));
        array_pop($history);
    }

    // 下に進むケース
    if($y < 9) {
        $history[] = '下';
        insert(new State($x, $y+1, $life, $field, $history));
        array_pop($history);
    }

    // 上に進むケース
    if(0 < $x) {
        $history[] = '左';
        insert(new State($x-1, $y, $life, $field, $history));
        array_pop($history);
    }

    // 下に進むケース
    if(0 < $y) {
        $history[] = '上';
        insert(new State($x, $y-1, $life, $field, $history));
        array_pop($history);
    }
}
