<?php

namespace Neuralys\Nde;

/**
 * A field structure in the NDE way
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 */
class Field
{
    const UNDEFINED   = 255;
    const COLUMN      = 0;
    const INDEX       = 1;
    const REDIRECTOR  = 2;
    const STRING      = 3;
    const INTEGER     = 4;
    const BOOLEAN     = 5;
    const BINARY      = 6;
    const GUID        = 7;
    const FLOAT       = 9;
    const DATETIME    = 10;
    const LENGTH      = 11;
    const FILENAME    = 12;
    const LONG        = 13;

    /** @var int the column ID */
    public $id;

    /** @var  int type of field */
    public $type;

    /** @var  int size of field data */
    public $size;

    /** @var  int next field position */
    public $next;

    /** @var  int previous field position */
    public $prev;

    /** @var  string raw data */
    public $raw;

    public function __construct($id, $type, $size, $next, $prev, $raw)
    {
        $this->id = $id;
        $this->type = $type;
        $this->size = $size;
        $this->next = $next;
        $this->prev = $prev;
        $this->raw = $raw;
    }
}