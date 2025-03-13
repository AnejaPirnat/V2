<div class="container">
<br>
    <h4 class="mb-3">Komentiraj</h4>
    <form action="/V2/comments/store" method="POST">
    <input type="hidden" name="id" value="<?php echo $article->id; ?>">
        <div class="mb-3">
            <input type="text" class="form-control" id="text" name="text" value="<?php echo isset($_POST["text"]) ? $_POST["text"]: ""; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="post">Objavi</button>
        <label class="text-danger"><?php echo $error; ?></label>
    </form>
</div>