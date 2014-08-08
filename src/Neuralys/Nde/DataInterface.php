<?php

namespace Neuralys\Nde;

/**
 * Interface for Data
 * an NDE database is basically an index file and a data file
 *
 * @author Nicolas BELIN <nico@neuralys.com>
 * @interface DataInterface
 */
interface DataInterface
{
    /**
     * Reset the current data if not already closed
     *
     * @return mixed
     */
    public function reset();

    /**
     * Get the next data from the data file.
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