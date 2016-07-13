<?php

/**
 * Report Generator 2.0
 * by jccultima123
 */
class Report extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        $this->report_model = $this->loadModel('Report');
        Auth::loginCheck();
    }

    function index()
    {
        if (isset($_GET['data'])) {
            $data = $_GET['data'];
        }
        require VIEWS_PATH . 'report/v2/header.php';
        require VIEWS_PATH . 'report/v2/index.php';
        require VIEWS_PATH . 'report/v2/footer.php';
    }

    /**
     * Dynamic content API
     * @param null $view
     * @return bool
     */
    function load($view = NULL)
    {
        switch($view){
            case isset($view):
                $page =  VIEWS_PATH . 'report/v2/'.$view.'.php';
                if (file_exists($page)) { require $page; return true; } else { return false; }
                break;
            default:
                require VIEWS_PATH . 'report/v2/home.php';
                break;
        }
        return false;
    }
}