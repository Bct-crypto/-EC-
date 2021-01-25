<div class="container">

    <!-- 商品情報 -->
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

    　　　
    <!-- 掲示板部分 -->
    <div class="card mb-2" style="width: 90%;">
        <div class="card-body px-1 py-1 d-flex align-items-center">
            <div class="" style="display: inline-block;">
                <img src="img/sample-img.png" class="mr-2" alt="" style="height:100%;width:150px;border-radius:50%">
            </div>
            <div class="" style="display: inline-block;">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <small class="text-muted">ユーザー名（相手の名前） - 送信日：</small>
            </div>
        </div>
    </div>

    <div class="card mb-2" style="width: 90%;float:right;">
        <div class="card-body px-1 py-1 d-flex align-items-center justify-content-end">
            <div class="mr-2" style="display: inline-block;">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <small class="d-block text-muted text-right">ユーザー名（自分の名前） - 送信日：</small>
            </div>
            <div class="" style="display: inline-block;">
                <img src="img/sample-img.png" class="" alt="" style="height:100%;width:150px;border-radius:50%">
            </div>
        </div>
    </div>


</div>

<!-- メッセージ投稿部分 -->
<div class="container" id="msg-submit">
    <form action="" method="POST">
        <label for="msg">メッセージ投稿</label>
        <textarea class="form-control mb-2" id="" name="msg" rows="3"></textarea>
        <input type="submit" value="投稿する" class="btn btn-info text-right">
    </form>
</div>
