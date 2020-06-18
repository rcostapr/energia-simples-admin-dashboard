<?php

/**
 * Blade Instance creation.
 */

namespace app\Blade;

use Jenssegers\Blade\Blade as Jblade;

/**
 * Initialize Blade Instance
 */
class Blade
{
    /**
     * Initialize a new blade instance with a given document root path
     * 
     * @param string $documentroot Document root of the views
     * 
     * @return Jblade Instance
     */
    public static function New(string $documentroot = null): Jblade
    {
        if ($documentroot == null) {
            $documentroot = $_SERVER["DOCUMENT_ROOT"];
        }
        $views = $documentroot . '/views';
        $cache = $documentroot . '/../cache';
        return new Jblade($views, $cache);
    }
}