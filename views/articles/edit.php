<div class="container">
    <h3 class="mb-3">Uredi novico</h3>
    <form action="/V2/articles/update" method="POST">
    <input type="hidden" name="id" value="<?php echo $article->id; ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($article) ? htmlspecialchars($article->title) : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="abstract" class="form-label">Opis</label>
            <input type="text" class="form-control" id="abstract" name="abstract" value="<?php echo isset($article) ? htmlspecialchars($article->abstract) : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label" >Vsebina</label>
            <input type="text" class="form-control" id="text" name="text" value="<?php echo isset($article) ? htmlspecialchars($article->text) : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="post">Objavi</button>
         <label class="text-danger"><?php echo $error; ?></label>
    </form>
</div>