<div class="container">
    <form action="#" method="post">

        <div class="area-msg text-danger">
            <?php if (!empty($errMsg)) : ?>
                <?php echo $errMsg['common']; ?>
            <?php endif; ?>
        </div>

        <p class="h4 my-4">投稿メッセージ削除</p>

        <label for="msg">メッセージ内容 <span class=" ml-2 text-danger"><?php if (!empty($errMsg['msg'])) echo $errMsg['msg']; ?></span> </label>
        <textarea readonly class="form-control mb-2" id="js-count-msg" name="msg" rows="3"><?php echo sanitize($viewData['msg']); ?></textarea>

        <div class="">
            <a class="btn btn-secondary btn-sm d-inline-block" href="msg.php?m_id=<?php echo sanitize($boardId); ?>">キャンセル</a>
            <input type="submit" class="btn  btn-danger btn-sm" value="削除">
            <p class="text-muted d-inline-block" style="float: right;"><span class="text-muted" id="js-count-view"><?php echo sanitize(mb_strlen($viewData['msg'])); ?></span>/200文字</p>
        </div>
    </form>
</div>
