<?php 
$dev_ui = json_decode(file_get_contents("./assets_dev/dev_ui.json"),true);

$comment_list = array();
foreach ($dev_ui['comments'] as $value) {
    array_push ( $comment_list, $value);
 } 

$header_type = $dev_ui['header_type'];

if($header_type == 'img')
{
    $header_img_path = $dev_ui['header_img_path'];

    $image_content = file_get_contents('.'.$header_img_path);
    $image = imagecreatefromstring($image_content);
    $header_img_height = imagesy($image);
}
else if($header_type == 'tag')
{
    $header_tag = $dev_ui['header_tag'];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Daum Developers</title>
        <link rel="stylesheet" href="<?php echo CSS_DIR;?>/bootstrap.min.css">
        <script type="text/javascript" src="http://s1.daumcdn.net/svc/original/U03/cssjs/jquery/jquery-2.1.1.min.js"></script>
        <script src="<?php echo JS_DIR;?>/libs/handlebars-1.0.0.js"></script>
        <script src="<?php echo JS_DIR;?>/libs/ember-1.0.0-rc.8.js"></script>
        <script src="<?php echo JS_DIR;?>/bootstrap.js"></script>
        <?php if(isset($add_headers)): ?>
        <?php foreach($add_headers as $header_item):?>
        <?php echo $header_item; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </head>
    <body>
        <?php if($header_type == 'img'): ?>
        <div style="height:<?php echo $header_img_height;?>px;background-image:url('<?php echo $header_img_path.'?'.date('YmdHis');?>');background-repeat: no-repeat;"></div>
        <?php elseif($header_type == 'tag'): ?>
            <?php echo $header_tag;?>
        <?php endif; ?>