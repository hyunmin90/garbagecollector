<h2>개발자 페이지</h2>
<h2>개발툴</h2>
<ul>
	<li><a href="/dev/manage">디자인 막바로 반영툴</a></li>
	<li><a href="/dev/p">통이미지</a></li>
</ul>
<h3>페이지 통이미지 리스트</h3>
<ul>
<?php foreach($page_list as $page):?>
   <li><a href='/dev/p/<?php echo $page; ?>' target='' ><?php echo $page; ?> 페이지</a></li>
<?php endforeach;?>
</ul>
<h3>Whycle(위클)</h3>
<ul>
	<li><a href="/whycle/main">위클 메인</a></li>
	<li><a href="/whycle/main/listvm">위클 리스트</a></li>
</ul>
<h3>DNAver(디 멤버쉽)</h3>
<ul>
	<li><a href="/dnaver/main">멤버쉽 관리 페이지</a></li>
</ul>
<h3>md호환 되는 Page(Docs) Repository</h3>
<h4>정적 페이지 불러와보기</h4>
<ul>
	<li><a href="/pages/share/devday" >/pages/share/devday</a></li>
	<li><a href="/pages/share/devon" >/pages/share/devon</a></li>
	<li><a href="/pages/share/education" >/pages/share/education</a></li>
	<li><a href="/pages/share/eventetc" >/pages/share/eventetc</a></li>
	<li><a href="/pages/share/eventoffice" >/pages/share/eventoffice</a></li>
	<li><a href="/pages/share/ftp" >/pages/share/ftp</a></li>
	<li><a href="/pages/share/mashup" >/pages/share/mashup</a></li>
	<li><a href="/pages/share/projects" >/pages/share/projects</a></li>
	<li><a href="/pages/share/research" >/pages/share/research</a></li>
	<li><a href="/pages/share/schedule" >/pages/share/schedule</a></li>
	<li><a href="/pages/share/univ" >/pages/share/univ</a></li>
</ul>
<h4>md 파일 불러오기</h4>
<ul>
	<li><a href="/pages/docs/md" >/pages/docs/md - page/docs 폴더에 있는 md파일</a></li>
	<li><a href="/pages/docs/openapi" >/pages/docs/openapi - github에 있는 openapi example</a></li>
</ul>
</div>