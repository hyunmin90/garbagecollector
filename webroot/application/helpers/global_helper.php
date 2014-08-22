<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 에러 창 반환 후 url이동
 */ 
function show_alert($msg = '',$url = '')
{
	if($msg == '' || $msg == '!') $msg = '시스템 오류입니다.';
	else if($msg == '?') $msg = '잘못된 접근입니다.';
	
	if($url != '') 
	{
		?>
		<script>
		alert('<?php echo $msg ?>');
		location='<?php echo $url ?>';
		</script>
		<?php
	}
	else 
	{
		?>
		<script>
		alert('<?php echo $msg ?>');
		history.back();
		</script>
		<?php
	}
	exit("알림창");
}