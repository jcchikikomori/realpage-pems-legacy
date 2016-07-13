<?php

class Users extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        // this controller should only be visible/usable by logged in users, so we put login-check here
        $this->captcha_model = $this->loadModel('Captcha');
    }
        
    // ACTIONS/CONTROLLER

    /**
    public function forgot()
    {
        Auth::handleLogin();
        $branches = $this->branch_model->getBranches();
        $usertypes = $this->user_model->getUsertype();
        require TEMPLATES . 'null_header.php';
        require APP . 'view/password/forgot.php';
        require TEMPLATES . 'null_footer.php';
        exit;
    }
    **/
    
    /**
    public function reset()
    {
        $branches = $this->branch_model->getBranches();
        require TEMPLATES . 'null_header.php';
        require APP . 'view/password/reset.php';
        require TEMPLATES . 'null_footer.php';
    }
    **/
    
    /**
     * Verify the verification token of that user (to show the user the password editing view or not)
     * @param string $user_name username
     * @param string $verification_code password reset verification token
     */
    function verifyPasswordReset($user_name, $verification_code)
    {
        Auth::handleLogin();
        if ($this->user_model->verifyPasswordReset($user_name, $verification_code)) {
            $this->resetPassword($user_name, $verification_code);
        } else {
            header('location: ' . URL);
        }
    }

    // AFTER verifying PASSWORD RESET ID (if true)
    private function resetPassword($user_name, $reset_hash) {
        $this->user_name = $user_name;
        $this->user_password_reset_hash = $reset_hash;
        require TEMPLATES . 'null_header.php';
        require APP . 'view/password/change.php';
        require TEMPLATES . 'null_footer.php';
        exit;
    }
    
    public function passAction()
    {
        if (isset($_POST['submit_request'])) {
            $action_successful = $this->user_model->requestPasswordReset();
            if ($action_successful == true) {
                header('location: ' . URL);
            } else {
                $this->forgot();
            }
        } else if (isset($_POST['submit_new_password'])) {
            $action_successful = $this->user_model->setNewPassword();
            if ($action_successful == true) {
                header('location: ' . URL);
            } else {
                $this->verifyPasswordReset($_POST['user_name'], $_POST['user_password_hash']);
            }
        }
    }

    function verify($user_id, $user_activation_verification_code)
    {
        if (isset($user_id) && isset($user_activation_verification_code)) {
            $this->user_model->verifyNewUser($user_id, $user_activation_verification_code);
            header('location: ' . URL);
        } else {
            header('location: ' . URL);
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
}
