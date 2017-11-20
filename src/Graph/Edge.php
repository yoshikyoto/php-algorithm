<?php

namespace Algorithm\Graph;

class Edge {
    /** @var Node */
    protected $from;

    /** @var Node */
    protected $to;

    public function __construct(Node $from, Node $to) {
        $this->from = $from;
        $this->to = $to;
    }

    public function setFrom(Node $node) {
        $this->node = $node;
    }

    public function getTo() {
        return $this->to;
    }

    public function setTo(Node $to) {
        $this->to = $to;
    }
}
