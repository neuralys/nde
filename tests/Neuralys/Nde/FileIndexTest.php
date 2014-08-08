<?php

namespace Neuralys\Nde;

class FileIndexTest extends TestCase
{
    /**
     * @expectedException \UnexpectedValueException
     */
    public function testSignature()
    {
        $main = $this->locate('main.dat');
        $index = new FileIndex($main);
    }

    public function testNext()
    {
        $file = $this->locate('main.idx');
        $index = new FileIndex($file);

        $first = $index->next();
        $this->assertEquals(0, $first->index, 'bad first index');
        $this->assertEquals(8, $first->offset, 'bas first offset');

        $second = $index->next();
        $this->assertEquals(1, $second->index, 'bad second index');
        $this->assertEquals(1041, $second->offset, 'bas second offset');

        $index->close();
    }

    public function testReset()
    {
        $file = $this->locate('main.idx');
        $index = new FileIndex($file);

        $first = $index->next();
        $this->assertEquals(0, $first->index, 'bad first index');
        $this->assertEquals(8, $first->offset, 'bas first offset');

        $index->reset();

        $second = $index->next();
        $this->assertEquals(0, $second->index, 'bad index after reset');
        $this->assertEquals(8, $second->offset, 'bas offset after reset');

        $index->close();
    }

    public function testClose()
    {
        $file = $this->locate('main.idx');
        $index = new FileIndex($file);

        $index->close();
        $first = $index->next();
        $this->assertNull($first, 'index is not closed !');
    }
}
