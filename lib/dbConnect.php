<?php

// DB接続に関する関数
function dbConnect()
{
    $dsn = 'mysql:dbname=freemarket;host=localhost;charset=utf8';
    $user = 'root';
    $passward = 'root';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_DIRECT_QUERY => true,
    ];

    // PDOオブジェクト作成(DB接続)
    $dbh = new PDO($dsn, $user, $passward, $options);
    return $dbh;
}

// クエリ実行関数
function queryPost($dbh, $sql, $data)
{
    // クエリ作成
    $stmt = $dbh->prepare($sql);
    // プレースホルダーに値をセットし、SQLを実行
    $stmt->execute($data);
    return $stmt;
}
