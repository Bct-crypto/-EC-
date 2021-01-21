<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// バリデーション関数
require __DIR__ . '/lib/function.php';
// ログインチェック
require __DIR__ . '/lib/auth.php';


debug('Login Page.');
debugLogStart();

// post送信があった場合
if (!empty($_POST)) {
    debug('POST送信があります');

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_save = (!empty($_POST['pass_save'])) ? true : false;

    // バリデーションの実施

    validRequired($email, 'email');
    validRequired($pass, 'pass');

    if (empty($errMsg)) {

        validEmail($email, 'email');
        validMaxLen($email, 'email');

        validPass($pass, 'pass');
        validMinLen($pass, 'pass');
        validMaxLen($pass, 'pass');

        if (empty($errMsg)) {
            debug('バリデーションチェックOK');

            try {
                // DB接続
                $dbh = dbConnect();
                // SQL作成
                $sql = 'SELECT password,id FROM users WHERE email = :email AND delete_flg = 0';
                // 値の入れ込み
                $data = array(':email' => $email);
                // クエリの実行
                $stmt = queryPost($dbh, $sql, $data);
                // 値の取得
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                // 第二引数がtrueの場合は、string型を返す
                debug('クエリ結果の中身：' . print_r($result, true));

                if (!empty($result) && password_verify($pass, array_shift($result))) {
                    debug('パスワードがマッチしました');

                    // セッション有効期限を設定　※デフォルトを1時間に設定
                    $sesLimit = 60 * 60;
                    // 最終ログイン日時を現在日時に
                    $_SESSION['login_date'] = time();

                    // ログイン保持チェックの有無の確認
                    if ($pass_save) {
                        debug('ログイン保持にチェックがあります');
                        // ログイン有効期限を30日に設定
                        $_SESSION['login_limit'] = $sesLimit * 24 * 30;
                    } else {
                        debug(('ログイン保持にチェックはありません'));
                        // そのまま何もしない
                        $_SESSION['login_limit'] = $sesLimit;
                    }

                    // 取得したユーザーIDを格納する
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['msg_success'] = SUC06;
                    debug('マイページへ遷移します');
                    header('Location:mypage.php');
                    exit();
                } else {
                    debug('パスワードがアンマッチです');
                    $errMsg['common'] = MSG09;
                }
            } catch (Exception $e) {
                error_log('エラー発生：' . $e->getMessage());
                $errMsg['common'] = MSG07;
            }
        }
    }
}

$title = 'サインイン';
$content = __DIR__ . '/views/login.php';
include __DIR__ . '/views/layout.php';
