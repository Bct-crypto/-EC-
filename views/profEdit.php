<div class="container">
    <main class="form">
        <form action="#" method="post" enctype="multipart/form-data">
            <img src="" alt="">

            <h1 class="h2 text-dark mb-3 text-center">プロフィール編集</h1>
            <div class="area-msg text-danger">
                <?php if (!empty($errMsg)) : ?>
                    <?php echo $errMsg['common']; ?>
                <?php endif; ?>
            </div>

            <!-- Photo -->
            <!-- <label for="inputPhoto" class="">プロフィール写真</label>
            <div class="profPhoto form-control">
                <img src="" alt="">
                <input type="file" class="">
            </div> -->

            <!-- Name -->
            <label for="inputName" class="">名前<span class="ml-3 text-danger"><?php if (!empty($errMsg['pass'])) echo $errMsg['username']; ?></span></label>
            <input type="text" name="username" id="inputName" class="form-control mb-3" placeholder="" value="<?php if (!empty($_POST['username'])) echo $_POST['username']; ?>" autofocus>

            <!-- Age -->
            <label for="inputAge" class="">年齢<span class="ml-3 text-danger"><?php if (!empty($errMsg['age'])) echo $errMsg['age']; ?></span></label>
            <input type="number" name="age" id="inputAge" class="form-control mb-3" placeholder="※半角数字のみ">

            <!-- Tel -->
            <label for="inputTel" class="">電話番号<span class="ml-3 text-danger"><?php if (!empty($errMsg['tel'])) echo $errMsg['tel']; ?></span></label>
            <input type="text" name="tel" id="inputTel" class="form-control mb-3" placeholder="※ハイフンなしで入力ください">

            <!-- Age -->
            <label for="inputZip" class="">郵便番号<span class="ml-3 text-danger"><?php if (!empty($errMsg['zip'])) echo $errMsg['zip']; ?></span></label>
            <input type="text" name="zip" id="inputZip" class="form-control mb-3" placeholder="※ハイフンなしで入力ください">

            <!-- Addr -->
            <label for="inputAddr" class="">住所<span class="ml-3 text-danger"><?php if (!empty($errMsg['addr'])) echo $errMsg['addr']; ?></span></label>
            <input type="text" name="addr" id="inputAddr" class="form-control mb-3" placeholder="">

            <!-- Email -->
            <label for="inputEmail" class="">メールアドレス<span class="ml-3 text-danger"><?php if (!empty($errMsg['email'])) echo $errMsg['email']; ?></span></label>
            <input type="email" name="email" id="inputEmail" class="form-control mb-3" placeholder="">

            <button type="submit" class="btn btn-lg btn-block btn-primary">編集内容を更新する</button>
        </form>
    </main>
</div>
