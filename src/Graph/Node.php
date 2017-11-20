<?php

namespace Algorithm\Graph;

class Node {
    private $id;

    /** @var Edge[] */
    private $outgoing = [];

    /** @var Edge[] */
    private $incoming = [];

    public function __construct($id) {
        $this->id = $id;
    }

    public function addOutgoing(Edge $outgoing) {
        $this->outgoing[] = $outgoing;
    }

    public function addIncoming(Edge $incoming) {
        $this->incoming = $incoming;
    }

    public function getIncoming() {
        return $this->incoming;
    }

    public function getOutgoing() {
        return $this->outgoing;
    }

    public function __toString() {
        return strval($this->id);
    }
}
