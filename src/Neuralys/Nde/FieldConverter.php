<?php

namespace Neuralys\Nde;

/**
 * A field converter convert RAW Field entries into string
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 */
class FieldConverter
{
    /**
     * @param Field $field
     *
     * @return Object
     */
    public function convert(Field $field)
    {
        switch( $field->type )
        {
            case Field::COLUMN:
                $data = unpack('C3', $field->raw);
                $size = $data[3];
                return substr($field->raw, 3, $size);

            case Field::INTEGER:
                return (int) array_pop(unpack('l', $field->raw));

            case Field::LENGTH:
                return (int) array_pop(unpack('l', $field->raw));

            case Field::DATETIME:
                return date('m/d/Y H:i:s', array_pop(unpack('i', $field->raw)));

            case Field::STRING:
                $size = array_pop(unpack('S', $field->raw));
                return iconv('UTF-16', 'UTF-8', substr($field->raw, 2, $size));

            case Field::FILENAME:
                $size = array_pop(unpack('S', $field->raw));
                return iconv('UTF-16', 'UTF-8', substr($field->raw, 2, $size));

            case Field::LONG:
                return (int) array_pop(unpack('l', substr($field->raw, 0, 4)));

            case Field::INDEX:
                $data = unpack('C1', substr($field->raw, 8, 1));
                $size = $data[1];
                return substr($field->raw, 9, $size);

            default:
                return '';
        }
    }
}