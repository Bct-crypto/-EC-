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
    } else {
        debug('ログイン有効期限以内です');

        // 最終ログイン日時を現在日時に更新
        $_SESSION['login_date'] = time();
        debug('マイページへ遷移します');
        header('Location:mypage.php');
    }
} else {
    debug('未ログインユーザーです');
}
