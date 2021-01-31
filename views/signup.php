<div class="container">
    <main class="form-signIn">
        <form action="" method="post">
            <img src="" alt="">

            <h1 class="h2 text-dark text-center mb-3">新規登録</h1>

            <div class="form-group">
                <label for="inputEmail">E-mail<span id="errMsg" class="ml-3 text-danger"><?php if (!empty($errMsg['email'])) echo $errMsg['email']; ?></span></label>
                <input type="text" name="email" id="inputEmail" class="form-control mb-3" placeholder="Emailアドレス" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>" autofocus>
            </div>

            <div class="form-group">
                <label for="inputPass">Password<span id="errMsg" class="ml-3 text-danger"><?php if (!empty($errMsg['pass'])) echo $errMsg['pass']; ?></span></label>
                <input type="password" name="pass" id="inputPass" class="form-control mb-3" placeholder="パスワード">
            </div>

            <div class="form-group">
                <label for="inputPassRetype">Password_Retype<span id="errMsg" class="ml-3 text-danger"><?php if (!empty($errMsg['pass_re'])) echo $errMsg['pass_re']; ?></span></label>
                <input type="password" name="pass_re" id="inputPassRetype" class="form-control mb-3" placeholder="パスワード（再入力）">
            </div>

            <button type="submit" class="btn btn-lg btn-block btn-primary">新規登録</button>
        </form>
    </main>
</div>
