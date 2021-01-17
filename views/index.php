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

        <!-- ページネーション -->
        <nav aria-label="検索結果表示">
            <ul class="pagination justify-content-center">

                <?php
                $pageColNum = 5; // 表示リンク数
                $totalPageNum = $dbProductData['total_page'];
                // 現在のページが、総ページ数と同じ　かつ　総ページ数が表示項目数以上なら、左にリンク４個出す
                if ($currentPageNum == $totalPageNum && $totalPageNum >= $pageColNum) {
                    $minPageNum = $currentPageNum - 4;
                    $maxPageNum = $currentPageNum;
                    // 現在のページが、総ページ数の１ページ前なら、左にリンク３個、右に１個出す
                } elseif ($currentPageNum == ($totalPageNum - 1) && $totalPageNum >= $pageColNum) {
                    $minPageNum = $currentPageNum - 3;
                    $maxPageNum = $currentPageNum + 1;
                    // 現ページが2の場合は左にリンク１個、右にリンク３個だす。
                } elseif ($currentPageNum == 2 && $totalPageNum >= $pageColNum) {
                    $minPageNum = $currentPageNum - 1;
                    $maxPageNum = $currentPageNum + 3;
                    // 現ページが1の場合は左に何も出さない。右に５個出す。
                } elseif ($currentPageNum == 1 && $totalPageNum >= $pageColNum) {
                    $minPageNum = $currentPageNum;
                    $maxPageNum = 5;
                    // 総ページ数が表示項目数より少ない場合は、総ページ数をループのMax、ループのMinを１に設定
                } elseif ($totalPageNum < $pageColNum) {
                    $minPageNum = 1;
                    $maxPageNum = $totalPageNum;
                    // それ以外は左に２個出す。
                } else {
                    $minPageNum = $currentPageNum - 2;
                    $maxPageNum = $currentPageNum + 2;
                }
                ?>

                <!-- ページネーションリンク表示部分 -->

                <!-- 現在のページが１ページ目でなければ、最初へ戻るリンクを表示 -->
                <?php if ($currentPageNum != 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?p=1">最初へ</a>
                    </li>
                <?php endif; ?>

                <!-- 表示リンク生成部分 -->
                <?php for ($i = $minPageNum; $i <= $maxPageNum; $i++) : ?>
                    <li class="page-item <?php if ($currentPageNum == $i) echo 'active'; ?>"><a class="page-link" href="?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>

                <!-- 現在のページが最大ページでなければ、最終ページへ進むリンクを表示 -->
                <?php if ($currentPageNum != $maxPageNum) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?p=<?php echo $totalPageNum; ?>">最後へ</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

</main>
