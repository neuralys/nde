<?php

namespace Neuralys\Nde;

/**
 * Interface for Index
 * an NDE database is basically an index file and a data file
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 * @interface IndexInterface
 */
interface IndexInterface
{
    /**
     * Reset the current index if not already closed
     *
     * @return mixed
     */
    public function reset();

    /**
     * Get the next index data from the index.
     * Return the offset and index number
     *
     * @return IndexData
     */
    public function next();

    /**
     * Close the index
     */
    public function close();
}