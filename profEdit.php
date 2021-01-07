<?php

// DB接続・クエリ実行関連関数の読み込み
require __DIR__ . '/lib/dbConnect.php';
// バリデーション関数の読み込み
require __DIR__ . '/lib/function.php';
// ログイン認証ファイルの読み込み
require __DIR__ . '/lib/auth.php';

debug('Profile編集ページ***********************');
debugLogStart();

$dbFormData = getUserInfo($_SESSION['user_id']);
debug('取得したユーザー情報： ' . print_r($dbFormData, true));

if (!empty($_POST)) {

    debug('POST送信があります');
    debug('POST情報：' . print_r($_POST, true));
    debug('FILE情報：');

    // 変数に情報を格納する
    $username = $_POST['username'];
    $age = (!empty($_POST['age'])) ? $_POST['age'] : 0;
    $tel = (!empty($_POST['tel'])) ? $_POST['tel'] : 0;
    $zip = (!empty($_POST['zip'])) ? $_POST['zip'] : 0;
    $addr = $_POST['addr'];
    $email = $_POST['email'];

    var_dump($tel);
    // DBの情報と新たにPOSTされた情報が異なる場合にバリデーションチェックを行う

    // 名前
    if ($dbFormData['username'] !== $username) {
        validMaxLen($username, 'username');
    }
    // 年齢
    if ($age === 0) {
        $age = $age;
    } elseif ($dbFormData['age'] !== $age) {
        validMaxLen($age, 'age');
        validNumber($age, 'age');
    }
    // 電話番号
    if ($tel === 0) {
        $tel = $tel;
    } elseif ((int)$dbFormData['tel'] !== $tel) {
        validTel($tel, 'tel');
    }
    // 郵便番号
    // DBから取得してきた値は全てString型なのでintにキャストする
    if ($zip === 0) {
        $zip = $zip;
    } elseif ((int)$dbFormData['zip'] !== $zip) {
        validZip($zip, 'zip');
    }
    // 住所
    if ($dbFormData['addr'] !== $addr) {
        validMaxLen($addr, 'addr');
    }
    // メールアドレス
    if ($dbFormData['email'] !== $email) {
        validMaxLen($email, 'email');
        // DB接続はサーバーに負担をかけるので最低限にする
        if (empty($errMsg['email'])) {
            validEmailDup($email);
        }
        validEmail($email, 'email');
        validRequired($email, 'email');
    }

    if (empty($errMsg)) {

        debug('バリデーションチェックOK');

        try {
            // DB接続
            $dbh = dbConnect();
            // SQL作成
            $sql = 'UPDATE users SET username = :u_name, age = :age,tel = :tel,zip = :zip,addr = :addr,email = :email WHERE id = :u_id';
            // 値の入れ込み
            $data = [
                ':u_name' => $username,
                ':age' => $age,
                ':tel' => $tel,
                ':zip' => $zip,
                ':addr' => $addr,
                ':email' => $email,
                ':u_id' => $dbFormData['id']
            ];
            // クエリの実行
            $stmt = queryPost($dbh, $sql, $data);

            if ($stmt) {
                debug('クエリ成功：ユーザー情報を更新しました');
                header('Location:mypage.php');
            }
        } catch (Exception $e) {
            error_log('エラー発生：' . $e->getMessage());
            $errMsg['common'] = MSG07;
        }
    }
}

$title = 'プロフィール編集';
$content = __DIR__ . '/views/profEdit.php';
include __DIR__ . '/views/layout.php';
