<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Algorithm\Shiritori\Word;

class WordTest extends \PHPUnit_Framework_TestCase {

    public function test() {
        $word = new Word('あいうえお');
        $this->assertSame('あ', $word->getFirst());
        $this->assertSame('お', $word->getLast());
    }

}
