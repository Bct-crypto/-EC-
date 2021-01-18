<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証
require __DIR__ . '/lib/auth.php';

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



$title = '商品詳細ページ';
$content = __DIR__ . '/views/productDetail.php';
include __DIR__ . '/views/layout.php';
