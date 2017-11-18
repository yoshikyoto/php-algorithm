<?php
/*
 * main.php - 動作確認などをここで行う
 */

require_once __DIR__ . '/vendor/autoload.php';

/**
 * 入力された文字列を標準出力に出力する
 * @param string $str
 */
function println($str) {
    echo $str . PHP_EOL;
}
