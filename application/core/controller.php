<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 * Whenever a controller is created, we also
 * 1. initialize a session
 * 2. check if the user is not logged in anymore (session timeout) but has a cookie
 * 3. create a database connection (that will be passed to all models that need a database connection)
 * 4. create a view object
 */
class Controller
{   
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

    function __construct()
    {
        BrowserLib::detectCompatibility();
        if (version_compare(PHP_VERSION, '5.3.7', '<')) {
            http_response_code(500);
            Auth::detectEnvironment('error_2', "PHP was not compatible for your system."); exit;
        } else {
            try {
                $this->openDatabaseConnection();
            } catch (PDOException $e) {
                error_log($e->getMessage());
                //specifies error file cause of ui conflicts (error, error_2, error_3, and so on..)
                $msg = "The database was either unable to connect or doesn't exists.<br /><hr /><b>DEBUG:</b> " . $e . "<hr />";
                http_response_code(500); Auth::detectEnvironment('error', $msg); exit;
            }
        }
        Session::init(); // Init Session
        $this->user_model = $this->loadModel('User'); //Load User model for login. etc.
        $this->audit_model = $this->loadModel('Audit'); //Load Audit Trail model
        // $this->view = new View(); //View class (may be unstable)
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE .':host=' . DB_HOST .';dbname=' . DB_NAME .';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
        if (defined(EMULATED_SQL)) {$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, EMULATED_SQL);}
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    /**
     * loads the model with the given name.
     * ALTERNATIVE WAY BUT MORE EFFICIENT!
     * @param $name string name of the model
     */
    public function loadModel($name)
    {
        $path = MODELS_PATH . strtolower($name) . '_model.php';
        if (file_exists($path)) {
            // include $path;
            require $path;
            $modelName = $name . 'Model';
            if (isset($modelName)) {
                return new $modelName($this->db);
            } else {
                $msg = "The file " . $path . " exixts but the classes might be missing. ";
                Auth::detectEnvironment('error', $msg); exit;
            }
        } else {
            $msg = "The file " . $path . " might be corrupted or missing. ";
            Auth::detectEnvironment('error_2', $msg); exit;
        }
    }
    
    /**
     * renders the feedback messages into the view
     */
    public function renderFeedbackMessages()
    {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        require VIEWS_PATH . '_templates/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
        Session::set('feedback_note', null);
    }

    /**
     * render views (beta)
     */
    public function view($view, $type = null)
    {
        require ( empty($type) ? TEMPLATES . 'null_header.php' : HEADER . $type . '.php' );
        require VIEWS_PATH . $view . '.php';
        require ( empty($type) ? TEMPLATES . 'null_footer.php' : FOOTER . $type . '.php' );
    }



}
