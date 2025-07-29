<?php

define('DVWA_WEB_PAGE_TO_ROOT', '../../');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup(['authenticated']);

$page = dvwaPageNewGrab();
$page['title']   = 'File Browser' . $page['title_separator'] . $page['title'];
$page['page_id'] = 'file_browser';
$page['help_button'] = 'file_find';
$page['source_button'] = 'file_find';

// 입력 경로 처리
$path = $_GET['path'] ?? '.';
$realPath = realpath($path);

// 유효하지 않은 경로는 에러
if ($realPath === false || !is_dir($realPath)) {
    $page['body'] .= "<div class='body_padded'><p>❌ Invalid path specified.</p></div>";
    dvwaHtmlEcho($page);
    exit;
}

// UI Header
$page['body'] .= <<<HTML
<style>
.file-list { list-style: none; padding: 0; }
.file-list li { margin: 6px 0; }
.file-list li a { text-decoration: none; color: #0366d6; }
.file-list li a:hover { text-decoration: underline; }
.file-icon { margin-right: 8px; }
</style>

<div class="body_padded">
    <h1>📁 File Browser</h1>
    <div class="vulnerable_code_area">
        <p><b>Current Path:</b> <code>{$realPath}</code></p>
        <ul class="file-list">
HTML;

// 상위 디렉토리 링크 표시
if ($realPath !== '/') {
    $parent = dirname($realPath);
    $page['body'] .= "<li><span class='file-icon'>🔙</span><a href=\"?path=" . urlencode($parent) . "\">[..]</a></li>";
}

// 파일 및 디렉토리 나열
$items = scandir($realPath);
foreach ($items as $item) {
    if ($item === '.') continue;

    $fullPath = $realPath . DIRECTORY_SEPARATOR . $item;
    $encodedPath = urlencode($fullPath);

    if (is_dir($fullPath)) {
        $icon = '📁';
        $link = "<a href=\"?path={$encodedPath}\">" . htmlspecialchars($item) . "</a>";
    } else {
        $icon = '📄';
        $link = "<a href=\"{$encodedPath}\" target=\"_blank\">" . htmlspecialchars($item) . "</a>";
    }

    $page['body'] .= "<li><span class='file-icon'>{$icon}</span>{$link}</li>";
}

$page['body'] .= <<<HTML
        </ul>
    </div>
</div>
HTML;

dvwaHtmlEcho($page);
?>
