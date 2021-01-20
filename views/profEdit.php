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

            <div class="row">

                <div class="col-md-4">
                    <!-- 写真 -->
                    <label for="pic" class="">プロフィール画像<span class="ml-3 text-danger"><?php if (!empty($errMsg['pic'])) echo $errMsg['pic']; ?></span></label>
                    <input type="file" class="form-control-file mb-5" id="pic" name="pic">
                    <?php if (!empty($p_id)) : ?>
                        <img src="<?php getFormData('pic'); ?>" alt="" class="img-rounded d-block mx-auto mb-3" style="width:200px;">
                    <?php else : ?>
                        <img src="img/no-image.png" alt="" class="img-rounded d-block mx-auto mb-3" style="width:200px;">
                    <?php endif; ?>
                </div>

                <div class="col-md-8">

                    <!-- Name -->
                    <label for="inputName" class="">名前<span class="ml-3 text-danger"><?php if (!empty($errMsg['pass'])) echo $errMsg['username']; ?></span></label>
                    <input type="text" name="username" id="inputName" class="form-control mb-3" placeholder="" value="<?php echo getFormData('username'); ?>" autofocus>

                    <!-- Age -->
                    <label for="inputAge" class="">年齢<span class="ml-3 text-danger"><?php if (!empty($errMsg['age'])) echo $errMsg['age']; ?></span></label>
                    <input type="text" name="age" id="inputAge" class="form-control mb-3" placeholder="※半角数字のみ" value="<?php if (!empty($dbFormData['age'])) echo $dbFormData['age']; ?>">

                    <!-- Tel -->
                    <label for="inputTel" class="">電話番号<span class="ml-3 text-danger"><?php if (!empty($errMsg['tel'])) echo $errMsg['tel']; ?></span></label>
                    <input type="text" name="tel" id="inputTel" class="form-control mb-3" placeholder="※ハイフンなしで入力ください" value="<?php if (!empty($dbFormData['tel'])) echo $dbFormData['tel']; ?>">

                    <!-- Age -->
                    <label for="inputZip" class="">郵便番号<span class="ml-3 text-danger"><?php if (!empty($errMsg['zip'])) echo $errMsg['zip']; ?></span></label>
                    <input type="text" name="zip" id="inputZip" class="form-control mb-3" placeholder="※ハイフンなしで入力ください" value="<?php if (!empty($dbFormData['zip'])) echo $dbFormData['zip']; ?>">

                    <!-- Addr -->
                    <label for="inputAddr" class="">住所<span class="ml-3 text-danger"><?php if (!empty($errMsg['addr'])) echo $errMsg['addr']; ?></span></label>
                    <input type="text" name="addr" id="inputAddr" class="form-control mb-3" placeholder="" value="<?php if (!empty($dbFormData['addr'])) echo $dbFormData['addr']; ?>">

                    <!-- Email -->
                    <label for="inputEmail" class="">メールアドレス<span class="ml-3 text-danger"><?php if (!empty($errMsg['email'])) echo $errMsg['email']; ?></span></label>
                    <input type="email" name="email" id="inputEmail" class="form-control mb-3" placeholder="" value="<?php if (!empty($dbFormData['email'])) echo $dbFormData['email']; ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-lg btn-block btn-primary mb-5">編集内容を更新する</button>
        </form>
    </main>
</div>
