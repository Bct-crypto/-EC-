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
define('MSG09', 'メールアドレスまたはパスワードが違います');
define('MSG10', '電話番号の形式が違います');
define('MSG11', '郵便番号の形式が違います');
define('MSG12', '半角数字のみご利用いただけます');
define('MSG13', '登録されているパスワードと一致しません');
define('MSG14', '古いパスワードと同じです');
define('MSG15', '文字で入力してください');
define('MSG16', '正しくありません');
define('MSG17', '有効期限が切れています');
define('SUC01', 'パスワードを変更しました');
define('SUC02', 'プロフィールを変更しました');
define('SUC03', 'メールを送信しました');
define('SUC04', '登録しました');
define('SUC05', '購入しました！相手と連絡を取りましょう！');

// エラーメッセージ格納用の配列
$errMsg = [];

// Session準備・有効期限設定
// sessionファイルの格納場所　30日間削除されないため
session_save_path('/var/tmp/');
// ガーベージコレクションが削除するセッションの有効期限を設定
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 30);
// ブラウザが閉じても削除されないようにクッキーの有効期限を伸ばす
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 30);
// セッションを使用
session_start();
// 現在のセッションを新しいものに置き換える
session_regenerate_id();

// デバッグログ関数
$debug_flg = true;
function debug($str)
{
    global $debug_flg;
    if (!empty($debug_flg)) {
        error_log('デバッグ：' . $str);
    }
}
// 画面表示処理開始ログの吐き出し関数
function debugLogStart()
{
    debug('*********************************** 描画処理開始');
    debug('セッションID：' . session_id());
    debug('セッション変数の中身：' . print_r($_SESSION, true));
    debug('現在日時タイムスタンプ：' . time());
    if (!empty($_SESSION['login_date']) && !empty($_SESSION['login_limit'])) {
        debug('ログイン期日日時タイムスタンプ：' . ($_SESSION['login_date'] + $_SESSION['login_limit']));
    }
}


function validRequired($str, $key)
{
    if ($str === '') {
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
        $sql = 'SELECT count(*) FROM users WHERE email = :email AND delete_flg = 0';
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

function validTel($str, $key)
{
    if (!preg_match("/0\d{1,4}\d{1,4}\d{4}/", $str)) {
        global $errMsg;
        $errMsg[$key] = MSG10;
    }
}

function validZip($str, $key)
{
    if (!preg_match("/(^\d{3}\-\d{4}$)|(^\d{7}$)/", $str)) {
        global $errMsg;
        $errMsg[$key] = MSG11;
    }
}

function validNumber($str, $key)
{
    if (!preg_match("/^[0-9]+$/", $str)) {
        global $errMsg;
        $errMsg[$key] = MSG12;
    }
}

// パスワードチェック専用関数
function validCheck($str, $key)
{
    // 半角英数字チェック
    validPass($str, $key);
    // 最大文字数チェック
    validMaxLen($str, $key);
    // 最小文字数チェック
    validMinLen($str, $key);
}

// セレクトボックスチェック
function validSelect($str, $key)
{
    if (!preg_match("/^[1-9]+$/", $str)) {
        global $errMsg;
        $errMsg[$key] = MSG15;
    }
}

// function validLength($str,$key,$len = 8)

function getUserInfo($u_id)
{
    global $errMsg;
    try {
        // DB接続
        $dbh = dbConnect();
        // SQL作成
        $sql = 'SELECT * FROM users WHERE id = :u_id AND delete_flg = 0';
        // 値の入れ込み
        $data = array(':u_id' => $u_id);
        // クエリの実行
        $stmt = queryPost($dbh, $sql, $data);

        // if ($stmt) {
        //     debug('クエリ成功：ユーザー情報を取得しました');
        // } else {
        //     debug('クエリ失敗：ユーザー情報の獲得に失敗しました');
        // }

        if ($stmt) {
            // 取得したユーザー情報を返却する
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    } catch (Exception $e) {
        error_log('エラー発生：' . $e->getMessage());
        $errMsg['common'] = MSG07;
    }
}

// 商品情報の取得
function getProduct($u_id, $p_id)
{
    debug('商品情報を取得します');
    debug('ユーザーID：' . $u_id);
    debug('商品ID：' . $p_id);

    try {
        // DB接続
        $dbh = dbConnect();
        // SQL作成
        $sql = 'SELECT * FROM product WHERE user_id = :u_id AND id = :p_id AND delete_flg= 0';
        // 値の入れ込み
        $data = [
            ':u_id' => $u_id,
            ':p_id' => $p_id
        ];
        // クエリの実行
        $stmt = queryPost($dbh, $sql, $data);

        if ($stmt) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    } catch (Exception $e) {
        error_log('エラー発生：' . $e->getMessage());
        $errMsg['common'] = MSG07;
    }
}

function getCategory()
{
    debug('カテゴリ情報を取得します');

    try {
        // DB接続
        $dbh = dbConnect();
        // SQL作成
        $sql = 'SELECT * FROM category';
        // 値の入れ込み
        $data = [];
        // クエリの実行
        $stmt = queryPost($dbh, $sql, $data);

        if ($stmt) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    } catch (Exception $e) {
        error_log('エラー発生：' . $e->getMessage());
        $errMsg['common'] = MSG07;
    }
}

// 登録商品情報の取得
function getMyProduct($u_id)
{
    global $errMsg;
    debug('自身の商品情報を取得します');
    debug('ユーザID：' . $u_id);
    try {
        // DB接続
        $dbh = dbConnect();
        // SQL作成
        $sql = 'SELECT * FROM product WHERE user_id = :u_id AND delete_flg = 0';
        // 値の入れ込み
        $data = [':u_id' => $u_id];
        // クエリの実行
        $stmt = queryPost($dbh, $sql, $data);

        if ($stmt) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    } catch (Exception $e) {
        error_log('エラー発生：' . $e->getMessage());
        $errMsg['common'] = MSG07;
    }
}

// Formの入力保持
function getFormData($str)
{
    global $dbFormData;

    // ユーザーデータがある場合
    if (!empty($dbFormData)) {
        // フォームエラーがある場合
        if (!empty($errMsg[$str])) {
            // POSTされたデータがある場合
            if (isset($_POST[$str])) {
                return sanitize($_POST[$str]);
            } else {
                return sanitize($dbFormData[$str]);
            }
        } else {
            // フォームエラーがない場合
            // POSTされており、尚且つPOSTされた値とDBの差異をチェック
            if (isset($_POST[$str]) && $dbFormData[$str] !== $_POST[$str]) {
                return sanitize($_POST[$str]);
            } else {
                return sanitize($dbFormData[$str]);
            }
        }
    } else {
        if (isset($_POST[$str])) {
            return sanitize($_POST[$str]);
        }
    }
}

function sanitize($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


// // sessionを一度だけ取得
// function getSessionFlash($key)
// {
//     if (!empty($_SESSION[$key])) {
//         $data = $_SESSION[$key];
//         $_SESSION = '';
//         return $data;
//     }
// }
