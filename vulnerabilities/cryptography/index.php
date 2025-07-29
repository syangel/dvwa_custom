<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'cryptography';
$page[ 'help_button' ]   = 'cryptography';
$page[ 'source_button' ] = 'cryptography';

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

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/cryptography/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "<div class=\"body_padded\">
	<h1>Encode/Decode</h1>

	<div class=\"vulnerable_code_area\">
";

$page[ 'body' ] .= "
		{$html}
	</div>
</div>\n";

dvwaHtmlEcho( $page );

?>

