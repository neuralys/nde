<?php

namespace Neuralys\Nde;

/**
 * Index implementation
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 */
class FileIndex implements IndexInterface
{
    const SIGNATURE = 'NDEINDEX';

    /** @var int  */
    private $count;

    /** @var int  */
    private $cur;

    /** @var  string */
    private $file;

    /** @var resource  */
    private $stream;

    /**
     * Create an index from a file without buffering
     *
     * @param $file string the file that contains the index
     * @throws \UnexpectedValueException
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->stream = fopen($file, "rb");
        $this->cur=0;
        $temp = fread($this->stream, strlen(self::SIGNATURE));

        if ($temp !== self::SIGNATURE) {
            throw new \UnexpectedValueException(sprintf(
                'The file "%s" is not a valid NDE index file', $file));
        }

        $this->count = array_pop(unpack('I', fread($this->stream, 4)));
        $this->reset();
    }

    public function reset()
    {
        if ($this->stream) {
            fseek($this->stream, 16);
        }
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        $this->cur++;
        if (!$this->stream  || ($this->cur > $this->count) ) {

            return null;
        }

        $data = unpack('I2', fread($this->stream, 8));

        return new IndexData($data[2], $data[1]);
    }

    /**
     * @inheritdoc
     */
    public function close()
    {
        if ($this->stream) {
            fclose($this->stream);
        }

        $this->stream = null;
    }
}