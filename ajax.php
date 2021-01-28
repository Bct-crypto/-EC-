<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// 関数読み込み
require __DIR__ . '/lib/function.php';

debug('Ajax通信');
debugLogStart();

if (isset($_POST['productId']) && isset($_SESSION['user_id'])) {

    debug('POST送信：Ajaxお気に入り登録');
    $p_id = $_POST['productId'];
    debug('商品ID：' . $p_id);

    try {
        // DB接続
        $dbh = dbConnect();
        // SQL作成
        $sql = 'SELECT * FROM favorite WHERE product_id = :p_id AND user_id = :u_id';
        // 値の入れ込み
        $data = [
            ':p_id' => $p_id,
            ':u_id' => $_SESSION['user_id']
        ];
        // クエリの実行
        $stmt = queryPost($dbh, $sql, $data);
        $result = $stmt->rowCount();
        debug('抽出されたお気に入り件数：' . $result);

        if (!empty($result)) {
            // お気に入り登録されている場合
            $sql = 'DELETE FROM favorite WHERE product_id = :p_id AND user_id = :u_id';
            $data = [
                ':p_id' => $p_id,
                ':u_id' => $_SESSION['user_id']
            ];
            $stmt = queryPost($dbh, $sql, $data);
        } else {
            // お気に入り未登録だった場合
            $sql = 'INSERT INTO favorite (product_id, user_id, create_date) VALUES (:p_id, :u_id, :date)';
            $data = [
                ':p_id' => $p_id,
                ':u_id' => $_SESSION['user_id'],
                ':date' => date('Y-m-d H:i:s')
            ];
            $stmt = queryPost($dbh, $sql, $data);
        }
    } catch (Exception $e) {
        error_log('エラー発生：' . $e->getMessage());
    }
}

debug('Ajax通信終了');
