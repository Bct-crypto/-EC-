<div class="container">
    <h1 class="h2 text-dark mt-3 mb-3 text-center">
        商品詳細ページ
    </h1>

    <div class="area-msg text-danger">
        <?php if (!empty($errMsg)) : ?>
            <?php echo $errMsg['common']; ?>
        <?php endif; ?>
    </div>

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?php if (!empty($viewData['pic'])) : ?>
                    <img class="card-img-top" src="<?php echo sanitize($viewData['pic']); ?>" alt="" style="min-height: 200px;object-fit :cover;">
                <?php else : ?>
                    <img class="card-img-top" src="img/sample-img.png" alt="" style="min-height: 220px; object-fit :cover;">
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">商品名：<?php echo sanitize($viewData['name']); ?></h5>
                    <p class="card-text">カテゴリ：<?php echo sanitize($viewData['category']); ?></p>
                    <p class="card-text">コメント：<?php echo sanitize($viewData['comment']); ?></p>

                    <p class="card-text">料　　金：<?php echo sanitize($viewData['price']); ?>円</p>
                    <p class="card-text"><small class="text-muted">最終更新日：<?php echo sanitize(date('Y年n月j日', strtotime($viewData['update_date']))); ?></small></p>
                </div>
            </div>
        </div>
    </div>


    <form action="" method="POST">
        <div class="d-flex justify-content-between">
            <a class="btn btn-primary text-dark" href="index.php<?php echo appendGetParam(array('p_id')); ?>">&lt; 商品一覧に戻る</a>
            <input type="submit" value="&#xf157; 購入する" name="submit" class="fas btn btn-warning text-dark">
        </div>
    </form>
</div>
