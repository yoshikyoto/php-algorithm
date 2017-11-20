<?php

namespace Algorithm\Graph;

class Graph {
    protected $nodes = [];
    protected $edges = [];

    public function createNodeIfNotExists($id) {
        if(isset($this->nodes[$id])) {
            return $this->nodes[$id];
        }
        $node = new Node($id);
        $this->nodes[$id] = $node;
        return $node;
    }

    public function addEdge(Edge $edge) {
        // TODO 重複とか起こさないようにする
        $this->edges[] = $edge;
    }

    public function getNodes() {
        return $this->nodes;
    }

    public function getEdges() {
        return $this->edges;
    }
}
