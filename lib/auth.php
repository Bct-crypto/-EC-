<?php

// ログイン認証・自動ログアウトシステム

// ログインしている場合
if (!empty($_SESSION['login_date'])) {
    debug('ログイン済ユーザーです');

    // 現在日時が最終ログイン日時＋有効期限を超えていた場合
    if (($_SESSION['login_date'] + $_SESSION['login_limit']) < time()) {
        debug('ログイン有効期限オーバーです');

        // セッションを削除する（ログアウト）
        session_destroy();
        // ログインページへ
        header('Location:login.php');
        exit();
    } else {
        debug('ログイン有効期限以内です');

        // 最終ログイン日時を現在日時に更新
        $_SESSION['login_date'] = time();

        if (basename($_SERVER['PHP_SELF']) === 'login.php') {
            debug('マイページへ遷移します');
            header('Location:mypage.php');
            exit();
        }
    }
} else {
    debug('未ログインユーザーです');
    if (basename($_SERVER['PHP_SELF']) !== 'login.php') {
        if (!isset($_SESSION['name'])) {
            $_SESSION['return'] = $_SERVER['REQUEST_URI'];
        }
        header('Location:login.php');
        exit();
    }
}
