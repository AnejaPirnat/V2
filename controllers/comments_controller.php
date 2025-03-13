<?php

class comments_controller{
    public function showAll()
    {
        $comments = Comment::all();
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
        require_once('views/comments/create.php');
    }

public function store(){
        if(empty($_POST["text"])){
            header("Location: /V2/comments/create?error=1");
        } else {
            if(isset($_SESSION['USER_ID'])){
                $userId = $_SESSION['USER_ID'];
                $articleId = intval($_POST["id"]);

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