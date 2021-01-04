<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// Session
require __DIR__ . '/lib/function.php';
// ログイン認証
require __DIR__ . '/lib/auth.php';

if (!empty($_POST)) {
    debug('POST送信があります');

    try {
        // DB接続
        $dbh = dbConnect();
        // SQL作成
        $sql1 = 'UPDATE users SET delete_flg = 1 WHERE id = :us_id';
        $sql2 = 'UPDATE product SET delete_flg = 1 WHERE user_id = :us_id';
        $sql3 = 'UPDATE favorite SET delete_flg = 1 WHERE user_id = :us_id';
        // 値の流し込み
        $data = array(':us_id' => $_SESSION['user_id']);
        // クエリの実行
        $stmt1 = queryPost($dbh, $sql1, $data);
        $stmt2 = queryPost($dbh, $sql2, $data);
        $stmt3 = queryPost($dbh, $sql3, $data);

        if ($stmt1 && $stmt2) {
            // セッションを削除する
            session_destroy();
            debug('セッション変数の中身：' . print_r($_SESSION));
            debug('トップページへ遷移します');
            header('Location:index.php');
        } else {
            debug('クエリに失敗しました');
            $errMsg['common'] = MSG07;
        }
    } catch (Exception $e) {
        error_log('エラー発生：' . $e->getMessage());
        $errMsg['common'] = MSG07;
    }
}

$title = '　退会 | Tech Circle.';
$content = __DIR__ . '/views/withdraw.php';
include __DIR__ . '/views/layout.php';
