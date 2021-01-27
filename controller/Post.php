<?php
require_once(__DIR__ . './Controller.php');
require_once('./Model/PostModel.php');

class Posts extends Controller
{

    public $active = 'Posts';
    private $postsModel;

    public function __construct()
    {

        if (!isset($_SESSION['auth_status'])) {
            header('location: index.php');
        }
        $this->postsModel = new PostsModel();
    }

    public function posts(array $data)
    {
        $title = stripcslashes(strip_tags($data['title']));
        $content = stripcslashes(strip_tags($data['content']));

        $PostsStatus = $this->postsModel->fetchPosts($title)['status'];

        $Error = array(
            'title' => '',
            'content' => '',
            'status' => false
        );

        if (preg_match('/[^A-Za-z\b]/', $content)) {
            $Error['content'] = 'Sorry, Only Alphabets are allowed';
        }

        if (!empty($PostsStatus)) {
            $Error['title'] = 'Sorry, Can not repeat same News';
            return $Error;
        }

        $Payload = array(
            'title' => $title,
            'content' => $content
        );

        $Response = $this->postsModel->createPosts($Payload);

        $Data = $this->postsModel->fetchPosts($title)['data'];

        if (!$Response['status']) {
            $Response ['status'] = 'Sorry, An unexpected error occurred.';
            return $Response;
        }

        $_SESSION['data'] = $Data;
        $_SESSION['auth_status'] = true;
        header('Location: dashboard.php');
        return true;
    }
}