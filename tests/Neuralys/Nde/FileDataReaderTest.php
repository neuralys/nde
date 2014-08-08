<?php

namespace Neuralys\Nde;

class FileDataReaderTest extends TestCase
{
    public function testReadColumn()
    {
        $file = $this->locate('column_album.dat');
        $field = $this->read($file);

        $this->assertEquals(Field::COLUMN, $field->type);
    }

    public function testReadIndex()
    {
        $file = $this->locate('index_None.dat');
        $field = $this->read($file);

        $this->assertEquals(Field::INDEX, $field->type);
    }

    public function testReadDateTime()
    {
        $file = $this->locate('datetime_04052014152034.dat');
        $field = $this->read($file);

        $this->assertEquals(Field::DATETIME, $field->type);
    }

    public function testReadFilename()
    {
        $file = $this->locate('filename_BabyBaby.dat');
        $field = $this->read($file);

        $this->assertEquals(Field::FILENAME, $field->type);
    }

    public function testReadInteger()
    {
        $file = $this->locate('integer_112.dat');
        $field = $this->read($file);

        $this->assertEquals(Field::INTEGER, $field->type);
    }

    public function testReadLength()
    {
        $file = $this->locate('length_223.dat');
        $field = $this->read($file);

        $this->assertEquals(Field::LENGTH, $field->type);
    }

    public function testReadString()
    {
        $file = $this->locate('string_Corona.dat');
        $field = $this->read($file);

        $this->assertEquals(Field::STRING, $field->type);
    }

    public function testReadLong()
    {
        $file = $this->locate('long_3589065.dat');
        $field = $this->read($file);

        $this->assertEquals(Field::LONG, $field->type);
    }

    /**
     * @param $filename
     *
     * @return Field
     */
    private function read($filename)
    {
        $reader = new FieldDataReader();
        $data = file_get_contents($filename);

        return $reader->read($data);
    }

}
