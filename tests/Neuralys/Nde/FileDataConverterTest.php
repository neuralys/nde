<?php

namespace Neuralys\Nde;

class FileDataConverterTest extends TestCase
{
    public function testConvertUnknown()
    {
        $file = $this->locate('unknown_field.dat');
        $value = $this->convert($file);
        $this->assertEmpty($value);
    }

    public function testConvertColumn()
    {
        $file = $this->locate('column_album.dat');
        $value = $this->convert($file);

        $this->assertEquals('album', $value);
    }

    public function testConvertIndex()
    {
        $file = $this->locate('index_None.dat');
        $value = $this->convert($file);
        $this->assertEquals('None', $value);
    }

    public function testConvertDateTime()
    {
        $file = $this->locate('datetime_04052014152034.dat');
        $value = $this->convert($file);
        $this->assertEquals('04/05/2014 15:20:34', $value);
    }

    public function testConvertFilename()
    {
        $file = $this->locate('filename_BabyBaby.dat');
        $value = $this->convert($file);
        $this->assertEquals('D:\Music\01 - Baby Baby.mp3', $value);
    }

    public function testConvertInteger()
    {
        $file = $this->locate('integer_112.dat');
        $value = $this->convert($file);
        $this->assertEquals(112, $value);
    }

    public function testConvertLength()
    {
        $file = $this->locate('length_223.dat');
        $value = $this->convert($file);
        $this->assertEquals(223, $value);
    }

    public function testConvertString()
    {
        $file = $this->locate('string_Corona.dat');
        $value = $this->convert($file);
        $this->assertEquals('Corona', $value);
    }

    public function testConvertLong()
    {
        $file = $this->locate('long_3589065.dat');
        $value = $this->convert($file);
        $this->assertEquals(3589065, $value);
    }

    /**
     * @param $filename
     *
     * @return Field
     */
    private function convert($filename)
    {
        $reader = new FieldDataReader();
        $data = file_get_contents($filename);
        $field = $reader->read($data);
        $converter = new FieldConverter();

        return $converter->convert($field);
    }

}
