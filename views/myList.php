<div class="container text-center" style="margin-bottom: 120px;">
    <main class="form">
        <form action="#" method="post">
            <h1 class="h2 text-dark my-3">お気に入り・登録商品一覧</h1>
            <!-- お気に入り -->
            <p class="h4 text-left mb-2">お気に入り一覧</p>
            <div class="row">
                <?php if (!empty($favoriteData)) :  ?>
                    <!-- 取得した登録商品を展開する -->
                    <?php foreach ($favoriteData as $key => $val) : ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <?php if (!empty($val['pic'])) : ?>
                                    <img class="card-img-top" src="<?php echo sanitize($val['pic']); ?>" alt="" style="min-height: 150px;max-height: 150px; object-fit :cover;">
                                <?php else : ?>
                                    <img class="card-img-top" src="img/sample-img.png" alt="" style="min-height: 200px;max-height: 200px; object-fit :cover;">
                                <?php endif; ?>
                                <div class="card-body" style="min-height:150px; max-height: 200px;">
                                    <h5 class="card-title"><?php echo sanitize($val['name']); ?></h5>
                                    <p class="card-text"><?php echo sanitize(mb_substr($val['comment'], 0, 10)); ?>...</p>
                                    <p class="card-text">¥<?php echo sanitize($val['price']); ?>円</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="productDetail.php<?php echo (!empty(appendGetParam())) ? appendGetParam() . '&p_id=' . $val['id'] : '?p_id=' . $val['id']; ?>" class="btn btn-sm btn-outline-secondary text-dark">詳細</a>
                                        </div>
                                        <small class="text-muted">最終更新：<?php echo sanitize(date('Y年n月j日', strtotime($val['update_date']))); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $likeLoop++; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="h4 my-2">お気に入り登録なし</div>
                <?php endif; ?>
            </div>

            <!-- 登録した商品 -->
            <p class="h4 text-left mb-2">登録した商品</p>
            <div class="row">
                <?php if (!empty($productData['data'])) :  ?>
                    <!-- 取得した登録商品を展開する -->
                    <?php foreach ($productData['data'] as $key => $val) : ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <?php if (!empty($val['pic'])) : ?>
                                    <img class="card-img-top" src="<?php echo sanitize($val['pic']); ?>" alt="" style="min-height: 150px;max-height: 150px; object-fit :cover;">
                                <?php else : ?>
                                    <img class="card-img-top" src="img/sample-img.png" alt="" style="min-height: 200px;max-height: 200px; object-fit :cover;">
                                <?php endif; ?>
                                <div class="card-body" style="min-height:200px; max-height: 200px;">
                                    <h5 class="card-title"><?php echo sanitize($val['name']); ?></h5>
                                    <p class="card-text"><?php echo sanitize(mb_substr($val['comment'], 0, 10)); ?>...</p>
                                    <p class="card-text">¥<?php echo sanitize($val['price']); ?>円</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="listProduct.php<?php echo (!empty(appendGetParam())) ? appendGetParam() . '&p_id=' . $val['id'] : '?p_id=' . $val['id']; ?>" class="btn btn-sm btn-outline-secondary text-dark">詳細</a>
                                        </div>
                                        <small class="text-muted">最終更新：<?php echo sanitize(date('Y年n月j日', strtotime($val['update_date']))); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $productLoop++; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="h4 my-2">登録商品なし</div>
                <?php endif; ?>
            </div>
        </form>

        <a href="mypage.php" class="btn btn-info btn-inline-block text-left">戻る</a>

    </main>
</div>
