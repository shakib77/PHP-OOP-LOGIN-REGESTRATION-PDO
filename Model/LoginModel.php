<?php
    require_once (__DIR__. '/Db.php');

    class LoginModel extends Db {

        /*
         * @param string
         * @return array
         * desc Returns a user record based on the method parameter...
        */

        public function fethcEmail($string, $email) :array {
            $this->query("select * from `db_user` where `email` = :email");
            $this->bind('email', $email);
            $this->execute();

            $Email = $this->fetch();

            if(empty($Email)) {
                $Response = array(
                    'status' =>true,
                    'data' =>$Email
                );

                return $Response;
            }

            if (!empty($Email)) {
                $Response = array(
                    'status' =>false,
                    'data' => $Email
                );
            }
        }
    }