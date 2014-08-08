<?php

namespace Neuralys\Nde;

/**
 * An index data is an association between an index number and the offset
 * location of this index in a data
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 */
class IndexData
{
    /** @var int  */
    public $offset;

    /** @var int  */
    public $index;

    /**
     * @param $index int the index number
     * @param $offset int the offset value for this index
     */
    public function __construct($index, $offset)
    {
        $this->index = $index;
        $this->offset = $offset;
    }
}