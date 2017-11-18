<?php

/**
 * keyに対するvalueの値をカウントするクラス
 */
class CountMap {
    private $map = [];

    /**
     * keyに対する値を取得する
     * @param $key
     * @return int
     */
    public function get($key) {
        if(array_key_exists($key, $this->map)) {
            return $this->map[$key];
        } else {
            return 0;
        }
    }

    /**
     * keyと値のペアをPHPのarrayで取得
     * @return array
     */
    public function getAsArray() {
        return $this->map;
    }

    /**
     * keyに対する値を加算する
     * @param mixed $key
     * @param int $value 指定しない場合は1加算
     */
    public function add($key, $value = 1) {
        if(array_key_exists($key, $this->map)) {
            $this->map[$key] += $value;
        } else {
            $this->map[$key] = $value;
        }
    }
}
