<?php
    require_once (__DIR__ . './Db.php');

    class PostsModel extends Db {

        public function createPosts (array $posts): array
        {
            $this->query("INSERT INTO `db_news` (title, content) VALUES (:title, :content)");
            $this->bind('title', $posts['title']);
            $this->bind('content', $posts['content']);

            if($this->execute()) {
                $Response = array(
                    'status' => true
                );
                return $Response;
            } else {
                $Response = array(
                    'status' => false
                );
                return $Response;
            }
        }

        public function fetchPosts(string $title) :array {
            $this->query("SELECT * FROM `db_news` where `title` = :title");
            $this->bind('title', $title);
            $this->execute();

            $Posts = $this->fetch();
            if(!empty($Posts)) {
                $Response = array(
                    'status' => true,
                    'data' => $Posts
                );
                return $Response;
            }

            return array(
                'status' => false,
                'data' => []
            );
        }
    }