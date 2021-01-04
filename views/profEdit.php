<div class="container">
    <main class="form">
        <form action="#" method="post">
            <img src="" alt="">

            <h1 class="h2 text-dark mb-3 text-center">プロフィール編集</h1>
            <div class="area-msg text-danger">
                <?php if (!empty($errMsg)) : ?>
                    <?php echo $errMsg['common']; ?>
                <?php endif; ?>
            </div>

            <!-- Name -->
            <label for="inputName" class="">名前<span class="ml-3 text-danger"><?php if (!empty($errMsg['pass'])) echo $errMsg['username']; ?></span></label>
            <input type="text" name="username" id="inputName" class="form-control mb-3" placeholder="Your Name" value="<?php if (!empty($_POST['username'])) echo $_POST['email']; ?>" autofocus>

            <!-- Age -->
            <label for="inputPass" class="">年齢<span class="ml-3 text-danger"><?php if (!empty($errMsg['pass'])) echo $errMsg['pass']; ?></span></label>
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
