<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証
require __DIR__ . '/lib/auth.php';

debug('商品登録・編集ページを表示します');
debugLogStart();

// 画面表示処理用

// GETデータ
$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '';
// DBから商品データを取得
$dbFormData = (!empty($p_id)) ? getProduct($_SESSION['user_id']) : '';
// 新規登録か編集画面かの判定
$editFlg = (empty($dbFormData)) ? false : true;

// パラメータの改竄チェック
if (!empty($p_id) && empty($dbFormData)) {
    debug('GETパラメータの商品IDが異なります。マイページへ移動します');
    header('Location:mypage.php');
    exit();
}

$title = '商品登録・編集ページ';
$content = __DIR__ . '/views/listProduct.php';
include __DIR__ . '/views/layout.php';
