<?php

namespace Neuralys\Nde;

class IndexDataTest extends TestCase
{
    public function testConstuctor()
    {
        $i = new IndexData(100, 200);

        $this->assertEquals(100, $i->index, 'index value seems wrong');
        $this->assertEquals(200, $i->offset, 'offset value seems wrong');
    }
}