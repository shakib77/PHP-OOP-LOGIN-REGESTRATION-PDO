<?php
    require_once (__DIR__ . '/Db.php');

    class DashboardModel extends Db {

        /*
         * @param null
         * return array
         * desc Returns an array of news...
        */

        public function fetchNews() :array {
            $this->query('select * from `db_news` order by `id` desc');
            $this->execute();
            $News = $this->fetchAll();

            if(count($News) > 0) {
                $Response = array(
                    'status' => true,
                    'data' => $News
                );
                return $Response;
            }

            $Response = array(
                'status' =>false,
                'data' => []
            );
            return $Response;
        }
    }