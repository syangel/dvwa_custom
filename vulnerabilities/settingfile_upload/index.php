<?php

define('DVWA_WEB_PAGE_TO_ROOT', '../../');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup(array('authenticated'));

$page = dvwaPageNewGrab();
$page['title']   = 'Setting File Upload' . $page['title_separator'] . $page['title'];
$page['page_id'] = 'Setting File Upload';
$page['help_button']   = 'Setting File Upload';
$page['source_button'] = 'Setting File Upload';

dvwaDatabaseConnect();

$error = '';
$output = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlData = file_get_contents('php://input');

    if (!empty($xmlData)) {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();

        if ($dom->loadXML($xmlData, LIBXML_NOENT | LIBXML_DTDLOAD)) {
            $output = $dom->saveXML();
        } else {
            $errMsg = "";
            foreach (libxml_get_errors() as $err) {
                $errMsg .= trim($err->message) . "; ";
            }
            $error = "파싱 에러: " . $errMsg;
        }
    } else {
        $error = "빈 데이터입니다.";
    }
}

$page['body'] .= '
<div class="body_padded">
    <h1>Setting File Upload</h1>

    <label for="xmlData">Setting File Input *</label><br />
    <textarea id="xmlData" rows="15" cols="80" placeholder="">' . htmlspecialchars($_POST['xmlData'] ?? '') . '</textarea><br />
    <button onclick="submitXML()">Parse</button>

    <div id="result" style="margin-top:20px; white-space: pre-wrap; background:#eee; border:1px solid #ccc; padding:10px;">';

if ($error) {
    $page['body'] .= htmlspecialchars($error);
}

if ($output) {
    $page['body'] .= htmlspecialchars($output);
}

$page['body'] .= '</div>

    <br />
</div>

<script>
function submitXML() {
    const xml = document.getElementById("xmlData").value;

    fetch(window.location.href, {
        method: "POST",
        headers: {
            "Content-Type": "application/xml"
        },
        body: xml
    })
    .then(response => response.text())
    .then(text => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(text, "text/html");
        const resultDiv = document.getElementById("result");

        // #result 안에 있는 텍스트(에러 또는 결과)만 보여주도록 처리
        resultDiv.textContent = doc.getElementById("result").textContent || "결과를 찾을 수 없습니다.";
    })
    .catch(err => alert("Error: " + err));
}
</script>
';

dvwaHtmlEcho($page);

?>
