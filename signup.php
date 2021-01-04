<?php

// DB接続・クエリ実行関連関数の読み込み
require __DIR__ . '/lib/dbConnect.php';
// バリデーション関数の読み込み
require __DIR__ . '/lib/function.php';

// POST送信が合った場合
if (!empty($_POST)) {

    // 値を変数に格納
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_re = $_POST['pass_re'];

    // 空入力チェック
    validRequired($email, 'email');
    validRequired($pass, 'pass');
    validRequired($pass_re, 'pass_re');

    if (empty($errMsg)) {

        // Emailの形式のチェック
        validEmail($email, 'email');
        // Emailの最大入力数チェック
        validMaxLen($email, 'email');
        // Emailの重複チェック
        validEmailDup($email);

        // パスワードの半角英数字チェック
        validPass($pass, 'pass');
        // パスワードの最小入力数チェック
        validMinLen($pass, 'pass');
        // パスワードの最大入力数チェック
        validMaxLen($pass, 'pass');

        // パスワード（再入力）の最小文字数チェック
        validMinLen($pass_re, 'pass_re');
        // パスワード（再入力）の最大文字数チェック
        validMaxLen($pass_re, 'pass_re');

        if (empty($errMsg)) {

            // パスワードとパスワード（再入力）の合致チェック
            validMatch($pass, $pass_re, 'pass_re');

            if (empty($errMsg)) {

                // 例外処理
                try {
                    // DB接続
                    $dbh = dbConnect();
                    // SQL作成
                    $sql = 'INSERT INTO users (email,password,login_time,create_date) VALUES (:email,:password,:login_time,:create_date)';
                    // データ流し込み
                    $data = array(':email' => $email, ':password' => password_hash($pass, PASSWORD_DEFAULT), ':login_time' => date('Y-m-d H:i:s'), ':create_date' => date('Y-m-d H:i:s'));
                    // クエリ実行
                    $stmt = queryPost($dbh, $sql, $data);

                    // クエリ成功の場合
                    if ($stmt) {
                        // ログイン有効期限を設定
                        $sesLimit = 60 * 60;
                        // 最終ログインを現在日時に
                        $_SESSION['login_date'] = time();
                        $_SESSION['login_limit'] = $sesLimit;
                        // ユーザーIDを格納　※オブジェクト関数を使用する
                        $_SESSION['user_id'] = $dbh->lastInsertId();

                        debug('セッション変数の中身：' . print_r($_SESSION, true));
                        header('Location:mypage.php');
                    } else {
                        error_log('クエリに失敗しました');
                        $errMsg['common'] = MSG07;
                    }
                } catch (Exception $e) {
                    error_log('エラー発生：' . $e->getMessage());
                    $errMsg['common'] = MSG07;
                }
            }
        }
    }
}

$title = 'サインアップ';
$content = __DIR__ . '/views/signup.php';
include __DIR__ . '/views/layout.php';
