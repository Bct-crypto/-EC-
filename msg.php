<?php

// 関数の読み込み
require __DIR__ . '/lib/dbConnect.php';
require __DIR__ . '/lib/function.php';

debug('掲示板の処理****************************');
debugLogStart();

/* -------------------------------------
   　　　　　　 画面表示処理
------------------------------------- */
$partnerUserId = '';
$partnerUserInfo = '';
$myUserId = '';
$myUserInfo = '';
$productInfo = '';
$viewData = '';

// 未ログインユーザーによるパラメータ操作があった場合はトップページへ戻す
if (empty($_SESSION['user_id'])) {
    error_log('未ログインユーザーです');
    debug('$_SESSIONの中身：' . print_r($_SESSION, true));
    header('Location:index.php');
    exit();
}
// 画面表示用データの取得
$m_id = (!empty($_GET['m_id'])) ? $_GET['m_id'] : '';
// 編集・削除用の掲示板IDをセッションに保存する
$_SESSION['board_id'] = $m_id;
// DBから掲示板データとメッセージデータを取得する
$viewData = getMsgsAndBoard($m_id);
if (empty($viewData)) {
    error_log('不正な値が入っています');
    header('Location:mypage.php');
    exit();
}
// 商品情報の取得
$productInfo = getProductOne($viewData[0]['product_id']);
// debug('取得した商品データ：' . print_r($productInfo, true));
if (empty($productInfo)) {
    error_log('商品情報が取得できませんでした');
    header('Location:mypage.php');
    exit();
}
// ユーザーIDの取り出し
if ($_SESSION['user_id'] === $viewData[0]['sale_user']) {
    $partnerUserId = $viewData[0]['buy_user'];
    $myUserId = $viewData[0]['sale_user'];
} elseif ($_SESSION['user_id'] === $viewData[0]['buy_user']) {
    $partnerUserId = $viewData[0]['sale_user'];
    $myUserId = $viewData[0]['buy_user'];
}
// ユーザー情報の格納
$partnerUserInfo = getUserInfo($partnerUserId);
$myUserInfo = getUserInfo($myUserId);

if (empty($partnerUserInfo) || empty($myUserInfo)) {
    error_log('相手のユーザー情報を取得できませんでした');
    header('Location:mypage.php');
    exit();
}

if (!empty($_POST)) {
    debug('POST送信---投稿メッセージ');

    //　ログイン認証
    isLogin();
    // 変数への格納
    $msg = (!empty($_POST['msg'])) ? $_POST['msg'] : '';

    debug('$msgの中身：' . print_r($msg, true));

    // バリデーションチェック
    validRequired($msg, 'msg');
    validMaxLen($msg, 'msg', 200);

    if (empty($errMsg)) {
        debug('バリデーションOKです--メッセージ登録を開始します');
        try {
            // DB接続
            $dbh = dbConnect();
            // SQL作成
            $sql = 'INSERT INTO message (board_id, send_date, to_user, from_user, msg, create_date) VALUES (:b_id, :send_date, :to_user, :from_user, :msg, :date)';
            // 値の入れ込み
            $data = [
                ':b_id' => $m_id,
                ':send_date' => date('Y-m-d H:i:s'),
                ':to_user' => $partnerUserId,
                ':from_user' => $myUserId,
                ':msg' => $msg,
                ':date' => date('Y-m-d H:i:s')
            ];
            // クエリの実行
            $stmt = queryPost($dbh, $sql, $data);

            if ($stmt) {
                // POST内容をクリア
                $_POST = [];
                debug('連絡掲示板へ遷移します');
                $_SESSION['msg_success'] = SUC07;
                header('Location:' . $_SERVER['PHP_SELF'] . '?m_id=' . $m_id);
            }
        } catch (Exception $e) {
            error_log('エラー発生：' . $e->getMessage());
            $errMsg['common'] = MSG07;
        }
    }
}


$title = '連絡掲示板';
$content = __DIR__ . '/views/msg.php';
include __DIR__ . '/views/layout.php';
