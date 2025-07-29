<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'api';
$page[ 'help_button' ]   = 'api';
$page[ 'source_button' ] = 'api';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch( dvwaSecurityLevelGet() ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'impossible.php';
		break;
}

if (PHP_OS == "Linux") {
	$out = shell_exec ("apachectl -M | grep rewrite_module");
	if ($out == "") {
		$html .= "<em><span class='failure'>Warning, mod_rewrite is not enabled</span></em><br>";
		$html .= "See the <a href='https://github.com/digininja/DVWA/blob/master/README.md#apache-modules'>README</a> for more information.<br>";
	}
}

if (!is_dir ("./vendor")) {
	$html .= "<em><span class='failure'>Warning, composer has not been run.</span></em><br>";
	$html .= "See the <a href='https://github.com/digininja/DVWA/blob/master/README.md#vendor-files'>README</a> for more information.<br>";
}
	

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/api/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "<div class=\"body_padded\">
	<h1>API</h1>

	<div class=\"vulnerable_code_area\">
";

$page[ 'body' ] .= "
		{$html}
	</div>
</div>\n";

dvwaHtmlEcho( $page );

?>

