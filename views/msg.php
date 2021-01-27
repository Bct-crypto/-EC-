<div class="container">

    <!-- 商品情報 -->
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4 my-auto">
                <?php if (!empty($productInfo['pic'])) : ?>
                    <img class="card-img-top " src="<?php echo sanitize($productInfo['pic']); ?>" alt="" style="max-height: 200px;object-fit :contain;">
                <?php else : ?>
                    <img class="card-img-top" src="img/sample-img.png" alt="" style="max-height: 200px; object-fit :contain;">
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">商品名：<?php echo sanitize($productInfo['name']); ?></h5>
                    <p class="card-text">カテゴリ：<?php echo sanitize($productInfo['category']); ?></p>
                    <p class="card-text">コメント：<?php echo sanitize($productInfo['comment']); ?></p>

                    <p class="card-text">料　　金：<?php echo sanitize($productInfo['price']); ?>円</p>
                    <p class="card-text"><small class="text-muted">最終更新日：<?php echo sanitize(date('Y年n月j日', strtotime($productInfo['update_date']))); ?></small></p>
                </div>
            </div>
        </div>
    </div>

    　　　
    <!-- 掲示板部分 -->
    <?php if (!empty($viewData[0]['msg'])) {
        foreach ($viewData as $key => $val) {
            if ($val['from_user'] == $partnerUserId) {
    ?>
                <div class="card mb-2" style="width: 90%;">
                    <div class="card-body px-1 py-1 d-flex align-items-center">
                        <div class="" style="display: inline-block;">
                            <img src="<?php echo sanitize($partnerUserInfo['pic']); ?>" id="avatar" class="mr-2" alt="">
                        </div>
                        <div class="" style="display: inline-block;">
                            <p><?php echo sanitize($val['msg']); ?></p>
                            <small class="text-muted"><?php echo sanitize($partnerUserInfo['username']); ?> - 送信日：<?php echo sanitize(date('Y年n月j日', strtotime($val['send_date']))); ?></small>
                        </div>
                    </div>
                </div>
            <?php
            } else { ?>
                <div class="card mb-2" style="width: 90%;float:right;">
                    <div class="card-body px-1 py-1 d-flex align-items-center justify-content-end">
                        <div class="mr-2" style="display: inline-block;">
                            <p><?php echo sanitize($val['msg']); ?></p>
                            <small class="d-block text-muted text-right"><?php echo sanitize($myUserInfo['username']); ?> - 送信日：<?php echo sanitize(date('Y年n月j日', strtotime($val['send_date']))); ?></small>
                        </div>
                        <div class="" style="display: inline-block;">
                            <img src="<?php echo sanitize($myUserInfo['pic']); ?>" id="avatar" class="" alt="">
                        </div>
                    </div>
                </div>
        <?php
            }
        }
    } else { ?>
        <p class="text-center text-dark">メッセージの投稿がまだありません</p>
    <?php } ?>





</div>

<!-- メッセージ投稿部分 -->
<div class="container" id="msg-submit">
    <form action="" method="POST">
        <label for="msg">メッセージ投稿</label>
        <textarea class="form-control mb-2" id="" name="msg" rows="3"></textarea>
        <input type="submit" value="投稿する" class="btn btn-info text-right">
    </form>
</div>
