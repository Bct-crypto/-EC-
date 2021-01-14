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
                <svg class="bd-placeholder-img" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96" /><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text>
                </svg>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-lg btn-block btn-primary">
        <?php echo (!$editFlg) ? '出品登録する' : '編集内容を更新する'; ?>
    </button>
</div>
