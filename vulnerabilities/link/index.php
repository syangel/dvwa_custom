<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   =  $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'open_redirect';
$page[ 'help_button' ]   = 'open_redirect';
$page[ 'source_button' ] = 'open_redirect';
dvwaDatabaseConnect();

switch( dvwaSecurityLevelGet() ) {
	case 'low':
		$link1 = "source/low.php?redirect=info.php?id=1";
		$link2 = "source/low.php?redirect=info.php?id=2";
		break;
	case 'medium':
		$link1 = "source/medium.php?redirect=info.php?id=1";
		$link2 = "source/medium.php?redirect=info.php?id=2";
		break;
	case 'high':
		$link1 = "source/high.php?redirect=info.php?id=1";
		$link2 = "source/high.php?redirect=info.php?id=2";
		break;
	default:
		$link1 = "source/impossible.php?redirect=1";
		$link2 = "source/impossible.php?redirect=2";
		break;
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Links</h1>

	<div class=\"vulnerable_code_area\">
		<h2>User History</h2>
		<p>
			Here are two links to some famous user quotes, see if you can hack them.
		</p>
		<ul>
			<li><a href='{$link1}'>Quote 1</a></li>
			<li><a href='{$link2}'>Quote 2</a></li>
		</ul>
		{$html}
	</div>

</div>\n";

dvwaHtmlEcho( $page );

?>
