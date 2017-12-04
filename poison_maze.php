<?php
/*
 * main.php - 動作確認などをここで行う
 */

require_once __DIR__ . '/vendor/autoload.php';

$field = [
    [-1,1,1,-1,-1,1,1,-1,-1,1],
    [1,"S",1,"L",-1,-1,-1,-1,-1,-1],
    [-1,-1,-1,1,1,-1,1,-1,1,1],
    [1,"L",-1,-1,1,-1,1,-1,1,-1],
    [-1,1,1,-1,-1,-1,-1,"L",1,-1],
    [1,-1,1,-1,-1,1,-1,1,-1,1],
    [-1,"L",-1,-1,-1,1,-1,-1,-1,1],
    [-1,1,-1,1,1,-1,1,-1,-1,-1],
    [-1,1,-1,-1,-1,1,1,-1,"G",1],
    [-1,-1,1,1,-1,-1,-1,1,-1,-1]
];

$field = [
    [-1,1,"R",1,1,-1,-1,1,-1,1],
    [-1,0,-1,-1,-1,"R",1,1,-1,-1],
    [1,-1,-1,-1,1,-1,-1,-1,"R",-1],
    [-1,1,1,-1,-1,-1,1,"R",-1,1],
    [-1,1,-1,1,"R",-1,-1,-1,-1,1],
    [-1,-1,1,-1,-1,"R",1,1,-1,-1],
    [1,-1,1,-1,-1,-1,"R",1,-1,-1],
    [1,-1,-1,-1,1,"R",-1,-1,1,1],
    [-1,1,1,-1,-1,1,-1,-1,"G",1],
    [-1,-1,-1,-1,1,-1,1,-1,1,-1]
]
       /**
          [[-1,1,-1,1,1,-1,-1,1,-1,1],[-1,0,-1,-1,-1,1,1,1,-1,-1],[1,-1,-1,-1,1,-1,-1,-1,-1,-1],[-1,1,1,-1,-1,-1,1,1,-1,1],[-1,1,-1,1,1,-1,-1,-1,-1,1],[-1,-1,1,-1,-1,-1,1,1,-1,-1],[1,-1,1,-1,-1,-1,-1,1,-1,-1],[1,-1,-1,-1,1,1,-1,-1,1,1],[-1,1,1,-1,-1,1,-1,-1,0,1],[-1,-1,-1,-1,1,-1,1,-1,1,-1]]**/

//dfs(1, 1, 36, $field, [], [36, 36, 36]);

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

class PQ extends SplPriorityQueue {
    public function compare($priority1, $priority2) {
        if($priority1 === $priority2) return 0;
        $priority1 > $priority2 ? -1 : 1;
    }
}

$q = new SplPriorityQueue();
function insert($state) {
    if($state->life < 35) return;
    if((35 + (count($state->history) / 5)) > $state->life) return;
    global $q;
    $q->insert($state, $state->life);
}
insert(new State(1, 1, 36, $field, []));

/*
function dfs($x, $y, $life, $field, $history, $lifes) {
*/
while($q->count() > 0) {
    $state = $q->extract();
    $x = $state->x;
    $y = $state->y;
    $field = $state->field;
    $history = $state->history;
    $life = $state->life;
    $now = $field[$y][$x];
    if($now === "G") {
        if($life >= 50) {
            var_dump($history);
            exit;
        }
        if($life >= 48) {
            echo 'goal life: ' . $life . PHP_EOL;
        }
        continue;
    }
    if($now === "#" || $now === "L") {
        continue;
    }
    if($now !== "S") {
        $life += $now;
    }
    echo count($history) . "\t(" . $x . ',' . $y . ")\t" . $life . "\n";

    $field[$y][$x] = "#";

    if($x < 9) {
        $history[] = '右';
        insert(new State($x+1, $y, $life, $field, $history));
        array_pop($history);
    }

    if($y < 9) {
        $history[] = '下';
        insert(new State($x, $y+1, $life, $field, $history));
        array_pop($history);
    }

    if(0 < $x) {
        $history[] = '左';
        insert(new State($x-1, $y, $life, $field, $history));
        array_pop($history);
    }

    if(0 < $y) {
        $history[] = '上';
        insert(new State($x, $y-1, $life, $field, $history));
        array_pop($history);
    }


    /*
    if($x < 9 && ($field[$y][$x+1] === 1 || $field[$y][$x+1] === "G")) {
        $history[] = '右';
        insert(new State($x+1, $y, $life, $field, $history));
        array_pop($history);
    }

    if($y < 9 && ($field[$y+1][$x] === 1 || $field[$y+1][$x] === "G")) {
        $history[] = '下';
        insert(new State($x, $y+1, $life, $field, $history));
        array_pop($history);
    }

    if(0 < $x && ($field[$y][$x-1] === 1 || $field[$y][$x-1] === "G")) {
        $history[] = '左';
        insert(new State($x-1, $y, $life, $field, $history));
        array_pop($history);
    }

    if(0 < $y && ($field[$y-1][$x] === 1 || $field[$y-1][$x] === "G")) {
        $history[] = '上';
        insert(new State($x, $y-1, $life, $field, $history));
        array_pop($history);
    }




    if($x < 9 && $field[$y][$x+1] === -1) {
        $history[] = '右';
        insert(new State($x+1, $y, $life, $field, $history));
        array_pop($history);
    }

    if($y < 9 && $field[$y+1][$x] === -1) {
        $history[] = '下';
        insert(new State($x, $y+1, $life, $field, $history));
        array_pop($history);
    }


    if(0 < $x && $field[$y][$x-1] === -1) {
        $history[] = '左';
        insert(new State($x-1, $y, $life, $field, $history));
        array_pop($history);
    }

    if(0 < $y && $field[$y-1][$x] === -1) {
        $history[] = '上';
        insert(new State($x, $y-1, $life, $field, $history));
        array_pop($history);
    }
    */
}
/**
 * 入力された文字列を標準出力に出力する
 * @param string $str
 */
function println($str) {
    echo $str . PHP_EOL;
}
