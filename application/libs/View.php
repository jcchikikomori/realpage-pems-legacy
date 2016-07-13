<?php

class View
{
    // PAGED LIST
    public static function PagedList($start, $limit)
    {
        if (isset($_GET['page'])) {
            if ($_GET['page'] == NULL) {
                header('location: ' . URL . 'error');
            } else {
                $id = $_GET['page'];
                $start = ($id - 1) * $limit;
            }
        } else {
            $start = STARTING_PAGE;
            $limit = ITEM_PER_PAGE;
        }
    }

    public static function pagination()
    {
        // One-time Init Pagination
        $start = STARTING_PAGE;
        $limit = ITEM_PER_PAGE;
        if (isset($_GET['page'])) {
            if ($_GET['page'] == NULL) {
                header('location: ' . URL . 'error');
            } else {
                $id = $_GET['page'];
                $start = ($id - 1) * $limit;
            }
        } else {
            $id = STARTING_PAGE;
        }
    }
    
    public static function detectUser() {
        Session::init();
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_users/admin.php'; exit;
        } else if (isset($_SESSION['user_logged_in'])) {
            require VIEWS_PATH . '_users/user.php'; exit;
        } else {
            require VIEWS_PATH . '_users/default.php';
        }
    }
    
    public static function adminMode() {
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
    }

    /**
     * @param $module
     * @return string
     */
    public static function header($module = null) {
        if (isset($_SESSION['admin_logged_in']) OR isset($_SESSION['user_logged_in'])) {
            return HEADER . 'system.php';
        } else if (isset($module)) {
            return ($module == 'empty' ? TEMPLATES . 'null_header' : HEADER . $module) . '.php';
        }
    }

    /**
     * @param $module
     * @return string
     */
    public static function footer($module = null) {
        if (isset($_SESSION['admin_logged_in']) OR isset($_SESSION['user_logged_in'])) {
            return FOOTER . 'system.php';
        } else if (isset($module)) {
            return ($module == 'empty' ? TEMPLATES . 'null_footer' : FOOTER . $module) . '.php';
        }
    }

    public static function adminLogo() {
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_users/header/admin_logo.php';
        }
    }
    
    public static function logout() {
        if (!isset($_SESSION['admin_logged_in'])) {
            //if (isset($_SESSION['SOM_user_logged_in'])) {
            //    require VIEWS_PATH . '_users/header/som_logout.php';
            //}
        } else if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_users/header/admin_logout.php';
        }
    }
    
}
