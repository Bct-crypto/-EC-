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
        validCheck($pass_old, 'pass_old');
        validCheck($pass_new, 'pass_new');

        // 登録済のパスワードが正しい入力かチェック
        if (!password_verify($pass_old, $userData['password'])) {
            $errMsg['pass_old'] = MSG13;
        }
        // 同じパスワードが入力されていないかチェック
        if ($pass_old === $pass_new) {
            $errMsg['pass_new'] = MSG14;
        }
        // 新しいパスワードとパスワード再入力が合っているかチェック
        validMatch($pass_new, $pass_re, 'pass_new');

        // エラーが無ければ登録処理に進む
        if (empty($errMsg)) {
            debug('バリデーションチェックOK：更新処理に進みます');

            try {
                // DB接続
                $dbh = dbConnect();
                // SQL作成
                $sql = 'UPDATE users SET password = :pass WHERE id = :id';
                // 値の入れ込み
                $data = [
                    ':id' => $_SESSION['user_id'],
                    ':pass' => password_hash($pass_new, PASSWORD_DEFAULT)
                ];
                // クエリ実行
                $stmt = queryPost($dbh, $sql, $data);

                if ($stmt) {
                    debug('クエリ成功：パスワードを更新しました');
                    $_SESSION['msg_success'] = SUC01;
                    header('Location:mypage.php');
                    exit();
                } else {
                    debug('クエリ失敗：パスワード更新処理ができませんでした');
                }
            } catch (Exception $e) {
                error_log('エラー発生：' . $e->getMessage());
                $errMsg['common'] = MSG07;
            }
        }
    }
}

$title = 'パスワード変更';
$content = __DIR__ . '/views/passEdit.php';
include __DIR__ . '/views/layout.php';
