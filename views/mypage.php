<div class="container text-center" style="margin-bottom: 120px;">
    <h1 class="h4 text-dark my-3">MyPage</h1>
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

    <!-- 掲示板やり取り -->
    <p class="h5 text-left text-dark mb-2">掲示板メッセージ</p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">最新送信日時</th>
                <th scope="col">取引相手</th>
                <th scope="col">メッセージ内容</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($msgData)) : ?>
                <?php foreach ($msgData as $key => $val) : ?>
                    <?php if (!empty($val['msg'])) {
                        $msg = array_shift($val['msg']);
                        if ($msg['from_user'] !== $user_id) {
                            $partnerInfo = getUserInfo($msg['from_user']);
                        } else {
                            $partnerInfo = getUserInfo($msg['to_user']);
                        }
                        debug('相手の情報：' . print_r($partnerInfo, true));
                    ?>
                        <tr>
                            <td><?php echo sanitize(date('Y.m.d H:i:s', strtotime($msg['send_date']))); ?></td>
                            <td><?php echo sanitize($partnerInfo['username']) ?></td>
                            <td><a class="text-info" href="msg.php?m_id=<?php echo sanitize($val['id']); ?>" style="cursor: pointer;">
                                    <?php echo mb_substr(sanitize($msg['msg']), 0, 10); ?>...</a></td>
                        </tr>
                    <?php } ?>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td>取引中のデータはありません</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- お気に入り -->
    <p class="h5 text-left text-dark mb-2">お気に入り一覧</p>
    <?php if (empty($favoriteData)) : ?>
        <small class="text-muted d-block text-left my-2">お気に入り登録なし</small>
    <?php else : ?>
        <div class="row">
            <?php foreach ($favoriteData as $key => $val) {
                // 4種だけ表示する
                if ($likeLoop >= 4) {
                    break;
                }
            ?>
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm">
                        <?php if (!empty($val['pic'])) : ?>
                            <img class="card-img-top" src="<?php echo sanitize($val['pic']); ?>" alt="" style="min-height: 150px;max-height: 150px; object-fit :cover;">
                        <?php else : ?>
                            <img class="card-img-top" src="img/sample-img.png" alt="" style="min-height: 200px;max-height: 200px; object-fit :cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo sanitize($val['name']); ?></h5>
                            <p class="card-text">¥<?php echo sanitize($val['price']); ?>円</p>
                            <a href="productDetail.php<?php echo (!empty(appendGetParam())) ? appendGetParam() . '&p_id=' . $val['id'] : '?p_id=' . $val['id']; ?>" class="btn btn-sm btn-outline-secondary">詳細<i class="fas fa-info-circle ml-2"></i></a>
                        </div>
                    </div>
                </div>
            <?php
                $likeLoop++;
            } ?>
        </div>
    <?php endif; ?>
    <a class="d-block mb-3 small text-right text-dark" href="myList.php">
        お気に入り登録した全ての商品をみる &gt;&gt;
    </a>

    <!-- 登録商品 -->
    <p class="h5 text-left text-dark mb-2">登録商品</p>
    <?php if (empty($productData['data'])) : ?>
        <small class="text-muted d-block text-left my-2">商品登録なし</small>
    <?php else : ?>
        <div class="row">
            <?php foreach ($productData['data'] as $key => $val) { ?>
                <!-- ３種だけ登録商品を展開する　※ページを圧迫するため -->
                <?php if ($productLoop >= 4) {
                    break;
                } ?>
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm">
                        <?php if (!empty($val['pic'])) : ?>
                            <img class="card-img-top" src="<?php echo sanitize($val['pic']); ?>" alt="" style="min-height: 150px;max-height: 150px; object-fit :cover;">
                        <?php else : ?>
                            <img class="card-img-top" src="img/sample-img.png" alt="" style="min-height: 200px;max-height: 200px; object-fit :cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo sanitize($val['name']); ?></h5>
                            <p class="card-text">¥<?php echo sanitize($val['price']); ?>円</p>
                            <a href="listProduct.php<?php echo (!empty(appendGetParam())) ? appendGetParam() . '&p_id=' . $val['id'] : '?p_id=' . $val['id']; ?>" class="btn btn-sm btn-outline-secondary">詳細<i class="fas fa-info-circle ml-2"></i></a>
                        </div>
                    </div>
                </div>
            <?php
                $likeLoop++;
            } ?>
        </div>
    <?php endif; ?>
    <a class="d-block mb-3 small text-right text-dark" href="myList.php">
        登録済の全ての商品をみる &gt;&gt;
    </a>


    <a href="listProduct.php" class=" btn btn-warning btn-block mb-2">商品を登録する<i class="fas fa-gift ml-2"></i></a>
    <a href="profEdit.php" class="btn btn-info btn-block mb-2">プロフィールの編集<i class="far fa-address-card ml-2"></i></a>
    <a href="passEdit.php" class="btn btn-success btn-block mb-2">パスワード変更<i class="fas fa-key ml-2"></i></a>
    <a href="withdraw.php" class="btn btn-danger btn-block">退会ページ<i class="fas fa-dove ml-2"></i></a>

</div>
