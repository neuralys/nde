<?php

namespace Neuralys\Nde;

/**
 * The only usefull class to read Winamp Media Database file.
 * This will create all the magic for you (index/ data file...) easily
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 */
class WinampDb implements DataInterface
{
    /** @var FileData */
    private $reader;

    /**
     * Read Winamp Media Database
     *
     * @param $path string|array the path or list where to find Winamp
     *
     * @throws \FileNotFoundException
     */
    public function __construct($path)
    {
        if (!is_array($path) && substr_count($path, ',') > 0) {
            $path = explode(',', $path);
        }

        if (!is_array($path)) {
            $path = array($path);
        }

        foreach ($path as $p) {
            if (!$this->reader && file_exists($p.'/main.dat')) {
                $index = new FileIndex($p.'/main.idx');
                $this->reader = new FileData($p.'/main.dat', $index);
            }
        }

        if (!$this->reader) {
           throw new \FileNotFoundException('Unable to find Winamp main.dat file');
        }
    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        $this->reader->reset();
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        return $this->reader->next();
    }

    public function all()
    {
        $ret = array();
        $this->reset();

        while($entry = $this->next()) {
            $ret[] = $entry;
        }
        $this->reset();

        return $ret;
    }

    /**
     * @inheritdoc
     */
    public function close()
    {
        $this->reader->close();
    }
}