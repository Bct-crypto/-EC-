<?php

//ログを取るか
ini_set('log_errors', 'on');
//ログの出力ファイルを指定
ini_set('error_log', 'php.log');

//エラーメッセージを定数に設定
define('MSG01', '入力必須です');
define('MSG02', 'Emailの形式で入力してください');
define('MSG03', 'パスワード（再入力）が合っていません');
define('MSG04', '半角英数字のみご利用いただけます');
define('MSG05', '6文字以上で入力してください');
define('MSG06', '256文字以内で入力してください');
define('MSG07', 'エラーが発生しました。しばらく経ってからやり直してください。');
define('MSG08', 'そのEmailは既に登録されています');

// エラーメッセージ格納用の配列
$errMsg = [];

function validRequired($str, $key)
{
    if (empty($str)) {
        global $errMsg;
        $errMsg[$key] = MSG01;
    }
}

function validEmail($str, $key)
{
    if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $str)) {
        global $errMsg;
        $errMsg[$key] = MSG02;
    }
}

function validMinLen($str, $key, $min = 6)
{
    if (strlen($str) < $min) {
        global $errMsg;
        $errMsg[$key] = MSG05;
    }
}

function validMaxLen($str, $key, $max = 256)
{
    if (strlen($str) > $max) {
        global $errMsg;
        $errMsg[$key] = MSG06;
    }
}

function validPass($str, $key)
{
    if (!preg_match("/^[a-zA-Z0-9]+$/", $str)) {
        global $errMsg;
        $errMsg[$key] = MSG04;
    }
}

function validMatch($str1, $str2, $key)
{
    if ($str1 !== $str2) {
        global $errMsg;
        $errMsg[$key] = MSG03;
    }
}

function validEmailDup($email)
{
    global $errMsg;
    // 例外処理
    try {
        // DB接続
        $dbh = dbConnect();
        // SQL文作成
        $sql = 'SELECT count(*) FROM users WHERE email = :email';
        // プレースホルダーへ値の入れ込み
        $data = array(':email' => $email);
        // クエリの実行
        $stmt = queryPost($dbh, $sql, $data);
        // クエリ結果の値の取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // 値の取り出し（array_shiftで配列の先頭を取り出す）
        // 下記if文は$resultに値がある場合＝すでに登録がある場合という意味
        if (!empty(array_shift($result))) {
            $errMsg['email'] = MSG08;
        }
    } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        $errMsg['common'] = MSG07;
    }
}
