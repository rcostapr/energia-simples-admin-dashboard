<?php

/**
 * Logging Method to the app
 */

namespace app\Logging;

/**
 * Logging Class to the app
 */
class Logging
{

    /**
     * Default log file
     * @var
     */
    protected $logFileName = __DIR__ . '/../../../logs/app-register.log';

    /**
     * Constructor method - Initialize new instance
     *
     * @param string $fullPathLogFileName Log File Path
     *
     * @return void
     */
    public function __construct(String $fullPathLogFileName = null)
    {
        if (!empty($fullPathLogFileName)) {
            $this->logFileName = $fullPathLogFileName;
        } else {
            $timestamp = Date("Ymd");
            $this->logFileName = "../logs/sync-" . $timestamp . ".log";
        }
    }

    /**
     * Write message to log file
     *
     * @param string $msg String to write in log file
     *
     * @return void
     */
    public function write(String $msg)
    {
        $timestamp = date('Y-m-d H:i:s');
        $myfile = fopen($this->logFileName, "a") or die("Unable to open file! " . $this->logFileName);

        $userAgent = "Local Execution";
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_USER_AGENT"])) {
                $userAgent = $_SERVER["HTTP_USER_AGENT"];
            }
        }

        fwrite($myfile, "[" . $timestamp . "] " . $msg . " [" . $userAgent . "] \r\n");
        fclose($myfile);
    }
}
