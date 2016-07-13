<?php

/**
 * 
 * HOME OF THIS APPLICATION
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class System extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct(); // constructing from /core/controller.php to load other func like this one under
        $this->admin_model = $this->loadModel('Admin'); // load model from /core/controller.php
        $this->captcha_model = $this->loadModel('Captcha');
        $this->category_model = $this->loadModel('Category');
    }

    /** ----------------------------------- **/

    /**
     * CORE FUNCTIONS FOR HOMEPAGE SHOULD BE HERE
     */
    public function index()
    {
        // DEFAULT RENDERING VIEWS
        // require TEMPLATES . 'null_header.php';
        // require VIEWS_PATH . 'system.php';
        // require TEMPLATES . 'null_footer.php';

        // New rendering system (beta)
        $this->view('system');
    }
    
    public function login()
    {
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $this->user_model->login();
        // check login status
        if ($login_successful == true) { // use this -- die(Session::get('user_account_type')); to test
            switch (Session::get('user_account_type')) { // switch($_SESSION['user_account_type']) {
                case 'admin':
                    header('location: ' . URL . 'admin'); exit;
                    break;
                case 'user': case 'intern':
                    header('location: ' . URL . 'system/dashboard'); exit;
                    break;
            }
            $this->audit_model->set_log('Login', 'System: ' . $_POST['user_name'] . ' was logged in.');
            header('location: ' . URL);
        } else {
            $this->audit_model->set_log('Login', 'System: Login user ' . $_POST['user_name'] . ' was failed to continue.');
            header('location: ' . URL);
        }
    }

    /** Login with cookie if user wants to be remembered */
    private function loginWithCookie()
    {
        // run the loginWithCookie() method in the login-model, put the result in $login_successful (true or false)
        $login_successful = $this->admin_model->loginWithCookie();

        if ($login_successful) {
            header('location: ' . URL);
        } else {
            // delete the invalid cookie to prevent infinite login loops
            $this->admin_model->deleteCookie();
            // if NO, then move user to login/index (login form) (this is a browser-redirection, not a rendered view)
            header('location: ' . URL);
        }
    }

    function logout()
    {
        $logout = $this->user_model->logout($_SESSION['user_account_type']);
        if ($logout == true) {
            $this->audit_model->set_log('Login', '' . $_GET['user'] . ' was logged out.');
            header('location: ' . URL);
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL);
        }
    }

    public function dashboard() {
        Auth::adminCheck();
        require View::header('system');
        require VIEWS_PATH . 'system/index.php';
        require View::footer('system');
    }

    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }

    /** ----------------------------------- **/
}
