<?php

namespace Neuralys\Nde;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function getFixturesPath()
    {
        return __DIR__.'/../../Fixtures';
    }

    protected function locate($filename)
    {
        return $this->getFixturesPath().'/'.$filename;
    }

    /**
     * The first record in the test database
     * NOTE : year is present but lastplay isn't
     *
     * @return array
     */
    protected function firstRecord()
    {
        return array(
            'filename' => 'D:\Music\01 - Baby Baby.mp3',
            'title' => 'Baby Baby',
            'artist' => 'Corona',
            'album' => 'The Rythm of The Night',
            'year' => 1993,
            'genre' => 'Dance',
            'trackno' => 1,
            'length' => 223,
            'type' => 0,
            'lastupd' => '04/05/2014 15:20:34',
            'playcount' => 0,
            'filetime' => '11/10/2013 03:07:51',
            'filesize' => 3156873,
            'bitrate' => 112,
            'albumartist' => 'Corona',
            'mimetype' => 'audio/mpeg',
            'dateadded' => '04/05/2014 15:20:34',
            'rating' => 4,
            'rating_offset' => 3971
        );
    }

    /**
     * The second record in the test database
     * NOTE: the year is missing but lastplay is present
     *
     * @return array
     */
    protected function secondRecord()
    {
        return array(
            'filename' => 'D:\Music\02 - House of Love.mp3',
            'title' => 'House of Love',
            'artist' => 'East 17',
            'album' => 'East 17',
            'genre' => 'Années 80',
            'trackno' => 2,
            'length' => 255,
            'type' => 0,
            'lastupd' => '04/05/2014 15:20:34',
            'playcount' => 1,
            'filetime' => '10/03/2013 01:07:29',
            'filesize' => 3589065,
            'bitrate' => 112,
            'albumartist' => 'East 17',
            'mimetype' => 'audio/mpeg',
            'dateadded' => '04/05/2014 15:20:34',
            'rating' => 5,
            'rating_offset' => 3989,
            'lastplay' => '04/05/2014 15:22:13'
        );

    }
}
