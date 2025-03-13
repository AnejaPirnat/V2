<?php

class comments_controller{

    public function showAll() {
        $articleId = intval($_GET['id']);
        $comments = Comment::findByArticle($articleId);
        require_once('views/comments/show.php');
    }

public function create(){
        $error = "";
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case 1: $error = "Izpolnite vse podatke"; break;
                case 2: $error = "Prišlo je do napake med objavo novice."; break;
                default: $error = "Prišlo je do napake med objavo novice.";
            }
        }
         if (!isset($_GET['id'])) {
        return call('pages', 'error');
    }

    $article = Article::find($_GET['id']);
         require_once('views/comments/create.php');
    }

public function store(){
        $articleId = intval($_POST["id"]);
        if(empty($_POST["text"])){
            header("Location: /V2/articles/show?id=" . $articleId);
        } else {
            if(isset($_SESSION['USER_ID'])){
                $userId = $_SESSION['USER_ID'];

                if(Comment::create($_POST["text"], $userId, $articleId)){
                    header("Location: /V2/articles/show?id=" . $articleId);
                    die();
                } else {
                    header("Location: /V2/comments/create?error=2");
                }
            }
        }
    }
}
?>