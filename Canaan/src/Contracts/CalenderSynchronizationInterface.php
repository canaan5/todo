<?php
namespace Canaan\Contracts;


interface CalenderSynchronizationInterface
{
    /**
     * Get Event from external sources e.g google calender
     *
     * @return array
     */
    public function sync();

    /**
     * Open Id authentication / access
     *
     * @return boolean
     */
    public function authenticate();
}