<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';

debug('商品詳細ページを表示します');
debugLogStart();

//================================
// 画面処理
//================================

// 画面表示用データ取得
//================================
// 商品IDのGETパラメータの取得
$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '';
// DBから商品データの取得
$viewData = getProductOne($p_id);

// パラメータに不正な値がないかチェック
if (empty($viewData)) {
    error_log('エラー発生：不正な値が入力されています');
    header('Location:index.php');
}
debug('取得したDBデータ：' . print_r($viewData, true));

if (!empty($_POST['submit'])) {
    debug('POST送信があります（購入ボタンを押下）');

    // ログイン認証
    require __DIR__ . '/lib/auth.php';

    try {
        // DB接続
        $dbh = dbConnect();
        // SQL作成
        $sql = 'INSERT INTO board (sale_user, buy_user, product_id, create_date) VALUES (:s_uid, :b_uid, :p_id, :date)';
        // 値の入れ込み
        $data = [
            ':s_uid' => $viewData['user_id'],
            ':b_uid' => $_SESSION['user_id'],
            ':p_id' => $p_id,
            ':date' => date('Y-m-d H:i:s')
        ];
        // クエリの実行
        $stmt = queryPost($dbh, $sql, $data);

        if ($stmt) {
            debug('連絡掲示板へ遷移します');
            $_SESSION['msg_success'] = SUC05;
            header('Location:msg.php?m_id=' . $dbh->lastInsertId());
            exit();
        }
    } catch (Exception $e) {
        error_log('エラー発生：' . $e->getMessage());
        $errMsg['common'] = MSG07;
    }
}


$title = '商品詳細ページ';
$content = __DIR__ . '/views/productDetail.php';
include __DIR__ . '/views/layout.php';
