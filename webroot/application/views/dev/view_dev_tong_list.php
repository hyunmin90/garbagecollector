<h3>통 이미지 페이지</h3>
<h4>통이미지 올리기</h4>
<p>본 페이지는 통이미지만으로 데모페이지를 만드는 디자인 공유툴입니다.</p>
<form name="'.$name.'" class="well" method="post" enctype="multipart/form-data" action="/dev/p_u" method="post">
  <input type="hidden" name="form_type" value="upload_page" />
  <label>링크</label> 
  <p>http://<?php echo $_SERVER['SERVER_NAME']; ?>/dev/{마지막 url 값 입력}</p>
  <input type="text" name='link' placeholder="마지막 url 값 입력">  
  <label>페이지 통이미지 파일</label>  
  <input type="file" name='file'>  
  <span class="help-inline">잘 잘라주세요. 파일 최적화!! BMP 사절!!</span>
  <button type="submit" class="btn">업로드!</button>  
</form>
<h4>통이미지 리스트</h4>
<ul>
<?php foreach($page_list as $page):?>
	<li><a href='/dev/p/<?php echo $page; ?>' target='' ><?php echo $page; ?> 페이지</a>(<a href="/dev/p_d/<?php echo $page; ?>">삭제</a>)</li>
<?php endforeach;?>
</ul>