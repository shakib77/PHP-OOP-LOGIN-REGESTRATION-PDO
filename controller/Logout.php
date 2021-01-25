<?php
    require_once (__DIR__ . '/Controller.php');

    class Logout extends Controller {

        /*
         * @param null|void
         * @return null|void
         * @desc Destroys the application and redirects to the login page...
         */

        public function __construct()
        {
            session_destroy();
            header('Location: index.php');
        }
    }