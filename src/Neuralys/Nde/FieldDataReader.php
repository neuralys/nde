<?php

namespace Neuralys\Nde;

/**
 * A field reader that read NDE binary data to create Field object
 *
 * =============================================================================
 * Offset  Data Type   Size             Field
 * =============================================================================
 * 0       UCHAR       1                Column ID
 * 1       UCHAR       1                Field Type
 * 2       INT         4                Size of field data
 * 6       INT         4                Next field position in table data pool
 * 10      INT         4                Prev field position in table data pool
 * 14      FIELDDATA   SizeOfFieldData  Field data
 * =============================================================================
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 */
class FieldDataReader
{
    public function read($data)
    {
        $chars = unpack('C2', substr($data, 0, 2));
        $id = $chars[1];
        $type = $chars[2];
        $nums = unpack('i3', substr($data, 2, 12));
        $size = $nums[1];
        $next = $nums[2];
        $prev = $nums[3];
        $raw = substr($data, 14, $size);

        return new Field($id, $type, $size, $next, $prev, $raw);
    }
}