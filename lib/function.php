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

function validMinLen($str, $key)
{
    if (strlen($str) < 6) {
        global $errMsg;
        $errMsg[$key] = MSG05;
    }
}

function validMaxLen($str, $key)
{
    if (strlen($str) > 255) {
        global $errMsg;
        $errMsg[$key] = MSG06;
    }
}
