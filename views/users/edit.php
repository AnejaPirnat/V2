<div class="container">
    <h3 class="mb-3">Registracija</h3>
    <form action="/V2/users/update" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Vzdevek</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-pošta</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>">
        </div>
           <div class="mb-3">
            <label for="password" class="form-label">Staro geslo</label>
            <input type="password" class="form-control" id="old_password" name="old_password" value="">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Novo geslo</label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Ponovi geslo</label>
            <input type="password" class="form-control" id="repeat_password" name="repeat_password" value="">
        </div>
        <button type="submit" class="btn btn-primary" name="register">Shrani</button>
        <label class="text-danger"><?php echo $error; ?></label>
    </form>
</div>