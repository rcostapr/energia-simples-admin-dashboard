<?php

/**
 * Manage App configuration file
 */

namespace app\Config;

/**
 * Manage App configuration file
 */
class Config
{

    /**
     * return default configuration file
     */
    private static function init(): String
    {
        $configfile =  __DIR__ . "/../../../config.ini";
        return $configfile;
    }


    /**
     * Get configuration file content
     * 
     * @param string    $configfile Set the configuration file path
     * 
     * @return  array With configuration data
     * 
     */
    public static function get(String $configfile = null): array
    {
        // Parse with sections
        if ($configfile == null)
            $configfile = Config::init();
        $ini_array = parse_ini_file($configfile, true);
        return $ini_array;
    }


    /**
     * Get Email configuration file content
     * 
     * @param string    $configfile Set the configuration file path
     * 
     * @return  array With configuration data
     * 
     */
    public static function getEmail(String $configfile = null): array
    {
        // Parse with sections
        if ($configfile == null)
            $configfile = Config::init();
        $ini_array = parse_ini_file($configfile, true);
        return $ini_array["EMAIL"];
    }

    /**
     * Get Server configuration file content
     * 
     * @param string    $configfile Set the configuration file path
     * 
     * @return  array With configuration data
     * 
     */
    public static function getServer(String $configfile = null): array
    {
        // Parse with sections
        if ($configfile == null)
            $configfile = Config::init();
        $ini_array = parse_ini_file($configfile, true);
        return $ini_array["SERVER"];
    }

    /**
     * Get Database configuration file content
     * 
     * @param string    $configfile Set the configuration file path
     * 
     * @return  array With configuration data
     * 
     */
    public static function getDatabase(String $configfile = null): array
    {
        // Parse with sections
        if ($configfile == null)
            $configfile = Config::init();
        $ini_array = parse_ini_file($configfile, true);
        return $ini_array["DATABASE"];
    }

    /**
     * Get Api configuration file content
     * 
     * @param string    $configfile Set the configuration file path
     * 
     * @return  array With configuration data
     * 
     */
    public static function getApi(String $configfile = null): array
    {
        // Parse with sections
        if ($configfile == null)
            $configfile = Config::init();
        $ini_array = parse_ini_file($configfile, true);
        return $ini_array["API"];
    }
}
