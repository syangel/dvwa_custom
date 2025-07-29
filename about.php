<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'About' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'about';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h2>비전</h2>
	<p>InnovateTech는 기술의 경계를 넘어 새로운 가능성을 창조하는 글로벌 리더가 되는 것을 목표로 합니다. 우리는 혁신과 창의성을 통해 사람들의 삶을 더 편리하고 풍요롭게 만드는 솔루션을 제공합니다.</p>

	<h2>미션</h2>
	<p>우리의 미션은 첨단 기술을 활용하여 사회와 환경에 긍정적인 변화를 가져오는 것입니다. 지속 가능한 발전과 디지털 혁신을 통해 미래를 선도하는 기업이 되고자 합니다.</p>

	<h2>핵심 가치</h2>
	<ul>
		<li>혁신(Innovation): 끊임없이 새로운 아이디어를 탐구하고, 이를 실현하기 위해 노력합니다.</li>
		<li>고객 중심(Customer-Centric): 고객의 요구를 깊이 이해하고, 이를 바탕으로 최적의 솔루션을 제공합니다.</li>
		<li>협업(Collaboration): 다양한 전문가와의 협력을 통해 시너지를 창출하고, 더 큰 성과를 이룹니다.</li>
		<li>윤리(Ethics): 투명하고 공정한 경영을 통해 신뢰를 구축하고, 사회적 책임을 다합니다.</li>
	</ul>

	<h2>주요 사업 분야</h2>
	<ul>
		<li>스마트 솔루션: IoT, AI, 빅데이터를 활용한 스마트 홈 및 스마트 시티 솔루션 제공.</li>
		<li>친환경 기술: 재생 에너지 및 에너지 효율화 기술을 통해 지속 가능한 미래를 위한 솔루션 개발.</li>
		<li>디지털 헬스케어: 첨단 기술을 활용한 건강 관리 및 원격 의료 서비스 제공.</li>
		<li>자율주행 및 모빌리티: 자율주행 기술 및 스마트 모빌리티 솔루션 개발 및 상용화.</li>
	</ul>

	<h2>글로벌 네트워크</h2>
	<p>InnovateTech는 전 세계에 걸쳐 다양한 파트너와 협력하며, 글로벌 시장에서 경쟁력을 강화하고 있습니다. 우리의 기술과 솔루션은 이미 여러 국가에서 성공적으로 도입되어 긍정적인 평가를 받고 있습니다.</p>

	<h2>인재상</h2>
	<p>우리는 창의적이고 열정적인 인재를 찾습니다. 다양한 배경과 경험을 가진 전문가들이 모여 함께 성장할 수 있는 환경을 제공합니다. InnovateTech는 여러분의 꿈을 실현할 수 있는 플랫폼입니다.</p>
	<!-- <p>Credit Card Info : 4369-6169-0727-4898<p> -->

</div>\n";

dvwaHtmlEcho( $page );

exit;

?>
