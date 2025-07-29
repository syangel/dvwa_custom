<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Welcome' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'home';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Welcome to InnovateTech!</h1>
	<p>InnovateTech는 기술의 경계를 넘어 새로운 미래를 창조하는 글로벌 혁신 기업입니다. 우리는 인공지능, 사물인터넷, 클라우드 컴퓨팅 등 최첨단 기술을 활용하여 다양한 산업 분야에서 혁신적인 솔루션을 제공하고 있습니다.</p>
	<hr />
	<br />

	<h2>We are Mission</h2>
	<p>우리의 미션은 기술의 힘을 통해 사람들의 삶을 더 편리하고 풍요롭게 만드는 것입니다. 지속 가능한 발전과 사회적 책임을 바탕으로, 우리는 고객과 파트너사, 그리고 사회 전반에 걸쳐 긍정적인 변화를 이끌어내고자 합니다.</p>
	<p>InnovateTech와 함께 기술의 무한한 가능성을 탐험해보세요.</p>
	<hr />
	<br />

</div>";

dvwaHtmlEcho( $page );

?>
