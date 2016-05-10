<?php
/**
 * Created by Canaan Etaigbenu
 * User: canaan5
 * Date: 5/10/16
 * Time: 2:28 PM
 */

namespace Canaan\Repo\Contracts;


interface CalenderInterface
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