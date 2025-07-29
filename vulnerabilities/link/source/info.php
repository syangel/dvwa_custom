<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   =  $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'open_redirect';
$page[ 'help_button' ]   = 'open_redirect';
$page[ 'source_button' ] = 'open_redirect';
dvwaDatabaseConnect();

$info = "";

if (array_key_exists ("id", $_GET) && is_numeric($_GET['id'])) {
	switch (intval ($_GET['id'])) {
		case 1:
			$info = "Why did he come to you?<br />I got a record, I was Zero Cool<br />Zero Cool. Crashed 1507 systems in one day, biggest crash in history, front page, New York Times August 10th 1988.";
			break;
		case 2:
			$info = "Who are you anyway?<br />Johnny.<br />Johnny who?<br />Just... Johnny?";
			break;
		default:
			$info = "Some other stuff";
	}
}

if ($info == "") {
	http_response_code (500);
	?>
	<p>Missing quote ID.</p>
	<?php
	exit;
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: Open HTTP Redirect</h1>

	<div class=\"vulnerable_code_area\">
		<h2>User Quotes</h2>
		<p>
			{$info}
		</p>
		<p><a href='../'>Back</a></p>
		{$html}
	</div>


</div>\n";

dvwaHtmlEcho( $page );

?>
