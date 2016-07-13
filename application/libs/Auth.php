<?php

/**
 * Class Auth
 * Set of different authenticating functions and its actions such as Login and Session checks
 */
class Auth
{
    function __construct()
    {
        Session::init();
    }

    public static function exists($param)
    {
        if (ENVIRONMENT != 'release') {
            if (isset($param)) {
                return $param;
            } else {
                return 'None';
            }
        }
    }

    public static function adminCheck()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. Please logout your current session.<br />';
            require_once '_fb/403_2.html'; exit();
        }
    }

    /**
     * If the system was logged in by someone
     * @return bool
     */
    public static function loginCheck()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            return true;
        } else if (isset($_SESSION['user_logged_in'])) {
            return true;
        } else {
            return false;
            // Better no direct to login page for security
            // $ERROR = 'SORRY. You have insufficient credentials to use this page.';
            // require_once '_fb/403_2.html';
            // exit();
        }
    }

    public static function handleLogin()
    {
        // if user is still not logged in..
        if (!isset($_SESSION['admin_logged_in']) OR !isset($_SESSION['user_logged_in'])) {
            // then destroy session, handle user as "not logged in" and
            Session::destroy();
            // redirect user to login page
            header('location: ' . URL);
            exit();
        }
    }

    // IN ORDER TO AVOID LOGGING IN AGAIN WHEN THE USER IS ALREADY LOGGED IN
    public static function postLogin()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            header('location: ' . URL . 'admin'); exit();
        } else if (isset($_SESSION['user_logged_in'])) {
            header('location: ' . URL . 'system'); exit();
        } else if (!isset($_SESSION['admin_logged_in']) AND isset($_COOKIE['rememberme'])) {
            // user has remember-me-cookie ? then try to login with cookie ("remember me" feature)
            header('location: ' . URL . 'system/loginWithCookie'); exit();
        } else if (!isset($_SESSION['user_logged_in']) AND isset($_COOKIE['rememberme'])) {
            header('location: ' . URL . 'system/loginWithCookie'); exit();
        }
    }

    public static function detectEnvironment($er_no, $message = null)
    {
        if (ENVIRONMENT != 'development' && ENVIRONMENT != 'test') {
            $ERROR = "Sorry. The system might not yet active at this moment. ";
            require '_fb/' . $er_no . '.html';
            exit;
        } else if (!empty($message)) {
            $ERROR = $message;
            require '_fb/' . $er_no . '.html';
            exit;
        }
    }

        /**
         * Debugging database
         * @param $helper
         * @return string
         */
        public static function detectDBEnv($helper)
        {
            if (ENVIRONMENT != 'release') {
                $output = '<br /><br />PDO DEBUG : ' . $helper;
                return $output;
            }
        }


    /**
     * NOT RECOMMENDED FUNCTION FOR SLOWER NETWORKS!
     * This was the purpose if the internet was stable for generating emails
     * @param $address
     * @param $port
     * @return bool
     */
    public static function isInternetAvailible($address, $port) {
        //check, if internet connection exists
        $connected = fsockopen($address, $port);
        //website, port  (try 80 or 443)
        if ($connected) {
            fclose($connected);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $type
     * @return bool
     * TODO: Will be updating soon
     */
    public static function setuser($type = 'user') {
        if ($type == 'admin') {
            Session::set('admin_logged_in', true);
        } else if ($type != 'admin') {
            Session::set('user_logged_in', true);
        } else {
            return false;
        }
    }

}
