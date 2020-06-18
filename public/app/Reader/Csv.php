<?php

namespace app\Reader;

use Exception;

/**
 * Read file in CSV format from filesystem
 */
class Csv
{

    public $filepath = "";

    /**
     * Lines of the file;
     */
    public $data = [];

    /**
     * Files Rows
     */
    public $numrows = 0;

    /**
     * Headers of file in the case of exist
     */
    public $headers = [];

    /**
     * Bytes of the file
     */
    public $bytes = 0;

    /**
     * Error handle
     */
    private $error = [];

    /**
     * @param string $csvFilePath file path
     * @param string $separator string separator
     */
    public function __construct(string $csvFilePath, string $separator = ";")
    {
        $this->filepath = $csvFilePath;
        $this->bytes = filesize($csvFilePath);
        try {

            if (!file_exists($csvFilePath)) {
                throw new Exception('File not found.');
            }

            $handle = fopen($this->filepath, "r");
            if (!$handle) {
                throw new Exception('File open failed.');
            }
        } catch (Exception $e) {
            throw new Exception('CSV File reader failed: ' . $e->getMessage());
        }

        // Skip Comments
        $commentChar = "#";
        $line = fgetcsv($handle, 0, $separator, '"');
        while (substr($line[0], 0, 1) == $commentChar) {
            $line = fgetcsv($handle, 0, $separator, '"');
        }
        $this->headers = $line;
        // Remove Special Char from headers fields
        $this->headers = array_map("utf8_encode", preg_replace("/[^a-zA-Z0-9_]/", "", $this->headers));

        $lines = array();
        while (!feof($handle) && ($line = fgetcsv($handle, 0, $separator, '"')) !== false) {
            $lines[] = $line;
        }

        $this->data = $lines;
        $this->numrows = count($lines);
        fclose($handle);
    }

    public function getValues(): array
    {
        $values = array();

        foreach ($this->data as $row) {
            $element = [];
            foreach ($row as $key => $value) {
                $element[utf8_encode($this->headers[$key])] = $value;
            }
            array_push($values, $element);
        }
        return $values;
    }

    function print(): void {
        $row = 1;
        while (false !== $this->data) {
            $num = $this->numrows;
            echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c = 0; $c < $num; $c++) {
                echo $this->data[$c] . "<br />\n";
            }
        }
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
    public function getError(): array
    {
        return $this->error;
    }
}
