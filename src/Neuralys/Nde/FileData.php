<?php

namespace Neuralys\Nde;

/**
 * Data implementation
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 */
class FileData implements DataInterface
{
    const SIGNATURE = 'NDETABLE';

    /** @var resource  */
    private $stream;

    /** @var IndexInterface */
    private $index;

    /** @var FieldDataReader */
    private $reader;

    /** @var FieldConverter */
    private $converter;

    /** @var array */
    private $columns;

    /**
     * Create an index from a file without buffering
     *
     * @param $file  string         the file that contains the index
     * @param $index IndexInterface the index to locate the data in the file
     *
     * @throws \UnexpectedValueException
     */
    public function __construct($file, IndexInterface $index)
    {
        $this->stream = fopen($file, "rb");
        $temp = fread($this->stream, strlen(self::SIGNATURE));

        if ($temp !== self::SIGNATURE) {
            throw new \UnexpectedValueException(sprintf(
                'The file "%s" is not a valid NDE data file', $file));
        }

        $this->index = $index;
        $this->columns = array();
        $this->reader = new FieldDataReader();
        $this->converter = new FieldConverter();
    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        $this->columns = array();
        $this->index->reset();
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        if (!$this->stream ) {
            return null;
        }

        $id = $this->index->next();

        if (!$id) {

            return null;
        }

        $offset = $id->offset;
        $fields = array();
        $col = false;

        while($offset) {
            fseek($this->stream, $offset);
            $data = fread($this->stream, 14);
            $size = array_pop(unpack('i', substr($data, 2, 4)));
            $data .= fread($this->stream, $size);
            $field = $this->reader->read($data);
            $col = $field->type == Field::COLUMN ? true : false;

            if ($field->type == Field::INDEX) {
                return $this->next();
            }

            $value = $this->converter->convert($field);

            if ($this->columns) {
                    if (isset($this->columns[$field->id])) {
                        $name = $this->columns[$field->id];
                        $fields[$name] = $value;

                        if ($name == 'rating') {

                            // -- this will help if you want to change the rating
                            // -- outside winamp, all other values are read from
                            // -- the MP3 itself (artist, ...)

                            $fields['rating_offset'] = $offset + 14;
                        }
                    }
            } else {
                if ($col) {
                    $fields[$field->id] = $value;
                }
            }

            $offset = $field->next;
        }

        if ($col) {
            $this->columns = $fields;

            return $this->next();
        }

        return $fields;
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
        $this->index->close();
    }
}