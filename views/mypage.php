<div class="container text-center">
    <main class="form">
        <form action="#" method="post">
            <img src="" alt="">

            <h1 class="h2 text-dark mb-3">MyPage</h1>

            <p class="h4 text-left">登録した商品</p>
            <div class="row">
                <?php if (!empty($productData)) :  ?>
                    <?php foreach ($productData as $key => $val) : ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" src="img/sample.svg" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo sanitize($val['name']); ?></h5>
                                    <p class="card-text"><?php echo sanitize($val['comment']); ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="listProduct.php" class="btn btn-sm btn-outline-secondary text-dark">詳細</a>
                                        </div>
                                        <small class="text-muted">最終更新：<?php echo sanitize(date('Y年n月j日', strtotime($val['update_date']))); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="h4">登録されている商品はありません</div>
                <?php endif; ?>


                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="card-img-top" src="img/sample.svg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Sample Title.</h5>
                            <p class="card-text">Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~Text~~</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                                </div>
                                <small class="text-muted">更新日：2021年3月15日</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <a href="listProduct.php" class="btn btn-warning btn-block mb-2">商品を登録する<i class="fas fa-gift ml-2"></i></a>
            <a href="profEdit.php" class="btn btn-info btn-block mb-2">プロフィールの編集<i class="far fa-address-card ml-2"></i></a>
            <a href="passEdit.php" class="btn btn-success btn-block mb-2">パスワード変更<i class="fas fa-key ml-2"></i></a>
            <a href="withdraw.php" class="btn btn-danger btn-block">退会ページ<i class="fas fa-dove ml-2"></i></a>
        </form>
    </main>
</div>
