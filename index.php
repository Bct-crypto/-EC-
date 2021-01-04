<?php

// DB接続
require __DIR__ . '/lib/dbConnect.php';
// Session
require __DIR__ . '/lib/function.php';
// ログイン認証
// require __DIR__ . '/lib/auth.php';

$title = 'TOP | Tech Circle.';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
