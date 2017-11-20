<?php

$queue = new SplPriorityQueue();

$queue->insert('Hoge', 1);
$queue->insert('Fuga', 3);
$queue->insert('Piyo', 2);

while(!$queue->isEmpty()) {
    var_dump($queue->extract());
}
