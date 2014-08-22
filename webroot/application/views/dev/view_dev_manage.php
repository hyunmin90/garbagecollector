<?php 
function get_form_tag($name ,$is_file)
{
   $multipart = '';
   if($is_file) $multipart = 'enctype="multipart/form-data"';
   return '<form name="'.$name.'" class="well" method="post" '.$multipart.' action="/dev/form_ok" method="post">';
}

?>
<h2>버그투성이고 UI구리지만 나름 개발툴</h2>

<h3>디자인 막바로 반영툴</h3>
<h4>Header를 이미지로 올리기</h4>
<?php echo get_form_tag('form_header_img' ,TRUE) ?>
  <input type="hidden" name="form_type" value="upload_header_img" />
  <label>Header 이미지 파일</label>  
  <input type="file" name='file'>  
  <span class="help-inline">잘 잘라주세요. 파일 최적화!! BMP 사절!!</span>
  <button type="submit" class="btn">반영!</button>  
</form>

<h4>Header를 Tag로 올리기</h4>
<?php echo get_form_tag('form_header_tag' ,FALSE) ?>
  <input type="hidden" name="form_type" value="upload_header_tag" method="post" />
  <label>Header Tag</label>  
  <textarea></textarea>
  <button type="submit" class="btn">반영!</button>  
</form>

<h4>Footer를 이미지 올리기</h4>
<?php echo get_form_tag('form_footer_img' ,TRUE) ?>
  <input type="hidden" name="form_type" value="upload_footer_img" />
  <label>Footer 이미지 파일</label>  
  <input type="file" name='file'>  
  <span class="help-inline">잘 잘라주세요. 파일 최적화!! BMP 사절!!</span>
  <button type="submit" class="btn">반영!</button>  
</form>

<h4>Footer를 Tag로 올리기</h4>
<?php echo get_form_tag('form_footer_tag' ,FALSE) ?>
  <input type="hidden" name="form_type" value="upload_footer_tag" />
  <label>Footer 태그</label>  
  <textarea></textarea>
  <button type="submit" class="btn">반영!</button>  
</form>

<h3>통 이미지 페이지</h3>
<h4>통이미지 올리기</h4>
<form name="'.$name.'" class="well" method="post" enctype="multipart/form-data" action="/dev/p_u" method="post">
  <input type="hidden" name="form_type" value="upload_page" />
  <label>링크</label>  
  <input type="text" name='link'>  
  <label>페이지 통이미지 파일</label>  
  <input type="file" name='file'>  
  <span class="help-inline">잘 잘라주세요. 파일 최적화!! BMP 사절!!</span>
  <button type="submit" class="btn">업로드!</button>  
</form>
<h4>통이미지 리스트</h4>
<ul>
<?php foreach($page_list as $page):?>
   <li><a href='/dev/p/<?php echo $page; ?>' target='' ><?php echo $page; ?> 페이지</a></li>
<?php endforeach;?>
</ul>