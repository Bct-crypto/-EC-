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
$myUserInfo = '';
$productInfo = '';
$viewData = '';

// 画面表示用データの取得
$m_id = (!empty($_GET['m_id'])) ? $_GET['m_id'] : '';
// DBから掲示板データとメッセージデータを取得する
// $viewData = getMsgsAndBord($m_id);


$title = '連絡掲示板';
$content = __DIR__ . '/views/msg.php';
include __DIR__ . '/views/layout.php';
