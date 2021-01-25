<?php
    require_once (__DIR__ . '/Db.php');

    class RegisterModel extends Db {

        /*
         * @param array
         * @return array
         * @desc Creates and returns a user records...
        */

        public function createUser(array $user) :array {
            $this->query('insert into `db_user` (name, email, phone_no, password) values (:name, :email, :phone_no, :password)');
            $this->bind('name', $user['name']);
            $this->bind('email', $user['email']);
            $this->bind('phone_no', $user['phone']);
            $this->bind('password', $user['password']);

            if($this->execute()) {
                $Response = array(
                    'status' =>true
                );
            } else {
                $Response = array(
                    'status' => false
                );

                return $Response;
            }
        }

        /*
         * @param string
         * @return array
         * desc Returns a user record based on the method parameter...
        */

        public function fethcUser(string $email) :array {
            $this->query('select * from `db_user` where `email` = :email');
            $this->bind('email', $email);
            $this->execute();

            $User = $this->fetch();
            if (!empty($User)) {
                $Response = array(
                    'status' => true,
                    'data' => $User
                );

                return $Response;
            }

            return array(
                'status' => false,
                'data' => []
            );
        }
    }