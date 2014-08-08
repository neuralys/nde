<?php

namespace Neuralys\Nde;

class WinampDbTest extends TestCase
{

    /**
     * @expectedException \FileNotFoundException
     */
    public function testSignature()
    {
        $winamp = new WinampDb(__DIR__);
    }

    public function testPathAsList()
    {
        $path = $this->getFixturesPath();
        $winamp = new WinampDb(array('fakedir', $path));
        $winamp->close();
    }

    public function testPathAsArray()
    {
        $path = $this->getFixturesPath();
        $winamp = new WinampDb('fakedir,'.$path);
        $winamp->close();
    }

    public function testNext()
    {
        $path = $this->getFixturesPath();
        $winamp = new WinampDb($path);

        $first = $winamp->next();
        $this->assertEquals($this->firstRecord(), $first, 'Failed to read first record');

        $winamp->close();
    }

    public function testReset()
    {
        $path = $this->getFixturesPath();
        $winamp = new WinampDb($path);

        $first = $winamp->next();
        $this->assertEquals($this->firstRecord(), $first, 'Failed to read first record');

        $winamp->reset();

        $second = $winamp->next();
        $this->assertEquals($this->firstRecord(), $second, 'Failed to reset and re-read first record');

        $winamp->close();
    }

    public function testClose()
    {
        $path = $this->getFixturesPath();
        $winamp = new WinampDb($path);

        $winamp->close();

        $first = $winamp->next();
        $this->assertNull( $first, 'winamp db is not closed !');
    }

    public function testAll()
    {
        $path = $this->getFixturesPath();
        $winamp = new WinampDb($path);

        $all = $winamp->all();
        $winamp->close();

        // -- the test DB has 6 songs
        // Genre       Artist     Album                   Song
        // Dance       Corona     The Rythm of the Night  Baby Baby
        // Années 80   East 17    East 17                 House of Love
        // Dance       Aqua       Aquarium                My Oh My
        // Metal       Gamma Ray  Insanity And Genius     No Return
        // Metal       Gamma Ray  Power Plant             Razorblade Sigh
        // Metal       Gamma Ray  Insanity And Genius     Heal Me

        $e = array();

        foreach ($all as $r) {
            $e['artists'][] = $r['artist'];
            $e['genres'][] = $r['genre'];
            if ($r['artist'] == 'Gamma Ray') {
                $e['songs'][] = $r['title'];
            }
        }

        foreach ($e as $key => $array) {
            $e[$key] = array_unique($array);
            sort($e[$key]);
        }

        $this->assertEquals(6, count($all));
        $this->assertEquals(array('Aqua', 'Corona', 'East 17', 'Gamma Ray'), $e['artists']);
        $this->assertEquals(array('Années 80', 'Dance', 'Metal'), $e['genres']);
        $this->assertEquals(array('Heal Me', 'No Return', 'Razorblade Sigh'), $e['songs']);

    }

}