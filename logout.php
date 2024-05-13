<?php
    // logout.php 파일

    session_start(); // 세션 시작

    // 모든 세션 변수를 제거합니다.
    $_SESSION = array();

    // 세션 쿠키를 삭제합니다.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // 마지막으로, 세션을 파괴하여 로그아웃을 완료합니다.
    session_destroy();

    // 로그아웃 후 메인 페이지나 로그인 페이지로 리다이렉트합니다.
    header('Location: index.php'); // 'index.php'을 로그아웃 후 이동할 페이지로 변경하세요.
    exit();
?>
