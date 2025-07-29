<?php

define('DVWA_WEB_PAGE_TO_ROOT', '');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup(array());

$page = dvwaPageNewGrab();
$page['title']   = 'Admin Login' . $page['title_separator'] . $page['title'];
$page['page_id'] = 'admin';

$page['body'] .= "
<div class=\"body_padded\">
    <h2>Admin Login via Authorization Header</h2>
</div>
";

// Authorization 헤더 가져오기
$auth_header = $_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '';

if (stripos($auth_header, 'Basic ') === 0) {
    $encoded = trim(substr($auth_header, 6));
    $decoded = base64_decode($encoded);

    if (strpos($decoded, ':') !== false) {
        list($username, $password) = explode(':', $decoded, 2);

        // DB 연결
        $connection = $GLOBALS["___mysqli_ston"];

        // SQL query (보안을 위해 Prepared 사용 권장, 여기선 DVWA 컨텍스트 따라 취약하게 사용)
        $query = "SELECT * FROM users WHERE user = '$username' AND password = '$password'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $page['body'] .= "<div class='body_padded'><pre>✅ 인증 성공! Welcome, <b>" . htmlspecialchars($username) . "</b></pre></div>";
        } else {
            $page['body'] .= "<div class='body_padded'><pre>❌ 인증 실패: 사용자명 또는 비밀번호가 일치하지 않습니다.</pre></div>";
        }
    } else {
        $page['body'] .= "<div class='body_padded'><pre>❌ 잘못된 인증 형식입니다. (username:password)</pre></div>";
    }
} else {
    $page['body'] .= "<div class='body_padded'><pre>⚠️ 인증 헤더가 없습니다. <br>curl 예시: <code>curl -H \"Authorization: Basic YWRtaW46YWRtaW4=\" http://localhost/admin_login_auth.php</code></pre></div>";
}

dvwaHtmlEcho($page);
exit;

?>
