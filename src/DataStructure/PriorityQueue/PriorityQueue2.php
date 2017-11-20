<?php

class MyPriorityQueue extends SplPriorityQueue {
    public function compare($priority1, $priority2) {
        if($priority1 === $priority2) return 0;
        $priority1 < $priority2 ? -1 : 1;
    }
}

$queue = new MyPriorityQueue();

$queue->insert('Hoge', 1);
$queue->insert('Fuga', 3);
$queue->insert('Piyo', 2);

while(!$queue->isEmpty()) {
    var_dump($queue->extract());
}
