<?php

/**
 * Function to use
 */

namespace app\Util;

use \Datetime;
use app\Models\Module;
use app\Config\Config;

/**
 * Used function on App
 */
class Util
{
    /**
     * Validate if a given string is in a specified date format
     *
     * @param string $date      String with date
     * @param string $format    String with date format to validate
     *
     * @return bool True if match False otherwise
     *
     */
    public static function validateDate(string $date, string $format = 'Y-m-d H:i:s'): bool
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Encode a given string to base64 format
     *
     * @param string $nif String with data to encode
     *
     * @return string Encoded in base64 format
     */
    public static function nifencode(string $nif)
    {
        return strtr(base64_encode($nif), '#$!', '#%.');
    }
    /**
     * Decode a given string to base64 format
     *
     * @param string $nif String with data to decode
     *
     * @return string Decoded in base64 format
     */
    public static function nifdecode(string $nif)
    {
        return base64_decode(strtr($nif, '#%.', '#$!'));
    }

    /**
     * Admin Navigation Link
     * URL needed to know witch link should be active
     * @param string $url Url of the page that make the request
     *
     * @return array Array with links items
     */
    public static function adminNavLinks(string $url): array
    {
        $moduleUrl = $url;
        $navLinks = [];

        $modules = Module::getUserModules();

        foreach ($modules as $module) {
            if ($module["menuid"] > 1) {
                // Have submenus
                if (!isset($navLinks[$module["menuorder"]])) {
                    $navLinks[$module["menuorder"]] = [
                        "menu" => $module["menu"],
                        "descr" => $module["menudescr"],
                        "url" => "/admin/" . $module["menuurl"],
                        "text" => $module["menutext"],
                        "class" => $module["menuclass"],
                        "order" => $module["menuorder"],
                        "active" => false,
                        "modules" => [],
                    ];
                }
                $active = false;
                if ($module["url"] == $moduleUrl) {
                    $active = true;
                    $navLinks[$module["menuorder"]]["active"] = true;
                }

                $item["url"] = "/admin/" . $module["url"];
                $item["text"] = _($module["text"]);
                $item["class"] = $module["class"];
                $item["active"] = $active;
                $navLinks[$module["menuorder"]]["modules"][$module["order"]] = $item;
                ksort($navLinks[$module["menuorder"]]["modules"], SORT_NUMERIC);
            } else {
                // Not have submenus
                $item["url"] = "/admin/" . $module["url"];
                $item["text"] = _($module["text"]);
                $item["class"] = $module["class"];
                $item["active"] = ($moduleUrl == $module["url"]) ? true : false;
                $item["modules"] = [];
                $navLinks[$module["order"]] = $item;
            }
        }
        ksort($navLinks, SORT_NUMERIC);

        return $navLinks;
    }

    /**
     * Check if user has access to Module
     * @param string $url Url of the page that make the request
     *
     * @return bool True if has access to module False Otherwise
     */
    public static function hasAccessModule(string $url): bool
    {
        $hasAccessModule = false;
        $moduleItems = Module::getUserModules();
        foreach ($moduleItems as $moduleItem) {
            if ($moduleItem["url"] == $url) {
                $hasAccessModule = true;
            }
        }
        return $hasAccessModule;
    }

