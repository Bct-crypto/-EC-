<?php

require __DIR__ . '/lib/dbConnect.php';
require __DIR__ . '/lib/function.php';

debug('LogOut****************************');
debugLogStart();

debug('ログアウトします');
// セッションを削除
session_destroy();
debug('ログインページへ遷移します');
// loginページへ
header('Location:login.php');
