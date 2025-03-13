<?php
/*
    Controller za novice. Vključuje naslednje standardne akcije:
        index: izpiše vse novice
        show: izpiše posamezno novico

    TODO:
        list: izpiše novice prijavljenega uporabnika
        create: izpiše obrazec za vstavljanje novice
        store: vstavi novico v bazo
        edit: izpiše vmesnik za urejanje novice
        update: posodobi novico v bazi
        delete: izbriše novico iz baze
*/

class articles_controller
{
    public function index()
    {
        //s pomočjo statične metode modela, dobimo seznam vseh novic
        //$ads bo na voljo v pogledu za vse oglase index.php
        $articles = Article::all();

        //pogled bo oblikoval seznam vseh oglasov v html kodo
        require_once('views/articles/index.php');
    }

    public function edit(){

        $error = "";
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case 1: $error = "Izpolnite vse podatke"; break;
                case 2: $error = "Prišlo je do napake med objavo novice.";
                default: $error = "Prišlo je do napake med objavo novice.";
            }
        }

        if (!isset($_GET['id'])) {
            return call('pages', 'error'); //če ne, kličemo akcijo napaka na kontrolerju stran
            //retun smo nastavil za to, da se izvajanje kode v tej akciji ne nadaljuje
        }

        $article = Article::find($_GET['id']);
        require_once('views/articles/edit.php');
    }

    public function update(){
        if(empty($_POST["title"]) || empty($_POST["abstract"]) || empty($_POST["text"])){
            header("Location: /V2/articles/edit?id=".$_GET['id']."&error=1");
        } else {
            if(isset($_SESSION['USER_ID'])){
                $articleId = intval($_POST["id"]);
                $userId = $_SESSION['USER_ID'];

                if(Article::update($articleId, $_POST["title"], $_POST["abstract"], $_POST["text"], $userId)){
                    header("Location: /V2/articles/myArticles");
                    die();
                } else {
                    header("Location: /V2/articles/edit?id=".$_GET['id']."&error=2");
                }
            }
        }
    }

public function delete(){
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }

    $article = Article::find($_GET['id']);

        if (Article::delete($article->id, $_SESSION['USER_ID'])) {
            header("Location: /V2/articles/myArticles");
            exit();
        } else {
            echo "Napaka pri brisanju.";
        }
    }


    public function show()
    {
        //preverimo, če je uporabnik podal informacijo, o oglasu, ki ga želi pogledati
        if (!isset($_GET['id'])) {
            return call('pages', 'error'); //če ne, kličemo akcijo napaka na kontrolerju stran
            //retun smo nastavil za to, da se izvajanje kode v tej akciji ne nadaljuje
        }
        //drugače najdemo oglas in ga prikažemo
        $article = Article::find($_GET['id']);
        require_once('views/articles/show.php');
    }

    public function create(){
        $error = "";
        if(isset($_GET["error"])){
            switch($_GET["error"]){
                case 1: $error = "Izpolnite vse podatke"; break;
                case 2: $error = "Prišlo je do napake med objavo novice.";
                default: $error = "Prišlo je do napake med objavo novice.";
            }
        }
        require_once('views/articles/create.php');
    }

    public function myArticles(){
        if (!isset($_SESSION['USER_ID'])) {
            return call('pages', 'error');
        }

        $userId = $_SESSION['USER_ID'];
        $articles = Article::findMine($userId);

        require_once('views/articles/myArticles.php');
    }

public function store(){
        if(empty($_POST["title"]) || empty($_POST["abstract"]) || empty($_POST["text"])){
            header("Location: /V2/articles/create?error=1");
        } else {
            if(isset($_SESSION['USER_ID'])){
                $userId = $_SESSION['USER_ID'];

                if(Article::create($_POST["title"], $_POST["abstract"], $_POST["text"], $userId)){
                    header("Location: /V2/");
                    die();
                } else {
                    header("Location: /V2/articles/create?error=2");
                }
            }
        }
    }
}