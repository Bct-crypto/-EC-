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
$dbFormData = (!empty($p_id)) ? getProduct($_SESSION['user_id'], $p_id) : '';
// カテゴリーデータの取得
$dbCategoryData = getCategory();
// 新規登録か編集画面かの判定
$editFlg = (empty($dbFormData)) ? false : true;

// パラメータの改竄チェック
if (!empty($p_id) && empty($dbFormData)) {
    debug('GETパラメータの商品IDが異なります。マイページへ移動します');
    header('Location:mypage.php');
    exit();
}

if (!empty($_POST)) {
    debug('POST送信があります');
    debug('POST情報：' . print_r($_POST, true));

    // 変数にユーザー情報を格納する
    $name = $_POST['name'];
    $category = $_POST['category_id'];
    $comment = $_POST['comment'];
    $price = (!empty($_POST['price'])) ? $_POST['price'] : 0;
    // 画像をアップロードし、パスを格納する
    $pic = (!empty($_FILES['pic']['name'])) ? upLoadImage($_FILES['pic'], 'pic') : '';
    // 画像をPOSTしていない（登録していない）がすでにDBに登録されている場合、DBのパスを入れてあげる（POSTに反映されないため）
    $pic = (empty($pic)) && (!empty($dbFormData('pic'))) ? $dbFormData('pic') : $pic;

    // 更新の場合はDBから取得してきた情報と異なるためバリデーションチェックを行う

    // 新規登録
    if (empty($dbFormData)) {
        // 未入力チェック
        validRequired($name, 'name');
        // 最大文字数チェック
        validMaxLen($name, 'name');
        // セレクトボックスチェック
        validSelect($category, 'category_id');
        // 最大文字数チェック
        validMaxLen($comment, 'comment');
        // 未入力チェック
        validRequired($price, 'price');
        // 半角数字チェック
        validNumber($price, 'price');
    } else {
        // 更新処理の場合

        if ($dbFormData['name'] !== $name) {
            // 未入力チェック
            validRequired($name, 'name');
            // 最大文字数チェック
            validMaxLen($name, 'name');
        }
        if ($dbFormData['category_id'] !== $category) {
            // セレクトボックスチェック
            validSelect($category, 'category_id');
        }
        if ($dbFormData['comment'] !== $comment) {
            // 最大文字数チェック
            validMaxLen($comment, 'comment');
        }
        if ($dbFormData['price'] !== $price) {
            // 未入力チェック
            validRequired($price, 'price');
            // 半角数字チェック
            validNumber($price, 'price');
        }
    }

    if (empty($errMsg)) {
        debug('バリデーションチェックOKです');

        try {
            // DB接続
            $dbh = dbConnect();
            if ($editFlg) {
                // true=編集なのでUPDATE文を実行する
                $sql = 'UPDATE product SET name = :name,category_id = :category,comment = :comment,price = :price,pic = :pic WHERE user_id = :u_id AND id = :p_id';
                $data = [
                    ':name' => $name,
                    ':category' => $category,
                    ':comment' => $comment,
                    ':price' => $price,
                    ':pic' => $pic,
                    ':u_id' => $_SESSION['user_id'],
                    '::p_id' => $p_id
                ];
            } else {
                // false=新規登録なのでINSERT文を実行する
                $sql = 'INSERT INTO product (name,category_id,comment,price,pic,user_id,create_date) VALUES (:name,:category,:comment,:price,:pic,:u_id,:date)';
                // 値の入れ込み
                $data = [
                    ':name' => $name,
                    ':category' => $category,
                    ':comment' => $comment,
                    ':price' => $price,
                    ':pic' => $pic,
                    ':u_id' => $_SESSION['user_id'],
                    ':date' => date('Y-m-d H:i:s')
                ];
            }
            debug('準備したSQL：' . $sql);
            debug('流し込むデータ：' . print_r($data, true));

            // クエリの実行
            $stmt = queryPost($dbh, $sql, $data);
            if ($stmt) {
                debug('クエリ成功');
                header('Location:mypage.php');
            }
        } catch (Exception $e) {
            error_log('エラー発生：' . $e->getMessage());
        }
    }
}


$title = '商品登録・編集ページ';
$content = __DIR__ . '/views/listProduct.php';
include __DIR__ . '/views/layout.php';
