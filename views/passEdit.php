<div class="container">
    <main class="form-signIn">
        <form action="" method="post">
            <img src="" alt="">

            <h1 class="h2 text-dark text-center mb-3">パスワード変更</h1>

            <div class="form-group">
                <label for="inputPass_old">古いパスワード<span class="ml-3 text-danger position-absolute"><?php if (!empty($errMsg['pass_old'])) echo $errMsg['pass_old']; ?></span></label>
                <input type="password" name="pass_old" id="inputPass_old" class="form-control mb-3 " placeholder="登録しているパスワードを入力" value="<?php if (!empty($_POST['pass_old'])) echo $_POST['pass_old']; ?>" autofocus>
            </div>

            <div class="form-group">
                <label for="inputPass_new">新しいパスワード<span class="ml-3 text-danger position-absolute"><?php if (!empty($errMsg['pass_new'])) echo $errMsg['pass_new']; ?></span></label>
                <input type="password" name="pass_new" id="inputPass_new" class="form-control mb-3" placeholder="半角英数字の6文字以上で入力">
            </div>

            <div class="form-group">
                <label for="inputPass_Re">パスワード（再入力）<span class="ml-3 text-danger position-absolute"><?php if (!empty($errMsg['pass_re'])) echo $errMsg['pass_re']; ?></span></label>
                <input type="password" name="pass_re" id="inputPass_Re" class="form-control mb-3" placeholder="同様の新しいパスワードを入力">
            </div>

            <button type="submit" class="btn btn-lg btn-block btn-primary">パスワードを変更する</button>
        </form>
    </main>
</div>
