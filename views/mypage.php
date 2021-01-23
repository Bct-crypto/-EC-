<div class="container text-center" style="margin-bottom: 120px;">
    <main class="form">
        <form action="#" method="post">
            <img src="" alt="">

            <h1 class="h2 text-dark mb-3">MyPage</h1>

            <!-- Profile -->
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <?php if (!empty($userInfo['pic'])) : ?>
                            <img class="card-img-top" src="<?php echo sanitize($userInfo['pic']); ?>" alt="" style="height:100%; object-fit :cover;">
                        <?php else : ?>
                            <img class="card-img-top" src="img/sample-img.png" alt="" style="height: 100%; object-fit :cover;">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8 text-left">
                        <div class="card-body">
                            <h5 class="card-title">プロフィール</h5>
                            <p class="card-text">名前：<?php echo sanitize($userInfo['username']); ?></p>
                            <p class="card-text">年齢：<?php echo sanitize($userInfo['age']); ?></p>
                            <p class="card-text">Mail：<?php echo sanitize($userInfo['email']); ?></p>

                            <p class="card-text"><small class="text-muted">登録商品数：<?php echo $productData['total']; ?>件</small></p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 text-left">登録した商品</p>
            <div class="row">
                <?php if (!empty($productData['data'])) :  ?>
                    <!-- 取得した登録商品を展開する -->
                    <?php foreach ($productData['data'] as $key => $val) : ?>
                        <!-- ３種だけ登録商品を展開する　※ページを圧迫するため -->
                        <?php if ($loop >= 3) {
                            break;
                        } ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <?php if (!empty($val['pic'])) : ?>
                                    <img class="card-img-top" src="<?php echo sanitize($val['pic']); ?>" alt="" style="min-height: 200px;max-height: 200px; object-fit :cover;">
                                <?php else : ?>
                                    <img class="card-img-top" src="img/sample-img.png" alt="" style="min-height: 200px;max-height: 200px; object-fit :cover;">
                                <?php endif; ?>
                                <div class="card-body" style="min-height:240px; max-height: 240px;">
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
                        <?php $loop++; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="h4 my-2">登録商品なし</div>
                <?php endif; ?>
            </div>
            <a class="d-block mb-3 small text-right text-dark" href="myProductList.php">
                登録済の全ての商品をみる &gt;&gt;
            </a>


        </form>
    </main>

    <a href="listProduct.php" class="btn btn-warning btn-block mb-2">商品を登録する<i class="fas fa-gift ml-2"></i></a>

    <a href="profEdit.php" class="btn btn-info btn-block mb-2">プロフィールの編集<i class="far fa-address-card ml-2"></i></a>


    <a href="passEdit.php" class="btn btn-success btn-block mb-2">パスワード変更<i class="fas fa-key ml-2"></i></a>

    <a href="withdraw.php" class="btn btn-danger btn-block">退会ページ<i class="fas fa-dove ml-2"></i></a>

</div>
