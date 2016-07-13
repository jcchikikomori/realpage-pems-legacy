<?php

class Admin extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        $this->handleLogin(); // handle login
        $this->admin_model = $this->loadModel('Admin');    
        $this->category_model = $this->loadModel('Category');
    }
    
    // HANDLE LOGIN FIRST FOR NON-ADMIN USERS
    private function handleLogin()
    {
        // initialize the session
        Session::init();
        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['admin_logged_in'])) {
            // Destroying Session
            Session::destroy();
            $this->audit_model->set_log('Exception', 'Non-Admin User' . $_POST['user_name'] . ' was attempting to visit Administrator Site.');
            header('location: ' . URL);
            exit();
        }
    }

    function index()
    {
        // die('hello admin!');
        if (isset($_SESSION['admin_logged_in'])) {
            // loading some models
            $this->audit_model->set_log('Admin', 'Admin Home page successfully loaded.');
            // load views
            require View::header();
            require VIEWS_PATH . 'admin/home/index.php';
            require View::footer();
            exit;
        }
        else {
            // Destroying Session
            Session::destroy();
            header('location: ' . URL);
            exit();
        }
    }
    
    function help()
    {
        header('location: ' . URL . 'help');
    }
    
    function about()
    {
        $this->audit_model->set_log('Admin', 'Accessed About page');
        require View::header();
        require VIEWS_PATH . 'about/index.php';
        require View::footer();        
    }

    function users($action = null, $user_id = null)
    {
        switch($action) {
            case 'test': $this->test($user_id); break;
            case 'register': $this->register(); break;
            case 'details': break;
            case 'edit': break;
            case 'activate': break;
            case 'deactivate': break;
            case 'delete': $this->deleteUser($user_id); break;
            case 'action': $this->userAction(); break;
            default:
                header('location: ' . URL . 'admin');
        }
    }

    /** YOU MAY USE THIS TEST USING users() **/
    private function test($user_id)
    {
        // require View::header();
        echo "TEST ID: " . $user_id;
        // require View::footer();
    }

    private function register()
    {
        require View::header();
        require VIEWS_PATH . 'admin/user/register.php';
        require View::footer();
    }
    
    private function userDetails($user_id)
    {
        $branch = $this->branch_model->getBranches();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            $this->audit_model->set_log('Admin', 'Accessed details for User #' . $user_id);
            require View::header();
            if ($user->user_active == 0 AND $user->user_provider_type != 'ADMIN') {
                require VIEWS_PATH . 'admin/user/activate.php';
            } else if ($user->user_password_reset_hash != NULL) {
                require VIEWS_PATH . 'admin/user/details.php';
            } else {
                require VIEWS_PATH . 'admin/user/details.php';
            }
            require View::footer();
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    private function editUser($user_id)
    {
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            $usertypes = $this->user_model->getUsertype();
            $branches = $this->branch_model->getBranches();
            $this->audit_model->set_log('Admin', 'Accessed edit form for User #' . $user_id);
            require View::header();
            require VIEWS_PATH . 'admin/user/edit.php';
            require View::footer();
        } else {
            $this->audit_model->set_log('Admin', 'Failed to access non-existent User #' . $user_id);
            header('location: ' . URL . 'admin/users');            
        }
    }
    
    private function deactivateUser($user_id)
    {
        $user_count = $this->user_model->countUsers();
        if ($_POST[$user_id] <= $user_count) {
            if (isset($user_id)) {
                $this->user_model->deactivateUser($user_id);
                $this->audit_model->set_log('Admin', 'User #' . $user_id . ' deactivated');
                header('location: ' . URL . 'admin/users');
            }
        } else {
            $this->audit_model->set_log('Admin', 'Failed to deactivate User #' . $user_id);
            header('location: ' . URL . 'admin/users');
        }
    }
    
    private function deleteUser($user_id)
    {
        $user_count = $this->user_model->countUsers();
        if ($_POST[$user_id] <= $user_count) {
            if (isset($user_id)) {
                $this->user_model->deleteUser($user_id);
                $this->audit_model->set_log('Admin', 'User #' . $user_id . ' deleted');
                header('location: ' . URL . 'admin/users');
            }
        } else {
            $this->audit_model->set_log('Admin', 'Failed to delete user #' . $user_id);
            header('location: ' . URL . 'admin/users');
        }
    }
    
    private function editUserName($user_id)
    {
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            require View::header();
            require VIEWS_PATH . 'admin/user/editusername.php';
            require View::footer();
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    private function editUserEmail($user_id)
    {
        if (isset($user_id)) {
            require View::header();
            require VIEWS_PATH . 'admin/user/edituseremail.php';
            require View::footer();
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }

    private function userAction()
    {
        if (isset($_POST['create_user'])) {
            $action_successful = $this->user_model->registerNewUser();
            if ($action_successful == true) {
                $this->audit_model->set_log('Admin', 'New User (' . $_POST['user_name'] . ') registered and pending for activation.');
                header('location: ' . URL . 'admin/users');
            } else {
                $this->userRegister();
            }
        } else if (isset($_POST['accept_request'])) {
            $action_successful = $this->user_model->acceptNewUser();
            if ($action_successful == true) {
                $this->audit_model->set_log('Admin', 'User #' . $_POST['user_name'] . ' activated');
                header('location: ' . URL . 'admin/users');
            } else {
                $this->audit_model->set_log('Admin', 'Failed to activate user #' . $_POST['user_name']);
                header('location: ' . URL . 'admin/users');
            }
        } else if (isset($_POST['reject_request'])) {
            $action_successful = $this->user_model->rejectNewUser();
            if ($action_successful == true) {
                $this->audit_model->set_log('Admin', 'User #' . $_POST['user_name'] . 'was rejected for activation. Therefore, the record to this user was deleted');
                header('location: ' . URL . 'admin/users');
            } else {
                $this->audit_model->set_log('Admin', 'Failed to reject details for user #' . $_POST['user_name']);
                header('location: ' . URL . 'admin/users');
            }
        } else if (isset($_POST['update_user'])) {
            $action_successful = $this->user_model->updateUser();
            if ($action_successful == true) {
                $this->audit_model->set_log('Admin', 'User #' . $_POST['user_name'] . ' modified and updated');
                header('location: ' . URL . 'admin/users');
            } else {
                $this->audit_model->set_log('Admin', 'Failed to modify details for user #' . $_POST['user_name']);
                header('location: ' . URL . 'admin/editUser/' . $_POST['user_id']);
            }
        } else if (isset($_POST['update_username'])) {
            $action_successful = $this->user_model->editUserName($_POST['user_id']);
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/users');
            } else {
                header('location: ' . URL . 'admin/editUser/' . $_POST['user_id']);
            }
        } else if (isset($_POST['update_useremail'])) {
            $action_successful = $this->user_model->editUserEmail();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/users');
            } else {
                header('location: ' . URL . 'admin/editUser/' . $_POST['user_id']);
            }
        } else {
            header('location: ' . URL . 'admin/users');
        }
    }
    
    function audit()
    {
        $au = $this->audit_model->get_logs();
        require View::header();
        require VIEWS_PATH . 'admin/audit/index.php';
        require View::footer();
    }
    
}
