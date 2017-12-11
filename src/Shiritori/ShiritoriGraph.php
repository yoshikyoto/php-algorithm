<?php

namespace Algorithm\Shiritori;

use Algorithm\Graph\Graph;
use Algorithm\Graph\Node;

class ShiritoriGraph extends Graph {

    public function addWord($str) {
        $word = new Word($str);
        $from = $this->createNodeIfNotExists($word->getFirst());
        $to = $this->createNodeIfNotExists($word->getLast());
        $word->setFrom($from);
        $word->setTo($to);
        $from->addOutgoing($word);
        $to->addIncoming($word);
        $this->addEdge($word);
        return $word;
    }

    public function start() {
        $longest = [];
        foreach($this->getNodes() as $start) {
            echo $start . PHP_EOL;
            $words = $this->dfs($start);
            if(count($words) > count($longest)) {
                $longest = $words;
            }
        }
        return $longest;
    }

    private $count = 0;

    public function dfs($node = null, $history = []) {
        $longest = [];
        $candidates = $this->getCandidateWords($node);
        foreach($candidates as $word) {
            $word->used();
            $history[] = $word;
            if(count($history) > 39) {
                echo $this->joinWords($history) . "\t" . count($history) . PHP_EOL;
            }
            $words = array_merge([$word], $this->dfs($word->getTo(), $history));
            $word->unused();
            array_pop($history);
            if(count($words) > count($longest)) {
                $longest = $words;
            }
        }
        return $longest;
    }

    public function getCandidateWords(Node $node) {
        return array_values(array_filter($node->getOutgoing(), function($word) {
            return !$word->isUsed();
        }));
    }

    public function joinWords($words) {
        $str = '';
        foreach($words as $word) {
            $str .= strval($word) . ' ';
        }
        return trim($str);
    }

}
