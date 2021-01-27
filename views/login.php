<div class="container">
    <main class="form-signIn">
        <form action="#" method="post">

            <h1 class="h2 text-dark mb-3 text-center">ログイン</h1>
            <div class="area-msg text-danger">
                <?php if (!empty($errMsg)) : ?>
                    <?php echo $errMsg['common']; ?>
                <?php endif; ?>
            </div>

            <label for="inputEmail" class="">E-mail<span class="ml-3 text-danger"><?php if (!empty($errMsg['pass'])) echo $errMsg['email']; ?></span></label>
            <input type="email" name="email" id="inputEmail" class="form-control mb-3" placeholder="Emailアドレス" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>" autofocus>

            <label for="inputPass" class="">パスワード<span class="ml-3 text-danger"><?php if (!empty($errMsg['pass'])) echo $errMsg['pass']; ?></span></label>
            <input type="password" name="pass" id="inputPass" class="form-control mb-3" placeholder="パスワード">

            <div class="form-check mb-3">
                <input class="form-check-input" name="pass_save" type="checkbox" value="remember-me" id="rememberCheck">
                <label class="form-check-label float-start" for="rememberCheck">
                    ログイン状態を保持する
                </label>
            </div>

            <button type="submit" class="btn btn-lg btn-block btn-primary">サインイン</button>
        </form>
    </main>
</div>
