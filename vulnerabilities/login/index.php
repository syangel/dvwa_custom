<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'brute';
$page[ 'help_button' ]   = 'brute';
$page[ 'source_button' ] = 'brute';
dvwaDatabaseConnect();

$method            = 'GET';
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
		$method = 'POST';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/brute/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">


	<div class=\"vulnerable_code_area\">
		<h2>Login</h2>

		<form action=\"#\" method=\"{$method}\">
			Username:<br />
			<input type=\"text\" name=\"username\"><br />
			Password:<br />
			<input type=\"password\" AUTOCOMPLETE=\"off\" name=\"password\"><br />
			<br />
			<input type=\"submit\" value=\"Login\" name=\"Login\">\n";

if( $vulnerabilityFile == 'high.php' || $vulnerabilityFile == 'impossible.php' )
	$page[ 'body' ] .= "			" . tokenField();

$page[ 'body' ] .= "
		</form>
		{$html}
	</div>


</div>\n";

dvwaHtmlEcho( $page );

?>
