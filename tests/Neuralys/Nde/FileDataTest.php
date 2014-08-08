<?php

namespace Neuralys\Nde;

class FileDataTest extends TestCase
{
    /**
     * @expectedException \UnexpectedValueException
     */
    public function testSignature()
    {
        $main = $this->locate('main.idx');
        $index = new FileIndex($main);
        $data = new FileData($main, $index);
    }

    public function testNext()
    {
        $data = $this->getFileData();

        $first = $data->next();
        $this->assertEquals($this->firstRecord(), $first, 'Failed to read first record');

        $second = $data->next();
        $this->assertEquals($this->secondRecord(), $second, 'Failed to read second record');

        $data->close();
    }

    public function testReset()
    {
        $data = $this->getFileData();

        $first = $data->next();
        $this->assertEquals($this->firstRecord(), $first, 'Failed to read first record');

        $data->reset();

        $second = $data->next();
        $this->assertEquals($this->firstRecord(), $second, 'Failed to reset and re-read first record');

        $data->close();
    }

    public function testClose()
    {
        $data = $this->getFileData();
        $data->close();

        $first = $data->next();
        $this->assertNull( $first, 'data file is not closed !');
    }

    private function getFileData()
    {
        $file = $this->locate('main.idx');
        $index = new FileIndex($file);

        $file = $this->locate('main.dat');
        return new FileData($file, $index);
    }
}