    /**
     * Get header Authorization
     * */
    public static function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    /**
     * get access token from header
     * */
    public static function getBearerToken()
    {
        $headers = self::getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public static function getPagination($current_page, $total_pages, $boundaries, $around)
    {
        if ($total_pages <= 1) {
            return;
        }

        if ($current_page > $total_pages) {
            return;
        }

        $stack = array(1);
        // Boundaries For Frist Page
        for ($b = 2; $b < $boundaries + 1; $b++) {
            // If there are enough pages
            if ($b < $total_pages) {
                array_push($stack, $b);
            }
        }
        // Around For Current Page
        // Before
        $val = $around;
        while ($val > 0) {
            $val--;
            if (!in_array($current_page - ($around - $val), $stack) && $current_page - ($around - $val) > 1) {
                array_push($stack, $current_page - ($around - $val));
            }
        }
        sort($stack);
        // Add Current Page
        if (!in_array($current_page, $stack) && $current_page > 1) {
            array_push($stack, $current_page);
        }
        // After
        $val = 0;
        while ($val < $around) {
            $val++;
            if (!in_array($current_page + $val, $stack) && $current_page + $val > 1 && $current_page + $val < $total_pages) {
                array_push($stack, $current_page + $val);
            }
        }
        // Boundaries For Last Page
        $val = $boundaries;
        while ($val > 0) {
            if (!in_array($total_pages - ($boundaries - $val), $stack) && $total_pages - ($boundaries - $val) > 1) {
                array_push($stack, $total_pages - ($boundaries - $val));
            }
            $val--;
        }
        sort($stack);

        // Return HTML pagination
        $html = ('<div class="pagination">');

        for ($i = 0; $i < sizeof($stack); $i++) {
            if ($i > 1) {
                if (($stack[$i - 1] + 1) != $stack[$i]) {
                    $html .= ('<span class="nobutton">...</span>');
                }
            }
            if ($stack[$i] == $current_page) {
                $html .= '<button class="button button-primary button-large currentpage" title="Page ' . $stack[$i] . '" data-page = "' . $stack[$i] . '" >' . $stack[$i] . '</button>';
            } else {
                $html .= '<button class="button button-primary button-large newpage" title="Page ' . $stack[$i] . '" data-page ="' . $stack[$i] . '" >' . $stack[$i] . '</button>&nbsp;';
            }
        }
        $html .= ('</div>');
        return $html;
    }

    /**
     * Set items , boundaries , around for pagination
     * Items -> items per page
     */
    public static function paginationConfig()
    {
        $number_items_per_page = 50;
        $boundaries = 4;
        $around = 2;
        return ["items" => $number_items_per_page, "boundaries" => $boundaries, "around" => $around];
    }

    /**
     * Algorithm to return excel columns by a given number
     * @param int       $num Integer number to convert in column
     *
     * @return string   String represent excel column
     */
    public static function getAbc(int $num)
    {
        $abc = ["A", "B", "C", "D", "E", "F",
            "G", "H", "I", "J", "K", "L",
            "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z"];

        $val = count($abc);

        $pos = [];

        $quoc = (int) ($num / $val);
        $rest = $num % $val;

        while ($quoc > 0) {
            $rest = $num % $val;
            $pos[] = $rest;
            $num = (int) ($num / $val) - 1;
            $quoc = (int) ($num / $val);
            $rest = (int) ($num % $val);
        }
        $pos[] = $rest;

        $str = "";
        $reversed = array_reverse($pos);
        foreach ($reversed as $j) {
            $str .= $abc[$j];
        }

        return $str;
    }

    public static function getRule(string $rule)
    {
        $operators = [
            "==",
            "===",
            "!=",
            "<>",
            "!==",
            ">",
            "<",
            ">=",
            "<=",
        ];
        $result = [];
        foreach ($operators as $operator) {
            $pos = strpos($rule, $operator);
            if (false !== $pos) {
                $arr = explode($operator, $rule);
                if (count($arr) == 2) {
                    $result = [
                        "field" => $arr[0],
                        "op" => $operator,
                        "value" => $arr[1],
                    ];
                }
            }
        }
        return $result;
    }

    public static function evalRule($x, $op, $y)
    {
        switch ($op) {
            case "==":
                return $x == $y;
                break;

            case "===":
                return $x === $y;
                break;
            case "!=":
                return $x != $y;
                break;
            case "<>":
                return $x != $y;
                break;
            case "!==":
                return $x !== $y;
                break;
            case ">":
                return $x > $y;
                break;
            case "<":
                return $x < $y;
                break;
            case ">=":
                return $x >= $y;
                break;
            case "<=":
                return $x <= $y;
                break;
            default:
                return null;
        }
    }

    public static function validEmail(string $email): bool
    {
        $valid = false;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = true;
        }

        if ($valid) {
            $valid = false;
            $arr = explode("@", $email);
            $hostname = $arr[1];
            $result = dns_get_record($hostname);
            if (!empty($result)) {
                foreach ($result as $record) {
                    if ($record["type"] = "MX") {
                        if (!empty($record["target"])) {
                            $valid = true;
                        }
                    }
                }
            }
        }
        return $valid;
    }
    public static function getRecaptchaSecreatKey()
    {
        $config = Config::get();
        $secret = $config["URL"]["serverKey"];

        return $secret;
    }

    /**
     * @param string $apiurl Url for the connection
     * @param array $params Payload to include in de connection
     * @param string $type Content raw type `json` | `querystring`
     *
     * @return mixed Data from the request response
     */
    public static function sendRequest($apiurl, $params, $type = "json")
    {
        /*
        application/json, application/xml, text/html, text/plain, etc
         */
        /**
         * Headers for the connection
         */
        $headers = [];
        /**
         * Request Type
         * json | querystring
         */
        $postFields = json_encode($params);
        if ("querystring" == $type) {
            $postFields = http_build_query($params);
            array_push($headers, "Accept: application/json");
        } else {
            array_push($headers, "Accept: application/json");
        }

        $datei = time();
        $connTimeOut = 4;
        $maxTime = 30;
        ini_set('max_execution_time', $maxTime);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connTimeOut); // time-out on connect
        curl_setopt($ch, CURLOPT_TIMEOUT, $maxTime); // time-out on response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return web page
        curl_setopt($ch, CURLOPT_POST, true); // POST REQUEST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields); // JSON OBJECT \ QUERY STRING
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Headers to the Request
        curl_setopt($ch, CURLOPT_URL, $apiurl); // URL for the request
        /*
        Response
         */
        try {
            $response = curl_exec($ch);
            $response = json_decode($response, true);
            /*
            We need to get Curl infos for the header_size and the http_code
             */
            $api_response_info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $api_response_info = json_encode($api_response_info, true);

            $data["api_response_info"] = $api_response_info;
            $data["response"] = $response;
            /*
            close Curl
             */
            curl_close($ch);
            $data["executionTime"] = time() - $datei;
            return $data;
        } catch (Exception $exception) {
            $data["error"] = curl_errno($ch);
            $data["message"] = $exception->getMessage();
            $data["executionTime"] = time() - $datei;
            return $data;
        }
    }
}
