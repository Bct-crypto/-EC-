<div class="container">
    <main class="form">
        <form action="#" method="post" enctype="multipart/form-data">

            <h1 class="h2 text-dark mb-3 text-center">
                <?php if (!empty($_GET['p_id'])) : ?>
                    商品編集ページ
                <?php else : ?>
                    商品登録ページ
                <?php endif; ?>
            </h1>

            <div class="area-msg text-danger">
                <?php if (!empty($errMsg)) : ?>
                    <?php echo $errMsg['common']; ?>
                <?php endif; ?>
            </div>

            <!-- 商品名 -->
            <label for="name" class="">商品名<span class="ml-3 text-danger"><?php if (!empty($errMsg['name'])) echo $errMsg['name']; ?></span></label>
            <input type="text" name="name" id="name" class="form-control mb-3" placeholder="※必須項目" value="<?php echo getFormData('name'); ?>" autofocus>

            <!-- カテゴリ -->
            <label for="category" class="">カテゴリ<span class="ml-3 text-danger"><?php if (!empty($errMsg['category_id'])) echo $errMsg['category_id']; ?></span></label>
            <input type="text" name="category_id" id="category_id" class="form-control mb-3" placeholder="※必須項目" value="<?php echo getFormData('category_id'); ?>">

            <!-- 詳細 -->
            <label for="comment" class="">商品詳細<span class="ml-3 text-danger"><?php if (!empty($errMsg['comment'])) echo $errMsg['comment']; ?></span></label>
            <textarea name="comment" id="comment" rows="5" class="form-control mb-3"><?php echo getFormData('comment'); ?></textarea>

            <!-- 価格 -->
            <label for="price" class="">価格<span class="ml-3 text-danger"><?php if (!empty($errMsg['price'])) echo $errMsg['price']; ?></span></label>
            <input type="text" name="price" id="price" class="form-control mb-3" placeholder="※必須項目" value="<?php echo getFormData('price'); ?>">

            <!-- 写真 -->
            <label for="pic" class="">商品画像<span class="ml-3 text-danger"><?php if (!empty($errMsg['pic'])) echo $errMsg['pic']; ?></span></label>
            <input type="file" class="form-control-file mb-3" id="pic">
            <?php if (!empty($p_id)) : ?>
                <img src="<?php getFormData('pic'); ?>" alt="" class="img-rounded d-block mx-auto mb-3" style="width:250px;">
            <?php else : ?>
                <img src="img/sample01.jpg" alt="" class="img-rounded d-block mx-auto mb-3" style="width:250px;">
            <?php endif; ?>

            <button type="submit" class="btn btn-lg btn-block btn-primary">
                <?php echo (!$editFlg) ? '出品登録する' : '編集内容を更新する'; ?>
            </button>
        </form>
    </main>
</div>
