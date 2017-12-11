<?php

namespace Algorithm\Shiritori;

use Algorithm\Graph\Edge;

class Word extends Edge {
    private $str;
    private $first;
    private $last;
    private $isUsed;

    public function __construct($str) {
        $this->str = $str;
        $this->first = mb_substr($str, 0, 1);
        $this->last = mb_substr($str, mb_strlen($str) - 1, 1);
    }

    public function __toString() {
        return $this->str;
    }

    public function getFirst() {
        return $this->first;
    }

    public function getLast() {
        return $this->last;
    }

    public function isUsed() {
        return $this->isUsed;
    }

    public function used() {
        return $this->isUsed = true;
    }

    public function unused() {
        return $this->isUsed = false;
    }
}
