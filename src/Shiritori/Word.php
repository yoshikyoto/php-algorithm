<?php

namespace Algorithm\Shiritori;

class Word {
    private $str;
    private $first;
    private $last;

    public function __construct($str) {
        $this->str = $str;
        $this->first = mb_substr($str, 0, 1);
        $this->last = mb_substr($str, mb_strlen($str) - 1, 1);
    }

    public function __toString() {
        return $str;
    }

    public function getFirst() {
        return $this->first;
    }

    public function getLast() {
        return $this->last;
    }
}