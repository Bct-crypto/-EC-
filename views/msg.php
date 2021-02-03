<div class="container">

    <!-- 商品情報 -->
    <div class="card my-3">
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
    <label class="text-dark">やり取りメッセージ</label>
    <div id="msg-overflow">
        <?php if (!empty($viewData[0]['msg'])) {
            foreach ($viewData as $key => $val) {
                if ($val['from_user'] == $partnerUserId) {
        ?>
                    <!-- 相手のメッセージ表示部分 -->
                    <div class="card mb-2" style="width: 90%;">
                        <div class="card-body px-1 py-1 d-flex align-items-center">
                            <div class="" style="display: inline-block;">
                                <img src="<?php echo sanitize($partnerUserInfo['pic']); ?>" id="avatar" class="mr-2" alt="">
                            </div>
                            <div class="" style="display: inline-block;">
                                <p><?php echo sanitize($val['msg']); ?></p>
                                <small id="delete_btn" class="text-muted mb-2"><?php echo sanitize($partnerUserInfo['username']); ?> - 送信日：<?php echo sanitize(date('Y年n月j日', strtotime($val['send_date']))); ?></small>
                                <p id="delete_btn" class="text-muted">メッセージを削除<i class="fas fa-times-circle" style="color: orangered; margin-left:5px;"></i></p>
                            </div>
                        </div>
                    </div>
                <?php
                } else { ?>
                    <!-- 自分のメッセージ表示部分 -->
                    <div class="card mb-2" style="width: 90%;float:right;">
                        <div class="card-body px-1 py-1 d-flex align-items-center justify-content-end">
                            <div class="mr-2" style="display: inline-block;">
                                <p><?php echo sanitize($val['msg']); ?></p>
                                <small class="d-block text-muted text-right"><?php echo sanitize($myUserInfo['username']); ?> - 送信日：<?php echo sanitize(date('Y年n月j日', strtotime($val['send_date']))); ?></small>
                                <small id="delete_btn" class="text-muted">メッセージを削除<i class="fas fa-times-circle" style="color: orangered; margin-left:5px;"></i></small>
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





</div>

<!-- メッセージ投稿部分 -->
<div class="container" id="msg-submit">
    <form action="" method="post">
        <label for="msg">メッセージ投稿 <span class=" ml-2 text-danger"><?php if (!empty($errMsg['msg'])) echo $errMsg['msg']; ?></span> </label>
        <textarea class="form-control mb-2" id="js-count-msg" name="msg" rows="3"></textarea>
        <div class="d-flex justify-content-between">
            <input type="submit" value="投稿する" class="btn btn-info">
            <p class="text-muted d-inline-block"><span class="text-muted" id="js-count-view">0</span>/200文字</p>
        </div>
    </form>
</div>
