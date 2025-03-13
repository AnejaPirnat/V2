<?php

require_once 'users.php';
require_once 'articles.php';

class Comment{
    public $id;
    public $text;
    public $date;
    public $user;
    public $article;

    public function __construct($id, $text, $date, $user_id, $article_id)
    {
        $this->id = $id;
        $this->text = $text;
        $this->date = $date;
        $this->user = User::find($user_id); //naložimo podatke o uporabniku
        $this->article = Article::find($article_id);
    }

public static function all()
    {
        $db = Db::getInstance(); // pridobimo instanco baze
        $query = "SELECT * FROM comments;"; // pripravimo query
        $res = $db->query($query); // poženemo query
        $comments = array();
        while ($comment = $res->fetch_object()) {
            // Za vsak rezultat iz baze ustvarimo objekt (kličemo konstuktor) in ga dodamo v array $articles
            array_push($comments, new Comment($comment->id, $comment->text, $comment->date, $comment->user_id, $comment->article_id));
        }
        return $comments;
    }

public static function create($text, $userId, $articleId){
        $db = Db::getInstance();
        $text = mysqli_real_escape_string($db, $text);
        $userId = intval($userId);
        $articleId = intval($articleId);

        $query = "INSERT INTO comments(text, user_id, article_id) VALUES ('$text', $userId, $articleId);";
        if($db->query($query)){
            return true;
        }
        else{
            echo mysqli_error($db);
            return false;
        }
    }

/*public static function delete($id, $userId, $articleId){
        $db = Db::getInstance();
        $id = intval($id);
        $userId = intval($userId);
        $articleId = intval($articleId);

        $query = "DELETE FROM comments WHERE id='$id' AND user_id='$userId' AND article_id='$articleId'";
        if ($db->query($query)) {
            return true;
        } else {
            echo mysqli_error($db);
            return false;
        }
    }*/

public static function find($id)
    {
        $db = Db::getInstance();
        $id = mysqli_real_escape_string($db, $id);
        $query = "SELECT * FROM comments WHERE id = '$id';";
        $res = $db->query($query);
        if ($comment = $res->fetch_object()) {
            return new Comment($comment->id, $comment->text, $comment->date, $comment->user_id, $comment->article_id);
        }
        return null;
    }
}