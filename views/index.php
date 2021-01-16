<main role="main">

    <section class="jumbotron-fluid text-center">
        <div class="container">
            <h1 class="jumbotron-heading">技術を次のエンジニアへ</h1>
            <p class="lead text-white h5">
                Tech Circleはエンジニアが学習で使用する技術書に関する情報を共有・購入できるサイトです。<br>
                先輩エンジニアの書籍レビューを参考に、学習中の言語をより効率的に改善しましょう！
            </p>
            <p>
                <a href="#" class="btn btn-primary my-2">早速探してみる</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                <?php foreach ($dbProductData['data'] as $key => $val) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <?php if (!empty($val['pic'])) : ?>
                                <img class="card-img-top" src="<?php echo sanitize($val['pic']); ?>" alt="" style="min-height: 160px;max-height: 160px; object-fit :cover;">
                            <?php else : ?>
                                <img class="card-img-top" src="img/sample-img.png" alt="" style="max-height: 160px; object-fit :cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo sanitize($val['name']); ?></h5>
                                <p class="card-text"><?php echo sanitize($val['comment']); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="productDetail.php" class="btn btn-info">詳細</a>
                                    </div>
                                    <small class="text-muted">最終更新日：<?php echo sanitize(date('Y年n月j日', strtotime($val['update_date']))); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>

</main>
