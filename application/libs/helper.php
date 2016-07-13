<?php

class Helper
{
    /**
     * debugPDO
     *
     * Shows the emulated SQL query in a PDO statement. What it does is just extremely simple, but powerful:
     * It combines the raw query and the placeholders. For sure not really perfect (as PDO is more complex than just
     * combining raw query and arguments), but it does the job.
     * 
     * @author Panique
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     */
    static public function debugPDO($raw_sql, $parameters) {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // check if named parameters (':param') or anonymous parameters ('?') are used
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // bring parameter into human-readable format
            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        /*
        if (ENVIRONMENT != 'release') {
            echo "<br> [DEBUG] Keys:<pre>";
            print_r($keys);
            echo "\n[DEBUG] Values: ";
            print_r($values);
            echo "</pre>";
        }
        */
        
        
        $raw_sql = preg_replace($keys, $values, $raw_sql, 1, $count);

        return $raw_sql;
    }

    /**
     * Encode using json or array
     * @param $data
     * @param $type
     * @param bool $return
     * @return bool|string
     */
    static public function encode($data, $type = NULL, $return = false)
    {
        switch($type) {
            case 'json':
                //heading is important for format standards
                header('Content-type: application/json');
                if ($return) {
                    return json_encode($data);
                } else {
                    //should this work with PDO::FETCH_ASSOC arrays
                    print json_encode($data);
                    return true;
                }
                break;
            default:
                print $data;
                break;
        }
    }

}