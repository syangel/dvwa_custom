<?php
// 출력 버퍼 초기화
@ob_clean();
header('Content-Type: text/html; charset=utf-8');

// 401 Unauthorized 응답 함수
function send401($message = '인증이 필요합니다.') {
    header('HTTP/1.1 401 Unauthorized');
    echo "<h2>401 Unauthorized</h2><pre>❌ " . htmlspecialchars($message) . "</pre>";
    exit;
}

// Authorization 헤더 가져오기
$auth_header = '';

// 우선 getallheaders 또는 apache_request_headers로 시도
if (function_exists('apache_request_headers')) {
    $headers = apache_request_headers();
    if (isset($headers['Authorization'])) {
        $auth_header = $headers['Authorization'];
    } elseif (isset($headers['authorization'])) {
        $auth_header = $headers['authorization'];
    } elseif (isset($headers['AUTHORIZATION'])){
        $auth_header = $headers['AUTHORIZATION'];
    }
}

// fallback: $_SERVER 값에서 시도
if (!$auth_header) {
    $auth_header = $_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '';
}

// 인증 로직 처리
if (stripos($auth_header, 'Basic ') === 0) {
    $base64 = substr($auth_header, 6);
    $decoded = base64_decode($base64);

    if ($decoded !== false && strpos($decoded, ':') !== false) {
        list($username, $password) = explode(':', $decoded, 2);

        if ($username === 'admin' && $password === 'admin') {
            // 인증 성공
            header('HTTP/1.1 200 OK');
            echo "<h2>✅ 인증 성공</h2><pre>Welcome, <b>" . htmlspecialchars($username) . "</b></pre>";
        } else {
            send401('사용자 이름 또는 비밀번호가 잘못되었습니다.');
        }
    } else {
        send401('오류입니다.');
    }
} else {
    send401('인증이 없습니다');
}
?>
