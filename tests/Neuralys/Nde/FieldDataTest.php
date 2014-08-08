<?php

namespace Neuralys\Nde;

class FieldDataTest extends TestCase
{
    public function testConstrcutor()
    {
        $field = new Field(1, 2, 8, 4, 5, 'raw data');
        $this->assertEquals(1, $field->id);
        $this->assertEquals(2, $field->type);
        $this->assertEquals(8, $field->size);
        $this->assertEquals(4, $field->next);
        $this->assertEquals(5, $field->prev);
        $this->assertEquals('raw data', $field->raw);
    }
}