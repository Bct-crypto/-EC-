<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証
require __DIR__ . '/lib/auth.php';

debug('Password変更ページ*******************');
debugLogStart();

// 事前にユーザー情報を獲得する
$userData = getUserInfo($_SESSION['user_id']);
debug('獲得したユーザデータ：' . print_r($userData, true));

// POST送信があった場合
if (!empty($_POST)) {

    // 値の入れ込み
    $pass_old = $_POST['pass_old'];
    $pass_new = $_POST['pass_new'];
    $pass_re = $_POST['pass_re'];

    //バリデーションチェックを行う
    validRequired($pass_old, 'pass_old');
    validRequired($pass_new, 'pass_new');
    validRequired($pass_re, 'pass_re');

    if (empty($errMsg)) {
        debug('未入力チェックOK');

        // パスワード内容のチェック
        validPass($pass_old, 'pass_old');
        validPass($pass_new, 'pass_new');

        // 登録済のパスワードが正しい入力かチェック
        if (!password_verify($pass_old, $userData['password'])) {
            $errMsg['pass_old'] = MSG13;
        }
        // 同じパスワードが入力されていないかチェック
        if ($pass_old === $pass_new) {
            $errMsg['pass_new'] = MSG14;
        }
    }
}

$title = 'パスワード変更';
$content = __DIR__ . '/views/passEdit.php';
include __DIR__ . '/views/layout.php';
