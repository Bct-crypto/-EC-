<?php

// 関数の読み込み
require __DIR__ . '/lib/dbConnect.php';
require __DIR__ . '/lib/function.php';

debug('メッセージ削除処理****************************');
debugLogStart();

/* -------------------------------------
   　　　　　　 画面表示処理
------------------------------------- */
$viewData = '';
$boardId = $_SESSION['board_id'];

debug('$boardId:' . print_r($boardId, true));

// 未ログインユーザーによるパラメータ操作があった場合はトップページへ戻す
if (empty($_SESSION['user_id'])) {
    error_log('未ログインユーザーです');
    debug('$_SESSIONの中身：' . print_r($_SESSION, true));
    header('Location:index.php');
    exit();
}

// 画面表示用データの取得
$m_id = (!empty($_GET['m_id'])) ? $_GET['m_id'] : '';
// DBからメッセージデータを取得
$viewData = getMyMsg($m_id);

if (!empty($_POST)) {
    debug('POST送信：メッセージ削除');

    isLogin();

    $msg = (!empty($_POST['msg'])) ? $_POST['msg'] : '';

    try {
        // DB接続
        $dbh = dbConnect();
        // SQL作成
        $sql = 'DELETE FROM message WHERE msg = :msg AND id = :u_id';
        // 値の入れ込み
        $data = [
            ':msg' => $msg,
            ':u_id' => $m_id
        ];
        // クエリの実行
        $stmt = queryPost($dbh, $sql, $data);

        if ($stmt) {
            debug('メッセージ更新処理完了');
            $_SESSION['msg_success'] = SUC09;
            header('Location:msg.php?m_id=' . $boardId);
            exit();
        } else {
            return false;
        }
    } catch (Exception $e) {
        error_log('エラー発生：' . $e->getMessage());
    }
}


$title = 'メッセージ削除';
$content = __DIR__ . '/views/deleteMsg.php';
include __DIR__ . '/views/layout.php';
