<?php

    class Db {
        protected $dbName = "login_reg_pdo";
        protected $dbHost = "localhost";
        protected $dbUser = "root";
        protected $dbPass = "";
        protected $dbHandler, $dbStmt;

        /*
        @param null|void
        @return null|void
        @desc Creates or resume an existing database connection
        */

        public function __construct()
        {
            $Dsn = "mysql:host=" . $this->dbHost . ';dbname=' . $this->dbName;
            $Options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
            );

            try {
                $this->dbHandler = new PDO($Dsn, $this->dbUser, $this->dbPass, $Options);
            } catch (Exception $e) {
                var_dump('Couldn\'t Establish A Database Connection. Due to the following reason: ' . $e->getMessage());
            }
        }

        /*
        @param string
        @return null|void
        @desc Creates a PDO statement object
        */

        public function query($query) {
            $this->dbStmt = $this->dbHandler->prepare($query);
        }

        /*
        @param string|integer|
        @return null|void
        @desc Matches the correct datatype to the PDO Statement Object.
        */

        public function bind($param, $value, $type = null) {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value);
                        $type = PDO::PARAM_INT;
                    break;
                    case is_bool($value);
                        $type = PDO::PARAM_BOOL;
                    break;
                    case is_null($value);
                        $type = PDO::PARAM_NULL;
                    break;
                    default:
                        $type = PDO::PARAM_STR;
                    break;
                }
            }

            $this->dbStmt->bindValue($param, $value, $type);
        }

        /*
        @param null|void
        @return null|void
        @desc Executes a PDO Statement Object or a bd query...
        */

        public function execute() {
            $this->dbStmt->execute();
            return true;
        }

        /*
         * @param null|void
         * @return null|void
         * @desc Executes a PDO Statement Object an returns a single database record as an associative array...
        */

        public function fetch() {
            $this->esecute();
            return $this->dbStmt->fetch(PDO::FETCH_ASSOC);
        }

        /*
         * @param null|void
         * @return null|void
         * @desc Executes a PDO Statement Object an returns multiple database record as an associative array...
         */

        public function fetchAll() {
            $this->execute();
            return $this->dbStmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }