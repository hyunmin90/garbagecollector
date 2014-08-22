<h2>테스트 바로가기</h2>
<h3>share</h3>
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
<h3>md 파일 불러오기</h3>
<ul>
	<li><a href="/pages/docs/md" >/pages/docs/md - page/docs 폴더에 있는 md파일</a></li>
	<li><a href="/pages/docs/openapi" >/pages/docs/openapi - github에 있는 openapi example</a></li>
</ul>
<h2>아래 부터 내용</h2>
<?php if ($ext == 'html' || $ext == 'link') : ?>
<iframe width="100%" onload="resizePageFrame()" id="page_frame" frameborder="0" scrolling="no" src="<?php echo $content ?>"></iframe>
<script type="text/javascript">
	function resizePageFrame() {
		var f = document.getElementById('page_frame');
		f.style.height = "";
		f.style.height = f.contentWindow.document.body.scrollHeight + "px";
	}
</script>
<?php elseif($ext == 'php'): ?>
	<?php include $content ?>
<?php elseif($ext == 'md' || $ext == 'content'): ?>
	<?php echo $content ?>
<?php endif; ?>